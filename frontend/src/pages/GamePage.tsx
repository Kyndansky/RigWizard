import React, { useEffect, useState } from "react";
import { useNavigate, useParams } from "react-router-dom";
import { type Game } from "../misc/interfaces";
import { addGameToLibrary, getGameInfo } from "../misc/api_calls_functions";
import { BasePageLayout, showToastAlert } from "../components/BasePageLayout";
import Loader from "../components/Loader";
import Carousel from "../components/Carousel";
import { useTagsCount } from "../hooks/useTagsCount";
import { GameInfoCard } from "../components/GameInfoCard";
import { ComponentsList } from "../components/ComponentsList";
import { useUserComputer } from "../misc/UserComputerContextHandler";

export function GamePage() {
    const numTagsVisible = useTagsCount();
    const { id } = useParams<{ id: string }>();
    const [game, setGame] = useState<Game | undefined>(undefined);
    const [isLoading, setIsLoading] = useState<boolean>(true);
    const { userComputer } = useUserComputer();
    const navigate = useNavigate();

    async function fetchGameInfo() {
        if (!id) {
            navigate("/404");
            return;
        }
        //parsing number because it must be a string (since it's a part of the url)
        //and navigating to 404 page if id is invalid
        let idNumber: number = parseInt(id, 10);
        if (isNaN(idNumber)) {
            navigate("/404")
            return;
        }
        //getting response, handling errors etc...
        const response = await getGameInfo(idNumber);
        if (!response.successful) {
            navigate("/404");
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
        return (
            <BasePageLayout hideOverFlow={false}>
                <Loader />
            </BasePageLayout>
        );
    }
    return (
        <BasePageLayout hideOverFlow={true}>
            {game &&
                (
                    <React.Fragment>
                        <div className="w-full bg-base-300 overflow-y-auto">
                            <div className="w-5/7 mx-auto">
                                <div className="card bg-base-100 mx-auto xs:w-full p-5 xs:mt-5 mt-10 mb-5">
                                    <div className="card-body">
                                        <div className="flex flex-row">
                                            <h2 className="card-title text-3xl">{game.title}</h2>
                                            <button className="btn btn-info btn-soft w-auto ml-auto"
                                                disabled={game.isOwned}
                                                onClick={async () => {
                                                    const response = await addGameToLibrary(game.id_game);
                                                    showToastAlert(response.successful ? "success" : "error", response.message);
                                                    if (response.successful) {
                                                        //copies all properties from game except isOwned, which is explicitly specified
                                                        setGame({...game, isOwned: true});
                                                    }
                                                }}
                                            >
                                                {game.isOwned ? (
                                                    <p>Game owned</p>
                                                ) : (
                                                    <p>Add to library</p>
                                                )}
                                            </button>
                                        </div>
                                        <div className="mx-auto w-full">
                                            <div className="w-9/10 flex flex-row items-stretch gap-4 mx-auto mt-3">
                                                <div className="w-1/2 relative min-h-0">
                                                    <div className="absolute inset-0">
                                                        <Carousel imgUrls={game.images}/>
                                                    </div>
                                                </div>
                                                <div className="w-1/2">
                                                    <GameInfoCard
                                                        name={game.title}
                                                        description={game.description}
                                                        tags={game.tags}
                                                        imagePlacement=""
                                                        imageUrl={game.horizontal_banner_URL}
                                                        numOfTagsToShow={numTagsVisible}
                                                        backgroundColor="base-300"
                                                        hoverable={false}
                                                        imageHeight="h-auto"
                                                        cardHeight=""
                                                        showTitle={false}
                                                        id={game.id_game}
                                                        animate={false}
                                                        showRequirementsBadge={false}
                                                        showGameOwnedBadge={false}
                                                    />
                                                </div>
                                            </div>
                                            <div className="divider divider-vertical" />
                                            {/* example of extended description which will be removed later */}
                                            <div className="collapse collapse-arrow mt-3 w-full mx-auto">
                                                <input type="checkbox" className="peer" defaultChecked={true} />
                                                <div className="collapse-title bg-base-200 w-full peer-checked:bg-base-300 w-fit">
                                                    Show description
                                                </div>
                                                <div className="collapse-content bg-base-200 w-full peer-checked:bg-base-300">
                                                    <h1 className="text-2xl text-primary mt-5">
                                                        Example paragraph title
                                                    </h1>
                                                    <p>
                                                        Lorem ipsum dolor sit amet consectetur adipisicing elit. Recusandae maiores unde non. Eaque, sit consequuntur. Reiciendis, molestiae eveniet repellendus atque, praesentium molestias dolorem obcaecati, alias accusantium maxime pariatur earum nihil?
                                                    </p>
                                                    <h1 className="text-2xl text-primary mt-5">
                                                        Example paragraph title
                                                    </h1>
                                                    <p>
                                                        Lorem ipsum dolor sit amet consectetur adipisicing elit. Recusandae maiores unde non. Eaque, sit consequuntur. Reiciendis, molestiae eveniet repellendus atque, praesentium molestias dolorem obcaecati, alias accusantium maxime pariatur earum nihil?
                                                    </p>
                                                    <h1 className="text-2xl text-primary mt-5">
                                                        Example paragraph title
                                                    </h1>
                                                    <p>
                                                        Lorem ipsum dolor sit amet consectetur adipisicing elit. Recusandae maiores unde non. Eaque, sit consequuntur. Reiciendis, molestiae eveniet repellendus atque, praesentium molestias dolorem obcaecati, alias accusantium maxime pariatur earum nihil?
                                                    </p>
                                                    <h1 className="text-2xl text-primary mt-5">
                                                        Example paragraph title
                                                    </h1>
                                                    <p>
                                                        Lorem ipsum dolor sit amet consectetur adipisicing elit. Recusandae maiores unde non. Eaque, sit consequuntur. Reiciendis, molestiae eveniet repellendus atque, praesentium molestias dolorem obcaecati, alias accusantium maxime pariatur earum nihil?
                                                    </p>
                                                    <h1 className="text-2xl text-primary mt-5">
                                                        Example paragraph title
                                                    </h1>
                                                    <p>
                                                        Lorem ipsum dolor sit amet consectetur adipisicing elit. Recusandae maiores unde non. Eaque, sit consequuntur. Reiciendis, molestiae eveniet repellendus atque, praesentium molestias dolorem obcaecati, alias accusantium maxime pariatur earum nihil?
                                                    </p>
                                                </div>
                                            </div>
                                            <div>
                                            </div>
                                            <div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                {/* pc requirements */}
                                <div className="collapse collapse-arrow mt-5 w-full mx-auto mb-5">
                                    <input type="checkbox" className="peer" defaultChecked={true} />
                                    <div className="collapse-title bg-base-200 w-full peer-checked:bg-base-100 w-fit">
                                        Requirements
                                    </div>
                                    <div className="collapse-content bg-base-200 w-full peer-checked:bg-base-100">
                                        <div className="flex flex-row justify-center grow items-center mt-2 mx-5 mb-3 gap-5">
                                            {userComputer ? (
                                                <React.Fragment>
                                                    <ComponentsList pc={userComputer}
                                                        descriptionText="Your PC"
                                                        showGeneralEvaluation={true}
                                                        showRamBrand={true}
                                                        bgClass="bg-primary" />
                                                    <ComponentsList pc={game.pc_min_details}
                                                        descriptionText="Minimum"
                                                        showGeneralEvaluation={false}
                                                        showRamBrand={false}
                                                        bgClass="bg-base-200"
                                                        pcToBeCompared={userComputer}

                                                    />
                                                    <ComponentsList pc={game.pc_rec_details}
                                                        descriptionText="Recommended"
                                                        showGeneralEvaluation={false}
                                                        showRamBrand={false}
                                                        bgClass="bg-base-200"
                                                        pcToBeCompared={userComputer}
                                                    />
                                                </React.Fragment>
                                            ) :
                                                (
                                                    <React.Fragment>
                                                        <ComponentsList pc={game.pc_min_details} descriptionText="Minimum" showGeneralEvaluation={true} showRamBrand={false} bgClass="bg-base-200" />
                                                        <ComponentsList pc={game.pc_rec_details} descriptionText="Recommended" showGeneralEvaluation={true} showRamBrand={false} bgClass="bg-base-200" />
                                                    </React.Fragment>
                                                )}

                                        </div>
                                    </div>
                                </div>
                            </div>


                        </div>
                    </React.Fragment>
                )
            }
        </BasePageLayout >
    );
}

export default GamePage