import React from "react";
import type { Game } from "../misc/interfaces";
import { Link } from "react-router-dom";
import { GameInfoCard } from "./GameInfoCard";

interface GameListProps{
    games:Game[];
    layout:"grid"|"rows";
}

export function GameList(props:GameListProps){
    const gridLayoutClasses="grid lg:grid-cols-4 md:grid-cols-2";
    const rowsLayoutClasses="flex flex-col";
    const gridLayoutCardClassname="md:max-h-40 sm:max-h-30 lg:min-h-85 xl:max-h-100";
    const rowsLayoutCardClassname="w-full grow";
    return (
        <React.Fragment>
            <div className={(props.layout==="grid"?gridLayoutClasses:rowsLayoutClasses)+" gap-5"}>
                {props.games?.map((game, index) => (
                  <Link key={index} to={"/games/" + game.id_game}>
                    <GameInfoCard
                      numOfTagsToShow={3}
                      imagePlacement={props.layout==="grid"?"image-full":"card-side"}
                      name={game.title}
                      description={game.description}
                      tags={game.tags}
                      imageUrl={game.vertical_banner_URL}
                      backgroundColor="base-100"
                      hoverable={props.layout==="grid"?true:false}
                      imageHeight=""
                      cardHeight={props.layout==="grid"?gridLayoutCardClassname:rowsLayoutCardClassname}
                      showTitle={true}
                      id={game.id_game}
                    />
                  </Link>
                ))}
              </div>
        </React.Fragment>
    )
}