import { createContext, useContext, useEffect, useState, type ReactNode } from "react";
import { getIsLoggedIn } from "./api_calls_functions";

export interface AuthInfo{
    isAuthenticated:boolean;
    isLoading:boolean;
    setIsAuthenticated:(isAuthenticated:boolean)=>void;
    username?:string
}


//the context is an object created only once.
//https://react.dev/reference/react/createContext explains this well.
const AuthContext = createContext<AuthInfo | undefined>(undefined);

//authprovider handles the context and gives it to children components
//(it contains info like if the user is logged in etc..)
export function AuthProvider({children}:{children:ReactNode}){
    const [isAuthenticated,setIsAuthenticated]=useState(false);
    const [isLoading,setIsLoading]=useState(true);
    const [username,setUsername]=useState<string>("");

    useEffect(()=>{
        (async ()=>{
            const response=await getIsLoggedIn();
            setIsAuthenticated(response.successful);
            setUsername(response.username);
            setIsLoading(false);
        })();
    },[]);

    const contextValue={isAuthenticated,isLoading,setIsAuthenticated,username};

    return(
        <AuthContext value={contextValue}>
            {children}
        </AuthContext>
    )

}

export const useAuth = () => {
  const context = useContext(AuthContext);
  
  if (context === undefined) {
    throw new Error('useAuth useUserComputerInfo must be used inside AuthContextProvider');
  }
  return context;
};