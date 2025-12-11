import React, { useEffect, useState } from "react";
import "./App.css";
import { Navigate } from "react-router-dom";
import { getGames, logout } from "./misc/api_calls_functions";
import NavBar from "./components/NavBar";
import { useAuth } from "./misc/AuthContextHandler";
import { LoadingScreen } from "./components/LoadingScreen";
import { ComponentsList } from "./components/ComponentsList";
import { GameInfoCard } from "./components/GameInfoCard";
import type { Game } from "./misc/interfaces";

function App() {
  const [games, setGames] = useState<Game[] | null>(null);
  const [pageNumber, setPageNumber] = useState<number>(1);
  const [errorMessage, setErrorMessage] = useState<string>("");
  const { isAuthenticated, isLoading, setIsAuthenticated, username } =
    useAuth();

  async function fetchGames() {
    const fetchedGamesResponse = await getGames(pageNumber);
    if (fetchedGamesResponse.successful) {
      setGames(fetchedGamesResponse.games);
    }
    else {
      setErrorMessage(fetchedGamesResponse.message);
    }
  }

  useEffect(() => {
    (async () => {
      await fetchGames();
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
            <h2 className="text-lg font-bold">Left sidebar</h2>
            <ComponentsList></ComponentsList>
          </aside>

          <main className="col-span-12 lg:col-span-8 bg-base-300 px-8 pt-4 overflow-y-auto h-full">
            <h1 className="text-xl font-bold">Your library</h1>

            {errorMessage !== "" ? (
              <div role="alert" className="alert alert-error">
                <svg xmlns="http://www.w3.org/2000/svg" className="h-6 w-6 shrink-0 stroke-current" fill="none" viewBox="0 0 24 24">
                  <path strokeLinecap="round" strokeLinejoin="round" strokeWidth="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                <span>{errorMessage}</span>
              </div>
            ) : (
              <div className="grid lg:grid-cols-4 md:grid-cols-2 gap-7 mt-4">
                {games?.map((game, index) => (
                  <GameInfoCard key={index}
                    name={game.name}
                    description={game.description}
                    tags={game.tags}
                    imageUrl={game.imgPath}
                  />
                ))}
              </div>
            )}
            {/*grid containing games to display*/}

          </main>

          {/*Filters sidebar*/}
          <aside className="col-span-12 lg:col-span-2 bg-base-200 p-4 overflow-y-auto h-full">
            <h2 className="text-lg font-bold">Right sidebar</h2>

          </aside>

        </div>

      </div >



    </React.Fragment >
  );
}
export default App;
