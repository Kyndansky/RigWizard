import React, { type PropsWithChildren } from "react";
import { TagList } from "./TagList";
interface GameInfoCardProps {
  name: string;
  description: string;
  imageUrl: string;
  tags: string[];
  imagePlacement: "card-side" | "" | "image-full";
  numOfTagsToShow: number;
  backgroundColor?: string;
  hoverable: boolean;
  imageHeight: string;
  cardHeight: string;
  showTitle: boolean;
}
export function GameInfoCard(props: PropsWithChildren<GameInfoCardProps>) {
  return (
    <React.Fragment>

      <div className={props.hoverable ? "hover-3d" : ""}>
        <div className={"card shadow-sm " + props.imagePlacement + " " + props.cardHeight + " " + (props.backgroundColor ? " bg-" + props.backgroundColor + " " : "bg-base-100 ")}>
          <figure className={props.imageHeight}>
            <img src={props.imageUrl} alt="game image" className="w-full h-full object-cover" />
          </figure>

          <div className="card-body">
            {props.showTitle && <h2 className="card-title">{props.name}</h2>}
            <p className="text-sm line-clamp-4">{props.description}</p>
            {props.children}
            <div className="card-actions justify-end gap-2 flex">
              <TagList tags={props.tags} numVisible={props.numOfTagsToShow} />
            </div>
          </div>
        </div>
        {props.hoverable && (
          <React.Fragment>
            <div></div>
            <div></div>
            <div></div>
            <div></div>
            <div></div>
            <div></div>
            <div></div>
            <div></div>
            <div></div>
          </React.Fragment>
        )}

      </div>

    </React.Fragment>
  );
}
