import React from "react";
import type { Computer, Game } from "../misc/interfaces";
import { Link } from "react-router-dom";
import { GameInfoCard } from "./GameInfoCard";

interface GameListProps {
  games: Game[];
  layout: "grid" | "rows";
  userPc?: Computer;
  showRequirementsMetBadge: boolean;
  showOwnedBadges: boolean;

}

export function GameList(props: GameListProps) {
  const gridLayoutClasses = "grid lg:grid-cols-4 md:grid-cols-2 z-[1]";
  const rowsLayoutClasses = "flex flex-col z-[1]";
  const gridLayoutCardClassname = "md:max-h-40 sm:max-h-30 lg:min-h-85 xl:max-h-100";
  const rowsLayoutCardClassname = "w-full grow";
  return (
    <React.Fragment>
      <div className={(props.layout === "grid" ? gridLayoutClasses : rowsLayoutClasses) + " gap-5"}>
        {props.games?.map((game, index) => {
          let numOfRequirementsMet: number = 0;

          if (props.userPc && game.pc_min_details) {
            if (props.userPc.cpu.score >= game.pc_min_details.cpu.score) numOfRequirementsMet += 1;
            if (props.userPc.gpu.score >= game.pc_min_details.gpu.score) numOfRequirementsMet += 1;
            if (props.userPc.ram.score >= game.pc_min_details.ram.score) numOfRequirementsMet += 1;
            if (props.userPc.motherboard.score >= game.pc_min_details.motherboard.score) numOfRequirementsMet += 1;
          }
          let requirementsBadgeColor: "warning" | "success" | "error" = "error";
          if (numOfRequirementsMet === 4) {
            requirementsBadgeColor = "success";
          }
          else if (numOfRequirementsMet > 0) {
            requirementsBadgeColor = "warning";
          }

          return (
            <Link key={index} to={"/games/" + game.id_game}>
              <GameInfoCard
                numOfTagsToShow={3}
                imagePlacement={props.layout === "grid" ? "image-full" : "card-side"}
                name={game.title}
                description={game.description}
                tags={game.tags}
                imageUrl={props.layout==="grid"?game.vertical_banner_URL:game.vertical_banner_URL}
                backgroundColor="base-100"
                hoverable={props.layout === "grid"}
                imageHeight={props.layout==="rows"?"min-w-3/7 max-w-3/7":""}
                cardHeight={props.layout === "grid" ? gridLayoutCardClassname : rowsLayoutCardClassname}
                showTitle={true}
                id={game.id_game}
                animate={true}
                showGameOwnedBadge={(props.showOwnedBadges && game.isOwned)??false}
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
