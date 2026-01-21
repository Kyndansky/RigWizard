import React, { type PropsWithChildren } from "react";
import { TagList } from "./TagList";
import { motion } from "motion/react";
import { Dot } from "lucide-react";
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
  id: number;
  animate: boolean;
  showGameOwnedBadge: boolean;
  showRequirementsBadge: boolean;
  requirementsMetBadgeColor: "warning" | "success" | "error";
}
export function GameInfoCard(props: PropsWithChildren<GameInfoCardProps>) {
  return (
    <React.Fragment>
      <motion.div
        className={props.hoverable ? "hover-3d" : ""}
        style={{ willChange: "transform" }}
        layout="position"
        initial={props.animate ? { y: 100, opacity: 0 } : {}}
        animate={{ y: 0, opacity: 1 }}
        transition={{
          type: "spring",
          stiffness: 120,
          damping: 20,
          mass: 0.8,
        }}
      >
        <div
          className={
            "card shadow-sm " +
            props.imagePlacement +
            " " +
            props.cardHeight +
            " " +
            (props.backgroundColor
              ? " bg-" + props.backgroundColor + " "
              : "bg-base-100 ")
          }
        >
          <figure className={props.imageHeight}>
            <img
              src={props.imageUrl}
              alt="game image"
              className="w-full h-full object-cover"
            />
          </figure>

          <div className="card-body">
            {props.showTitle && <h2 className="card-title">{props.name}</h2>}
            <p className="text-sm line-clamp-4">{props.description}</p>
            {props.children}
            <div className="card-actions justify-end gap-2 flex z-30 items-end">
              {props.showRequirementsBadge && (
                <div
                  className={
                    "badge badge-outline h-auto text-xs border-" +
                    props.requirementsMetBadgeColor +
                    " text-" +
                    props.requirementsMetBadgeColor
                  }
                >
                  <div className="flex flex-col">
                    <div>Performance</div>
                    <div className="flex flex-row">
                      {props.requirementsMetBadgeColor === "success" ? (
                        <React.Fragment>
                          <Dot />
                        </React.Fragment>
                      ) : props.requirementsMetBadgeColor === "warning" ? (
                        <React.Fragment>
                          <Dot />
                          <Dot />
                        </React.Fragment>
                      ) : (
                        <React.Fragment>
                          <Dot />
                          <Dot />
                          <Dot />
                        </React.Fragment>
                      )}
                    </div>
                  </div>
                </div>
              )}
              <TagList
                tags={props.tags}
                numVisible={props.numOfTagsToShow}
                id={props.id}
              />
            </div>
          </div>
        </div>
        {props.hoverable && <React.Fragment></React.Fragment>}
      </motion.div>
    </React.Fragment>
  );
}
