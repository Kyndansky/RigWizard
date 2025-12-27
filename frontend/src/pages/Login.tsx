import { CredentialsCard } from "../components/CredentialsCard";
import { login } from "../misc/api_calls_functions";

import { Navigate } from "react-router-dom";
import { useAuth } from "../misc/AuthContextHandler";
import React, { useState } from "react";
import Loader from "../components/Loader";


export function Login() {
  //states regarding authentication taken from the AuthContextHandler
  const { isAuthenticated, isLoading, setIsAuthenticated } = useAuth();
  //local states
  const [username, setUsername] = useState<string>("");
  const [password, setPassword] = useState<string>("");
  const [errorMessage, setErrorMessage] = useState<string>("");

  //checks if the users is already logged in, if so, sets the isAuthenticated state to true
  async function handleLogin() {
    const loginResponse = await login(username, password);

    if (loginResponse.successful) {
      setIsAuthenticated(true);
      setErrorMessage("");
    } else {
        setErrorMessage(loginResponse.message)
    }
  }

  //returns loading if the frontend still doesn't know (which means it hasn't received info from the backend yet)
  //if the user is logged in.
  if (isLoading) {
    return <Loader />;
  }

  //if the user is authenticated redirects to the homepage
  if (isAuthenticated === true) {
    return <Navigate to={"/"} />;
  }

  //if the user is not authenticated displays the actual login page
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
        errorMessage={errorMessage}
      />
    </React.Fragment>
  );
}
export default Login;
