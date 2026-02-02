import React from "react";
import { CredentialsCard } from "../components/CredentialsCard";
import { Navigate } from "react-router-dom";
import { register } from "../misc/api_calls_functions";
import { useAuth } from "../misc/AuthContextHandler";
import Loader from "../components/Loader";
import { BasePageLayout, showToastAlert } from "../components/BasePageLayout";

export function Register() {
    const { isAuthenticated, isLoadingAuthState, setIsAuthenticated } = useAuth();
    const [username, setUsername] = React.useState<string>("");
    const [password, setPassword] = React.useState<string>("");

    async function handleRegister() {
        const registerResponse = await register(username, password);
        if (registerResponse.successful === true) {
            setIsAuthenticated(true);
            setUsername(registerResponse.username);
        }
        else {
            showToastAlert("error", registerResponse.message);
        }

    }

    //returns loading if the frontend still doesn't know (which means it hasn't received info from the backend yet)
    //if the user is logged in.
    if (isLoadingAuthState) {
        return <Loader />;
    }

    //if the user is authenticated redirects to the homepage
    if (isAuthenticated === true) {
        window.location.href = "/";
    }

    return (
        <React.Fragment>
            <BasePageLayout >
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
            </BasePageLayout>

        </React.Fragment>
    )
}
export default Register;