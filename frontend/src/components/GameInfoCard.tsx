import React from "react";
interface GameInfoCardProps {
  name: string;
  description: string;
  imageUrl: string;
  tags: string[];
}
export function GameInfoCard(props: GameInfoCardProps) {
  const limitedTags = props.tags.slice(0, 4);
  return (
    <React.Fragment>
      <div className="hover-3d">
        <div className="card bg-base-100 w-auto shadow-sm">
          <figure className="h-60 ">
            <img src={props.imageUrl} alt="Game image" className="w-full h-full"/>
          </figure>

          <div className="card-body ">
            <h2 className="card-title text-primary-content">{props.name}</h2>
            <p className="text-primary-content">{props.description}</p>
            <div className="card-actions justify-end">
              {/* Basically puts every tag around a div that displays it (map is used to cycle all elements in an array and return another value, in this case an html div) */}
              {limitedTags.map((tag, index) => (
                <div key={index} className="badge badge-outline border-secondary text-secondary">{tag}</div>
              ))}
            </div>
          </div>
        </div>
        <div></div>
        <div></div>
        <div></div>
        <div></div>
        <div></div>
        <div></div>
        <div></div>
        <div></div>
        <div></div>
        

      </div>

    </React.Fragment>
  );
}
