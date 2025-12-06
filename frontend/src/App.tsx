import React from 'react'
import './App.css'
import { Navigate } from 'react-router-dom'
import { logout } from './misc/api_calls_functions';
import NavBar from './components/NavBar';
import { useAuth } from './misc/AuthContextHandler';
import { LoadingScreen } from './components/LoadingScreen';

function App() {
  const { isAuthenticated, isLoading, setIsAuthenticated,username } = useAuth();

  if (isLoading) {
    return (
      <LoadingScreen />
    )
  }
  if (!isAuthenticated) {
    return (
      <Navigate to="/login" />
    )
  }

  return (
    <React.Fragment>
      <NavBar
      username={username===''?undefined:username}
      title="RigWizard"
        onLogoutClickButton={
          async () => {
            const loggedOut = await logout();
            if (loggedOut) {
              setIsAuthenticated(false);
            }
          }
        }
      />
    </React.Fragment>
  )
}
export default App