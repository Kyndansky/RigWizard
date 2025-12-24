import React, { useEffect, useState } from "react";
import { useNavigate, useParams } from "react-router-dom";
import type { Game } from "../misc/interfaces";
import { getGameInfo } from "../misc/api_calls_functions";
import { LoadingScreen } from "../components/LoadingScreen";
import { BasePageLayout } from "../components/BasePageLayout";

export function GamePage() {
    const { id } = useParams<{ id: string }>();
    const [game, setGame] = useState<Game | undefined>(undefined);
    const [isLoading, setIsLoading] = useState<boolean>(true);
    const navigate = useNavigate();
    async function fetchGameInfo() {

        if (!id) {
            navigate("/404");
            return;
        }
        //parsing number because it must be a string (since it's a part of the url)
        //and navigating to errorPage if id is invalid
        let idNumber: number = parseInt(id, 10);
        if (isNaN(idNumber)) {
            navigate("/404")
            return;
        }
        //getting response, handling errors etc...

        const response = await getGameInfo(parseInt(id, 10));

        if (!response.successful) {
            navigate("/errorPage")
            return;
        }

        //if response was successful (which means that no problems occurred but no game with that id was found)
        //the user is redirected to the not found page
        if (!response.game) {
            navigate("/404");
            return;
        }
        //the game is set
        setIsLoading(false);
        setGame(response.game);
    }

    useEffect(() => {
        (async () => {
            await fetchGameInfo();
        })();
    }, []);

    if (isLoading) {
        return <LoadingScreen />
    }
    return (
        <React.Fragment>
            <BasePageLayout>
                {game && (
                    <p>{game?.title}</p>
                )}
            </BasePageLayout>
        </React.Fragment>
    )
}

export default GamePage