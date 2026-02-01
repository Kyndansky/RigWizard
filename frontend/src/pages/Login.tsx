import { CredentialsCard } from "../components/CredentialsCard";
import { login } from "../misc/api_calls_functions";
import { useAuth } from "../misc/AuthContextHandler";
import React, { useState } from "react";
import Loader from "../components/Loader";
import { BasePageLayout, showToastAlert } from "../components/BasePageLayout";
import { Navigate } from "react-router-dom";

export function Login() {
  //states regarding authentication taken from the AuthContextHandler
  const { isAuthenticated, isLoadingAuthState, setIsAuthenticated } = useAuth();

  //local states
  const [username, setUsername] = useState<string>("");
  const [password, setPassword] = useState<string>("");
  //checks if the users is already logged in, if so, sets the isAuthenticated state to true
  async function handleLogin() {
    const loginResponse = await login(username, password);

    if (loginResponse.successful) {
      setIsAuthenticated(true);
      setUsername(loginResponse.username);
    }
    else {
      showToastAlert("error", loginResponse.message);
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

  //if the user is not authenticated displays the actual login page
  return (
    <React.Fragment>
      <BasePageLayout>
      {isAuthenticated ? (<Navigate to={"/"} />) : (
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
      )}
      </BasePageLayout>

    </React.Fragment>
  );
}
export default Login;
