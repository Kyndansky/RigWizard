import React from "react";
import type { Computer, Game } from "../misc/interfaces";
import { Link } from "react-router-dom";
import { GameInfoCard } from "./GameInfoCard";

interface GameListProps{
    games:Game[];
    layout:"grid"|"rows";
    userPc?:Computer;
    showRequirementsMetBadge:boolean;
}

export function GameList(props:GameListProps){
    const gridLayoutClasses="grid lg:grid-cols-4 md:grid-cols-2";
    const rowsLayoutClasses="flex flex-col";
    const gridLayoutCardClassname="md:max-h-40 sm:max-h-30 lg:min-h-85 xl:max-h-100";
    const rowsLayoutCardClassname="w-full grow";
    return (
        <React.Fragment>
            <div className={(props.layout==="grid"?gridLayoutClasses:rowsLayoutClasses)+" gap-5"}>
                {props.games?.map((game, index) => {
                  console.log("pc");
                  console.log(game.pc_min_details);
          let numOfRequirementsMet: number = 0;

          if (props.userPc && game.pc_min_details) {
            if (props.userPc.cpu.score >= game.pc_min_details.cpu.score) numOfRequirementsMet+=1;
            if (props.userPc.gpu.score >= game.pc_min_details.gpu.score) numOfRequirementsMet+=1;
            if (props.userPc.ram.score >= game.pc_min_details.ram.score) numOfRequirementsMet+=1;
            if (props.userPc.motherboard.score >= game.pc_min_details.motherboard.score) numOfRequirementsMet+=1;
          }
          let requirementsBadgeColor:"warning"|"success"|"error"="error";
          if(numOfRequirementsMet===0){
            requirementsBadgeColor="error";
          }
          else if(numOfRequirementsMet<4){
            requirementsBadgeColor="warning";
          }
          else{
            requirementsBadgeColor="error";
          }

          return (
            <Link key={index} to={"/games/" + game.id_game}>
              <GameInfoCard
                numOfTagsToShow={3}
                imagePlacement={props.layout === "grid" ? "image-full" : "card-side"}
                name={game.title}
                description={game.description}
                tags={game.tags}
                imageUrl="https://i.postimg.cc/W38kRTh1/silksong-horizontal-banner.jpg"
                backgroundColor="base-100"
                hoverable={props.layout === "grid"}
                imageHeight=""
                cardHeight={props.layout === "grid" ? gridLayoutCardClassname : rowsLayoutCardClassname}
                showTitle={true}
                id={game.id_game}
                animate={true}
                showGameOwnedBadge={true}
                showRequirementsBadge={props.showRequirementsMetBadge}
                requirementsMetBadgeColor={requirementsBadgeColor}
              />
            </Link>
          );
        })}
              </div>
        </React.Fragment>
    )
}
