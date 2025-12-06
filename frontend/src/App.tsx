import React from 'react'
import './App.css'
import { Navigate } from 'react-router-dom'
import { logout } from './misc/api_calls_functions';
import NavBar from './components/NavBar';
import { useAuth } from './misc/AuthContextHandler';

function App() {
  const { isAuthenticated, isLoading, setIsAuthenticated } = useAuth();

  if (isLoading) {
    return (
      <div>Loading...</div>
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