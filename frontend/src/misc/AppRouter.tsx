import React from "react";
import App from '../App';
import { Routes, Route } from 'react-router-dom';
import { Login } from "../pages/Login";
import { Register } from "../pages/Register";
import { AuthProvider } from "./AuthContextHandler";
import { Profile } from "../pages/Profile";
import GamePage from "../pages/GamePage";
import { NotFound } from "../pages/NotFoundPage";
import { ErrorPage } from "../pages/ErrorPage";
import { UserComputerProvider } from "./UserComputerContextHandler";
import { GameCollectionPage } from "../pages/GameCollectionPage";
import { getLibraryGames, getShopGames } from "./api_calls_functions";
function AppRouter() {
    return (
        <React.Fragment>
            <AuthProvider>
                <UserComputerProvider>
                    <Routes>
                        <Route path='/' element={<App />} />
                        <Route path='/library' element={<GameCollectionPage key={"library"} gamesCollection="Library" gameCollectionTitleText="Your Library" retrieveGamesFunction={getLibraryGames}/>} />
                        <Route path='/shop' element={<GameCollectionPage key={"shop"} gamesCollection="Shop" gameCollectionTitleText="Shop" retrieveGamesFunction={getShopGames}/>} />
                        <Route path='/login' element={<Login />} />
                        <Route path='/register' element={<Register />} />
                        <Route path="/profile" element={<Profile />} />
                        <Route path="/games/:id" element={<GamePage />} />
                        <Route path="/404" element={<NotFound />} />
                        <Route path="/errorPage" element={<ErrorPage />} />
                        <Route path="*" element={<NotFound />} />
                    </Routes>
                </UserComputerProvider>

            </AuthProvider>

        </React.Fragment>
    )
}
export default AppRouter;