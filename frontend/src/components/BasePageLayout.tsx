import React from "react";
import NavBar from "./NavBar";

interface BasePageLayoutProps {
    hideOverFlow: boolean;
    selectedTabId?:number;
}

export function showToastAlert(alertType: "error" | "success", message: string) {
    const container = document.getElementById("toastContainer");
    const alert = document.createElement("div");
    alert.className = "alert alert-" + alertType;
    alert.innerHTML = `<span>${message}</span>`;
    container?.appendChild(alert);

    // Rimozione automatica dopo 3 secondi
    setTimeout(() => {
        alert.remove();
    }, 3000);
}
//component for base page layout (so basically just navbar and the rest of the page under it)
export function BasePageLayout(props: React.PropsWithChildren<BasePageLayoutProps>) {
    return (
        <React.Fragment>
            {/*vertical container that contains navbar and page content */}
            <div className={"flex flex-col h-screen bg-base-300" + (props.hideOverFlow ? " overflow-hidden" : "")}>
                <NavBar selectedTabId={props.selectedTabId}/>
                {props.children}
                <div className="toast toast-bottom toast-end" id="toastContainer" />
            </div>
        </React.Fragment>
    )
}