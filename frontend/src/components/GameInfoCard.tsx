import React from "react";
interface GameInfoCardProps {
  name: string;
  description: string;
  tags: string[];
}
export function GameInfoCard(props: GameInfoCardProps) {
  return (
    <React.Fragment>
      <div className="card bg-base-100 w-96 shadow-sm">
        <figure>
          <img src="img.png" alt="Game image" />
        </figure>
        <div className="card-body">
          <h2 className="card-title">{props.name}</h2>
          <p>{props.description}</p>
          <div className="card-actions justify-end">
            {props.tags.map((tag, index) => (
              <div key={index} className="badge badge-outline">{tag}</div>
            ))}
          </div>
        </div>
      </div>
    </React.Fragment>
  );
}
