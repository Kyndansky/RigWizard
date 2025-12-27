import React from "react";
import NavBar from "./NavBar";

interface BasePageLayoutProps {
    hideOverFlow:boolean;
}
//component for base page layout (so basically just navbar and the rest of the page under it)
export function BasePageLayout(props: React.PropsWithChildren<BasePageLayoutProps>) {
    return (
        <React.Fragment>
            {/*vertical container that contains navbar and page content */}
            <div className={"flex flex-col h-screen bg-base-300" + (props.hideOverFlow ? " overflow-hidden" : "")}>
                <NavBar />
                {props.children}
            </div>
        </React.Fragment>
    )
}