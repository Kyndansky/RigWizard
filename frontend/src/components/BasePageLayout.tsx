import React, { type ReactNode } from "react";
import NavBar from "./NavBar";
//component for base page layout (so basically just navbar and the rest of the page under it)
export function BasePageLayout({ children }: { children: ReactNode }) {
    return (
        <React.Fragment>
            {/*vertical container that contains navbar and page content */}
            <div className="flex flex-col h-screen overflow-hidden">
                <NavBar />
                {children}
            </div>
        </React.Fragment>
    )
}