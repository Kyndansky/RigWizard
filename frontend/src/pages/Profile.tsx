import React from "react"
import { useAuth } from "../misc/AuthContextHandler";

interface ProfilePageProps {
    //props
}

export function Profile(props: ProfilePageProps) {
    const { username } = useAuth();


    return (
        <React.Fragment>
            {username}
        </React.Fragment>
    )
}