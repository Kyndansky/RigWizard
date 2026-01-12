import React, { useEffect, useState } from "react";
import "./App.css";
import { Link, Navigate } from "react-router-dom";
import {
  getUserPc,
  getLibraryGames,
  getTags,
} from "./misc/api_calls_functions";
import { useAuth } from "./misc/AuthContextHandler";
import { ComponentsList } from "./components/ComponentsList";
import { GameInfoCard } from "./components/GameInfoCard";
import { type Computer, type Game } from "./misc/interfaces";
import { BasePageLayout } from "./components/BasePageLayout";
import Loader from "./components/Loader";
import { PcCase } from "lucide-react";
import { ComputerComponentModal } from "./components/ComputerConfigModal";

function App() {
  const gamesPerPage = 20;
  const [games, setGames] = useState<Game[] | undefined>(undefined);
  const [tags, setTags] = useState<string[] | undefined>(undefined);
  const [selectedTags, setSelectedTags] = useState<string[]>([]);
  const [searchText, setSearchText] = useState<string>("");
  const [currentPageNumber, setCurrentPageNumber] = useState<number>(1);
  const [errorMessage, setErrorMessage] = useState<string>("");
  const [userComputer, setUserComputer] = useState<Computer | undefined>(
    undefined
  );
  const [isLoadingPcConfiguration, setIsLoadingPcConfiguration] =
    useState<boolean>(true);
  const [includeAllFiltersChecked, setIncludeAllFiltersChecked] =
    useState<boolean>(true);
  const { isAuthenticated, isLoading } = useAuth();
  const [maxPageNumber, setMaxPageNumber] = useState<number | undefined>(
    undefined
  );
  const [isPcConfigModalOpen, setIsPcConfigModalOpen] =
    useState<boolean>(false);

  async function fetchGames(targetPage: number) {
    const indexStart = (targetPage - 1) * gamesPerPage + 1;
    const fetchedGamesResponse = await getLibraryGames(
      indexStart,
      gamesPerPage,
      selectedTags,
      searchText,
      includeAllFiltersChecked
    );
    if (fetchedGamesResponse.successful) {
      setGames(fetchedGamesResponse.games);
      setCurrentPageNumber(targetPage);
      const roundedPageNumber = Math.ceil(
        fetchedGamesResponse.totalNumberOfGames / gamesPerPage
      );
      if (roundedPageNumber > 0) {
        setMaxPageNumber(roundedPageNumber);
      } else {
        setMaxPageNumber(1);
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

  async function fetchUserPc() {
    const fetchedPcResponse = await getUserPc();
    if (fetchedPcResponse.successful) {
      setUserComputer(fetchedPcResponse.computer);
    }
    setIsLoadingPcConfiguration(false);
  }
  useEffect(() => {
    (async () => {
      await fetchGames(1);
      await fetchTags();
      await fetchUserPc();
    })();
  }, []);

  // when the checkbox to select all filters or not is checked, the games are re-fetched
  useEffect(() => {
    fetchGames(1);
  }, [includeAllFiltersChecked]);

  //when the selectedTags change, the games are fetched
  useEffect(() => {
    fetchGames(1);
  }, [selectedTags]);

  useEffect(() => {
    const handler = setTimeout(() => {
      fetchGames(1);
    }, 400);

    //Viene eseguita ogni volta che searchText cambia prima che il timer scada
    return () => {
      clearTimeout(handler);
    };
  }, [searchText]);

  if (isLoading) {
    return <Loader />;
  }
  if (!isAuthenticated) {
    return <Navigate to="/login" />;
  }

  return (
    <React.Fragment>
      <BasePageLayout hideOverFlow={true}>
        <div className="grid grid-cols-12 flex-grow h-full">
          {/* Left sidebar that shows the pc components */}
          <aside className="col-span-12 lg:col-span-2 bg-base-200 p-4 overflow-y-auto h-full">
            <h2 className="text-lg font-bold mb-4">Your PC</h2>
            <div className="flex flex-col items-center gap-4 mx-[0.5rem]">
              {isLoadingPcConfiguration ? (
                // if the pc config hasn't been retrieved yet show loader
                <Loader />
              ) : !userComputer ? (
                // if the config has been loaded but user hasn't added a pc show warning
                <React.Fragment>
                  <div className="alert alert-warning">
                    You haven't set a computer configuration yet: many features
                    will not be availabe.
                  </div>
                  <button
                    className="btn btn-soft"
                    onClick={() => {
                      setIsPcConfigModalOpen(true);
                    }}
                  >
                    Add configuration <PcCase size={20} />
                  </button>
                </React.Fragment>
              ) : (
                // show pc configuration and edit button
                <React.Fragment>
                  <ComponentsList
                    pc={userComputer}
                    showGeneralEvaluation={true}
                    showRamBrand={true}
                  />
                  <button
                    className="btn btn-soft"
                    onClick={() => {
                      setIsPcConfigModalOpen(true);
                    }}
                  >
                    Edit configuration <PcCase size={20} />
                  </button>
                </React.Fragment>
              )}
            </div>
          </aside>

          <main className="col-span-12 lg:col-span-8 bg-base-300 px-8 pt-4 pb-20 overflow-y-auto h-full">
            <h1 className="text-xl font-bold">Your library</h1>
            <div className="flex my-5 w-full">
              <label className="input w-10 focus:outline-none focus:ring-0">
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
              </label>
              <input
                type="search"
                className="input grow w-auto focus:outline-none focus:ring-0"
                required
                placeholder="Search game title here"
                value={searchText}
                onChange={(e) => {
                  setSearchText(e.target.value);
                }}
              />
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
                {games?.map((game, index) => (
                  <Link key={index} to={"/games/" + game.id_game}>
                    <GameInfoCard
                      numOfTagsToShow={3}
                      imagePlacement="image-full"
                      name={game.title}
                      description={game.description}
                      tags={game.tags}
                      imageUrl={game.vertical_banner_URL}
                      backgroundColor="base-100"
                      hoverable={true}
                      imageHeight=""
                      cardHeight="md:max-h-40 sm:max-h-30 lg:min-h-85 xl:max-h-100"
                      showTitle={true}
                    />
                  </Link>
                ))}
              </div>
            )}

            {/* TODO: make it so that when adding a filter or searching for a game (or when ordering by something when i add the feature to do that)
            the frontend sends a request to the backend which in turn does a query to get all games that meets the requirements
            (because currently the filters and the search bar only work on the 20 loaded games, which does not make much sense) */}

            {/* section for changing page (to load more games) */}
            <div className="flex items-center w-full mt-4">
              <div className="join mx-auto">
                {/* button for switching to first page */}
                {currentPageNumber !== 1 && (
                  <button
                    className="join-item btn px-4"
                    onClick={() => {
                      if (currentPageNumber !== 1) {
                        fetchGames(1);
                      }
                    }}
                  >
                    {"<<"}
                  </button>
                )}

                {/* button for switching to previous page */}
                {currentPageNumber > 1 && (
                  <button
                    className="join-item btn px-4"
                    onClick={() => {
                      fetchGames(currentPageNumber - 1);
                    }}
                  >
                    {currentPageNumber - 1}
                  </button>
                )}
                {/* current page button */}
                <button className="join-item btn-active bg-primary px-4">
                  {currentPageNumber}
                </button>
                {/* button for switching to next page */}
                {maxPageNumber !== undefined &&
                  currentPageNumber < maxPageNumber && (
                    <button
                      className="join-item btn px-4"
                      onClick={() => {
                        fetchGames(currentPageNumber + 1);
                      }}
                    >
                      {currentPageNumber + 1}
                    </button>
                  )}
                {/* button for switching to last page number */}
                {maxPageNumber && currentPageNumber !== maxPageNumber && (
                  <button
                    className="join-item btn"
                    onClick={() => {
                      fetchGames(maxPageNumber);
                    }}
                  >
                    {">>"}
                  </button>
                )}
              </div>
            </div>
          </main>

          {/*Filters sidebar*/}
          <aside className="col-span-12 lg:col-span-2 bg-base-200 p-4 overflow-y-auto h-full">
            <h2 className="text-lg font-bold">Tag Filters</h2>
            <div className="flex flex-row my-3 gap-2">
              <input
                type="checkbox"
                className="checkbox"
                checked={includeAllFiltersChecked}
                onChange={() => {
                  setIncludeAllFiltersChecked(!includeAllFiltersChecked);
                }}
              />
              <p>Include all filters</p>
            </div>
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
              {/* button to reset filters */}
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
      </BasePageLayout>
      {/* only show modal if the users's pc info has been retrieved */}
      {!isLoadingPcConfiguration && (
        <ComputerComponentModal
          modalId={"pcConfigModal"}
          isOpen={isPcConfigModalOpen}
          modalMode={userComputer ? "Edit" : "Add"}
          defaultMobo={userComputer?.motherboard}
          defaultCpu={userComputer?.cpu}
          defaultRam={userComputer?.ram}
          defaultGpu={userComputer?.gpu}
          closeModal={() => {
            setIsPcConfigModalOpen(false);
          }}
          onResult={() => {
            fetchUserPc();
          }}
        />
      )}
    </React.Fragment>
  );
}
export default App;
