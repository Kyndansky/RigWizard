import React from "react";
import App from './App';
import { Routes, Route } from 'react-router-dom';
import { Login } from "./pages/Login";
import { Register } from "./pages/Register";
function AppRouter() {
return(
    <React.Fragment>
    <Routes>
        <Route path='/' element={<App />} />
        <Route path='/login' element={<Login />} />
        <Route path='/register' element={<Register />} />

    </Routes>
    </React.Fragment>
)
}
export default AppRouter;