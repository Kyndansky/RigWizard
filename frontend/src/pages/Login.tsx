import React, { useEffect } from "react";
import { CredentialsCard } from "../components/CredentialsCard";
import { getIsLoggedIn, login } from "../api_calls_functions";

import { Navigate } from "react-router-dom";

export function Login() {
    const [isAuthenticated, setIsAuthenticated] = React.useState<boolean>(false);
    const [username, setUsername] = React.useState<string>("");
    const [password, setPassword] = React.useState<string>("");
    const [errorMessage, setErrorMessage] = React.useState<string>("");
    const [isLoading, setIsLoading] = React.useState<boolean>(true);


    useEffect(() => {
        (async () => {
            const authenticated = await getIsLoggedIn();
            setIsAuthenticated(authenticated);
            setIsLoading(false);
        })();
    }, [])

    async function handleLogin() {

        const loggedIn = await login(username, password);
        setIsAuthenticated(loggedIn);
        if (!loggedIn)
            setErrorMessage("error");
        else
            setErrorMessage("");
    }
    if (isLoading) {
        return (
            <div>Loading...</div>
        )
    }
    if (isAuthenticated === true) {
        return (
            <Navigate to={"/"} />
        )
    }

    return (
        <React.Fragment>
            <CredentialsCard
                cardtitle="Login"
                buttonText="Log in"
                suggestionText="Are you new here?"
                suggestionLink="/register"
                suggestionLinkText="Register here"
                onbuttonclick={handleLogin}
                onUsernameChange={(e) => setUsername(e.target.value)}
                onPasswordChange={(e) => setPassword(e.target.value)}
                username={username}
                password={password}
            />

            <p>{errorMessage}</p>

        </React.Fragment>
    )
}
export default Login;