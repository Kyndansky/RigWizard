import React from "react";
import "./App.css";
import { Navigate } from "react-router-dom";
import { logout } from "./misc/api_calls_functions";
import NavBar from "./components/NavBar";
import { useAuth } from "./misc/AuthContextHandler";
import { LoadingScreen } from "./components/LoadingScreen";
import { ComponentsSideBar } from "./components/ComponentsSideBar";
import { FiltersSideBar } from "./components/FIltersSideBar";
import { GameInfoCard } from "./components/GameInfoCard";

function App() {
  const { isAuthenticated, isLoading, setIsAuthenticated, username } =
    useAuth();

  if (isLoading) {
    return <LoadingScreen />;
  }
  if (!isAuthenticated) {
    return <Navigate to="/login" />;
  }

  return (
    <React.Fragment>
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

      <div className="grid flex-grow grid-cols-10 gap-70">

        {/*pc parts sidebar*/}
        <div className="h-auto rounded">
          <ComponentsSideBar />
        </div>
        
        {/*game section (temporary)*/}
        <div className="h-auto rounded col-span-5">
          <div className="grid grid-cols-4 gap-100">
            <GameInfoCard
              name={"Hollow knight silksong"}
              description={"Cool game"}
              tags={["sigma", "sigmone"]}
            />
            <GameInfoCard
              name={"Hollow knight silksong"}
              description={"Cool game"}
              tags={["sigma", "sigmone"]}
            />
            <GameInfoCard
              name={"Hollow knight silksong"}
              description={"Cool game"}
              tags={["sigma", "sigmone"]}
            />
            <GameInfoCard
              name={"Hollow knight silksong"}
              description={"Cool game"}
              tags={["sigma", "sigmone"]}
            />
            
          </div>
          
        </div>
       <div className="h-auto rounded">
          <FiltersSideBar />
        </div>
      </div>
    </React.Fragment>
  );
}
export default App;
