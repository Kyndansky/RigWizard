import React from "react";
import App from '../App';
import { Routes, Route } from 'react-router-dom';
import { Login } from "../pages/Login";
import { Register } from "../pages/Register";
import { AuthProvider } from "./AuthContextHandler";
import { Profile } from "../pages/Profile";
function AppRouter() {
    return (
        <React.Fragment>
            <AuthProvider>
                <Routes>
                    <Route path='/' element={<App />} />
                    <Route path='/login' element={<Login />} />
                    <Route path='/register' element={<Register />} />
                    <Route path="/profile" element={<Profile/>}/>
                </Routes>
            </AuthProvider>

        </React.Fragment>
    )
}
export default AppRouter;