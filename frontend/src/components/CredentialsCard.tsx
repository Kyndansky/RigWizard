import React from "react";
import { Link } from "react-router-dom";

interface CredentialsCardProps {
  cardtitle?: string;
  buttonlabel?: string;
  buttonText?: string;
  onbuttonclick?: () => void;
  suggestionText?: string;
  suggestionLink?: string;
  suggestionLinkText?: string;
    errorMessage:string;
  username?: string;
  password?: string;
  onUsernameChange: (e: React.ChangeEvent<HTMLInputElement>) => void;
  onPasswordChange: (e: React.ChangeEvent<HTMLInputElement>) => void;
}

export function CredentialsCard(props: CredentialsCardProps) {
  return (
    <React.Fragment>
      <div className="flex flex-col justify-center items-center h-screen my-auto mx-auto">
        <fieldset className="fieldset bg-base-200 border-base-300 rounded-box w-xs border p-8 mx-auto">
          <h2 className="card-title">{props.cardtitle}</h2>
          <label className="label">Username</label>
          <input
            type="text"
            className="input"
            placeholder="Username"
            value={props.username}
            onChange={props.onUsernameChange}
          />
          <label className="label">Password</label>
          <input
            type="password"
            className="input"
            placeholder="Password"
            value={props.password}
            onChange={props.onPasswordChange}
          />

          <button
            className="btn btn-primary mt-2 mb-2"
            id="signinButton"
            onClick={props.onbuttonclick}
          >
            {props.buttonText}
          </button>
          {props.suggestionLink &&
          props.suggestionLinkText &&
          props.suggestionText ? (
            <p>
              {props.suggestionText}{" "}
              <Link to={props.suggestionLink} className="link link-primary ">
                {props.suggestionLinkText}
              </Link>
            </p>
            
          ) : null}
          {props.errorMessage !== "" ? (
          <div className="toast toast-top toast-end">
            <div className="alert alert-error">
              <span>{props.errorMessage}</span>
            </div>
          </div>
        ) : null}
          
        </fieldset>
        
      </div>
    </React.Fragment>
  );
}
export default CredentialsCard;
