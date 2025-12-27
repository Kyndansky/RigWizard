import React from "react";
import { CredentialsCard } from "../components/CredentialsCard";
import { Navigate } from "react-router-dom";
import { register } from "../misc/api_calls_functions";
import { useAuth } from "../misc/AuthContextHandler";
import Loader from "../components/Loader";

export function Register() {
    const { isAuthenticated, isLoading, setIsAuthenticated } = useAuth();
    const [username, setUsername] = React.useState<string>("");
    const [password, setPassword] = React.useState<string>("");
    const [errorMessage, setErrorMessage] = React.useState<string>("");

    async function handleRegister() {
        const registerResponse = await register(username, password);
        if (registerResponse.successful===true) {
            setIsAuthenticated(true);
            setUsername(registerResponse.username);
        }
        else {
            setErrorMessage(registerResponse.message||"error");
        }

    }

    if (isLoading) {
        return (
            <Loader />
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
                    errorMessage={errorMessage}
                />)}
        </React.Fragment>
    )
}
export default Register;