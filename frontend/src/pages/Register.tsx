import React from "react";
import { CredentialsCard } from "../components/CredentialsCard";
import { Navigate } from "react-router-dom";
import { register } from "../misc/api_calls_functions";
import { useAuth } from "../misc/AuthContextHandler";
import { LoadingScreen } from "../components/LoadingScreen";

export function Register() {
    const { isAuthenticated, isLoading, setIsAuthenticated } = useAuth();
    const [username, setUsername] = React.useState<string>("");
    const [password, setPassword] = React.useState<string>("");
    const [errorMessage, setErrorMessage] = React.useState<string>("");

    async function handleRegister() {
        const attemptSuccessful = await register(username, password);
        if (attemptSuccessful) {
            setIsAuthenticated(true);
        }
        else {
            setErrorMessage("error");
        }

    }

    if (isLoading) {
        return (
            <LoadingScreen />
        )
    }

    return (
        <React.Fragment>
            {isAuthenticated ?
                (<Navigate to={"/"} />) :
                (<CredentialsCard
                    cardtitle="Register"
                    buttonText="Sign up"
                    suggestionText="Already have an account?"
                    suggestionLink="/login"
                    suggestionLinkText="Login here"
                    onbuttonclick={handleRegister}
                    onUsernameChange={(e) => setUsername(e.target.value)}
                    onPasswordChange={(e) => setPassword(e.target.value)}
                    username={username}
                    password={password}
                />)}
            <p>{errorMessage}</p>
        </React.Fragment>
    )
}
export default Register;