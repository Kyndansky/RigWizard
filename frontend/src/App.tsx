import React, { useEffect, useState } from 'react'

import './App.css'
import { Navigate } from 'react-router-dom'
import { getIsLoggedIn, logout } from './api_calls_functions';
import NavBar from './components/NavBar';

function App() {
  const [isAuthenticated, setIsAuthenticated] = useState<boolean>(false);
  const [isLoading, setIsLoading] = useState<boolean>(true);
  useEffect(() => {
    (async () => {
      const authenticated = await getIsLoggedIn();
      setIsAuthenticated(authenticated);
      setIsLoading(false);
    })();

  }, [])

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
            await logout();
            setIsAuthenticated(false);
          }
        }
        
        />
    </React.Fragment>
  )
}
export default App