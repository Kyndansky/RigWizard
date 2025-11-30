import React, { useEffect } from "react";
import { CredentialsCard } from "../components/CredentialsCard";
import { Navigate } from "react-router-dom";
import { getIsLoggedIn, register } from "../api_calls_functions";

export function Register() {
    const [isAuthenticated, setIsAuthenticated] = React.useState<boolean>(false);
    const [username, setUsername] = React.useState<string>("");
    const [password, setPassword] = React.useState<string>("");
    const [errorMessage, setErrorMessage] = React.useState<string>("");
    useEffect(() => {
        (async () => {
            const authenticated = await getIsLoggedIn();
            setIsAuthenticated(authenticated);
        })();

    }, [])

    async function handleRegister() {
        setErrorMessage("");
        if(await register(username,password)){
            window.location.href = '/';
        }
        else{
            setErrorMessage("error");
        }

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