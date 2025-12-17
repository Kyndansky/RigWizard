import React, { useEffect, useState } from "react";
import "./App.css";
import { Navigate } from "react-router-dom";
import { getLibraryGames, getTags, logout } from "./misc/api_calls_functions";
import NavBar from "./components/NavBar";
import { useAuth } from "./misc/AuthContextHandler";
import { LoadingScreen } from "./components/LoadingScreen";
import { ComponentsList } from "./components/ComponentsList";
import { GameInfoCard } from "./components/GameInfoCard";
import type { Game } from "./misc/interfaces";

function App() {
  const [games, setGames] = useState<Game[] | undefined>(undefined);
  const [tags, setTags] = useState<string[] | undefined>(undefined);
  const [selectedTags, setSelectedTags] = useState<string[]>([]);
  const [searchText, setSearchText] = useState<string>("");
  const [pageNumber, setPageNumber] = useState<number>(1);
  const [errorMessage, setErrorMessage] = useState<string>("");
  const { isAuthenticated, isLoading, setIsAuthenticated, username } =
    useAuth();
  const [maxPageNumber, setMaxPageNumber] = useState<number | undefined>(
    undefined
  );

  async function fetchGames() {
    const fetchedGamesResponse = await getLibraryGames(pageNumber);
    if (fetchedGamesResponse.successful) {
      setGames(fetchedGamesResponse.games);
      const roundedPageNumber = Math.round(
        fetchedGamesResponse.totalNumberOfGames / 20
      );
      if (roundedPageNumber >= 0) {
        setMaxPageNumber(roundedPageNumber);
      }
    } else {
      setErrorMessage(fetchedGamesResponse.message);
    }
  }

  async function fetchTags() {
    const fetchedTagsResponse = await getTags();
    if (fetchedTagsResponse.successful) {
      setTags(fetchedTagsResponse.tags);
    } else {
      setErrorMessage(fetchedTagsResponse.message);
    }
  }

  useEffect(() => {
    (async () => {
      await fetchGames();
      await fetchTags();
    })();
  }, []);

  if (isLoading) {
    return <LoadingScreen />;
  }
  if (!isAuthenticated) {
    return <Navigate to="/login" />;
  }

  return (
    <React.Fragment>
      {/*vertical container that contains navbar and page content */}
      <div className="flex flex-col h-screen overflow-hidden">
        <NavBar
          username={username === "" ? undefined : username}
          title="RigWizard"
          onLogoutClickButton={async () => {
            const loggedOut = await logout();
            if (loggedOut) {
              setIsAuthenticated(false);
            }
          }}
        />
        <div className="grid grid-cols-12 flex-grow h-full">
          {/* Left sidebar that shows the pc components */}
          <aside className="col-span-12 lg:col-span-2 bg-base-200 p-4 overflow-y-auto h-full">
            <h2 className="text-lg font-bold">Your pc specs</h2>
            <ComponentsList></ComponentsList>
          </aside>

          <main className="col-span-12 lg:col-span-8 bg-base-300 px-8 pt-4 pb-20 overflow-y-auto h-full">
            <h1 className="text-xl font-bold">Your library</h1>
            <div className="flex items-center my-5 w-full">
              <label className="input grow">
                <svg
                  className="h-[1em] opacity-50"
                  xmlns="http://www.w3.org/2000/svg"
                  viewBox="0 0 24 24"
                >
                  <g
                    strokeLinejoin="round"
                    strokeLinecap="round"
                    strokeWidth="2.5"
                    fill="none"
                    stroke="currentColor"
                  >
                    <circle cx="11" cy="11" r="8"></circle>
                    <path d="m21 21-4.3-4.3"></path>
                  </g>
                </svg>
                <input
                  type="search"
                  required
                  placeholder="Search game title here"
                  value={searchText}
                  onChange={(e) => {
                    setSearchText(e.target.value);
                  }}
                />
              </label>
            </div>

            {/* showing error if there is any */}
            {errorMessage !== "" ? (
              <div role="alert" className="alert alert-error">
                <svg
                  xmlns="http://www.w3.org/2000/svg"
                  className="h-6 w-6 shrink-0 stroke-current"
                  fill="none"
                  viewBox="0 0 24 24"
                >
                  <path
                    strokeLinecap="round"
                    strokeLinejoin="round"
                    strokeWidth="2"
                    d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z"
                  />
                </svg>
                <span>{errorMessage}</span>
              </div>
            ) : (
              <div className="grid lg:grid-cols-4 md:grid-cols-2 gap-7 mt-4">
                {/* filters games by only displaying those that have the same tags that are selected and whose title contain what is in the searchbar*/}
                {games
                  ?.filter((game) => {
                    return (
                      selectedTags.every((tag) => game.tags.includes(tag)) &&
                      game.title.toLowerCase().includes(searchText.toLowerCase())
                    );
                  })
                  .map((game, index) => (
                    <GameInfoCard
                      key={index}
                      name={game.title}
                      description={game.description}
                      tags={game.tags}
                      imageUrl={game.imgPath}
                    />
                  ))}
              </div>
            )}
            {/* section for changing page (to load more games) */}
            <div className="flex items-center w-full mt-4">
              <div className="join mx-auto">
                <button
                  className="join-item btn"
                  onClick={() => {
                    if (pageNumber > 1) {
                      setPageNumber(pageNumber - 1);
                      fetchGames();
                    }
                  }}
                >
                  &lt;
                </button>
                <button className="join-item btn-active bg-primary px-4">
                  {pageNumber}
                </button>
                {maxPageNumber && pageNumber!==maxPageNumber &&(
                  <button
                    className="join-item btn"
                    onClick={() => {
                      setPageNumber(maxPageNumber);
                      fetchGames();
                    }}
                  >
                    {maxPageNumber}
                  </button>
                )}
                <button
                  className="join-item btn"
                  onClick={() => {
                    setPageNumber(pageNumber + 1);
                    fetchGames();
                  }}
                >
                  &gt;
                </button>
              </div>
            </div>
          </main>

          {/*Filters sidebar*/}
          <aside className="col-span-12 lg:col-span-2 bg-base-200 p-4 overflow-y-auto h-full">
            <h2 className="text-lg font-bold">Tag Filters</h2>
            <form>
              {tags?.map((tag, index) => (
                <input
                  key={index}
                  className="btn m-1"
                  type="checkbox"
                  name="tags"
                  aria-label={tag}
                  onClick={() => {
                    //give a function to setSelectedTags, so that it knows that the value returned by that function is used to set the tags, as if a value was passed directly
                    //in this case we check if selectedTags contained the tag clicked: if it did, the tag gets removed, otherwise it gets added
                    setSelectedTags((prevTags) => {
                      const isSelected = prevTags.includes(tag);

                      if (!isSelected) {
                        return [...prevTags, tag];
                      } else {
                        return prevTags.filter((el) => el !== tag);
                      }
                    });
                  }}
                />
              ))}

              <input
                className="btn btn-square"
                type="reset"
                value="x"
                onClick={() => {
                  setSelectedTags([]);
                }}
              />
            </form>
          </aside>
        </div>
      </div>
    </React.Fragment>
  );
}
export default App;
