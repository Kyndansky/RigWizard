import { createContext, useContext } from "react";
import type { Computer, ComputerInfoResponse } from "./interfaces";
import { useEffect, useState, type ReactNode } from "react";
import { getUserPc } from "./api_calls_functions";

export interface UserComputerInfo {
    userComputer?: Computer;
    isLoadingUserComputer: boolean;
    fetchUserComputer: () => Promise<ComputerInfoResponse>;
}

const UserComputerContext = createContext<UserComputerInfo | undefined>(undefined);

export function UserComputerProvider({ children }: { children: ReactNode }) {
    const [userComputer, setUserComputer] = useState<Computer>();
    const [isLoadingUserComputer, setIsLoadingUserComputer] = useState<boolean>(true);

    const fetchUserComputer = async (): Promise<ComputerInfoResponse> => {
        setIsLoadingUserComputer(true);
        const response = await getUserPc();
        setUserComputer(response.computer);
        setIsLoadingUserComputer(false);
        return response;
    };

    useEffect(() => {
        (async () => {
            fetchUserComputer();
        })();
    }, []);

    const contextValue = { userComputer, isLoadingUserComputer,fetchUserComputer};

    return (
        <UserComputerContext value={contextValue}>
            {children}
        </UserComputerContext>
    )
}


export const useUserComputer = () => {
    const context = useContext(UserComputerContext);
    if (context === undefined) {
        throw new Error('useUserComputerInfo must be used inside UserComputerProvider');
    }
    return context;
}