import React, { type PropsWithChildren } from "react";
import { TagList } from "./TagList";
import { motion } from "motion/react";
import { Check } from "lucide-react";
interface GameInfoCardProps {
  name: string;
  description: string;
  imageUrl: string;
  tags: string[];
  imagePlacement: "card-side" | "" | "image-full";
  numOfTagsToShow: number;
  backgroundColor?: string;
  imageHeight: string;
  cardHeight: string;
  showTitle: boolean;
  id: number;
  animate: boolean;
  showGameOwnedBadge: boolean;
  showRequirementsBadge: boolean;
  requirementsMetBadgeColor?: "warning" | "success" | "error";
}
export function GameInfoCard(props: PropsWithChildren<GameInfoCardProps>) {

  const colorMap = {
    warning: {
      badge: "border-warning text-warning",
      dot: "bg-warning",
      text: "Your PC configuration might be able to handle this game's minimum requirements"
    },
    error: {
      badge: "border-error text-error",
      dot: "bg-error",
      text: "Your PC configuration can't handle this game's minimum requirements. You should probably upgrade your PC first."

    },
    success: {
      badge: "border-success text-success",
      dot: "bg-success",
      text: "Your PC configuration can handle this game's minimum requirements"

    }
  };
  const activeColors = colorMap[props.requirementsMetBadgeColor ?? "error"] || {
    badge: "border-gray-500 text-gray-500",
    dot: "bg-gray-500"
  };
  const dotsClassname = `rounded w-[8px] h-[8px] mx-[3px] ${activeColors.dot}`;
  const badgePerformanceClassname = `badge badge-outline text-xs ${activeColors.badge}`;
  const performanceBadgeText = activeColors.text;

  return (
    <React.Fragment>
      <motion.div
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
              src={props.imageUrl && props.imageUrl !== "" ? props.imageUrl : "https://placehold.co/600x400?text=No+Image"}
              onError={(e) => {
                e.currentTarget.src = 'https://placehold.co/600x400/000000/FFF?text=No+Image';
              }}
              alt="game image"
              className="w-full object-cover"
            />
          </figure>

          <div className="card-body">
            <div className="flex flex-row space-between">
              {props.showTitle && <h2 className="card-title flex-2">{props.name}</h2>}
              <div className="tooltip ml-auto" data-tip="In your Library">
                {props.showGameOwnedBadge && (
                  <button className="badge badge-outline text-info border-info max-w-8 p-0.5"><Check className="p-0 m-0" size={20}/></button>
                )}
              </div>

            </div>

            <p className="text-sm line-clamp-4">{props.description}</p>
            {props.children}
            <div className="card-actions justify-end gap-2 flex z-30 items-end">
              {props.showRequirementsBadge && (
                <div className="tooltip" data-tip={performanceBadgeText}>
                  <div className={badgePerformanceClassname}>
                    <div className="flex flex-row gap-2 mx-0">
                      {props.requirementsMetBadgeColor === "success" ? (
                        <React.Fragment>
                          <div className={dotsClassname} />
                          <div className={dotsClassname} />
                          <div className={dotsClassname} />
                        </React.Fragment>
                      ) : props.requirementsMetBadgeColor === "warning" ? (
                        <React.Fragment>
                          <div className={dotsClassname} />
                          <div className={dotsClassname} />
                        </React.Fragment>
                      ) : (
                        <React.Fragment>
                          <div className={dotsClassname} />
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
      </motion.div>
    </React.Fragment>
  );
}
