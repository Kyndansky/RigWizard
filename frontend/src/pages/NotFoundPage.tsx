import React from "react";
import { BasePageLayout } from "../components/BasePageLayout";
import { Link } from "react-router-dom";


export function NotFound() {
    return (
        <React.Fragment>
            <BasePageLayout>
                <div className="h-screen mx-auto grid place-items-center text-center">
                    <div>
                        <h1 className="h-20 mx-auto text-7xl text-secondary">404</h1>
                        <p color="blue-gray" className="mt-6 md:!text-4xl">
                            It looks like something went wrong.
                        </p>
                        <p className="mt-5 mb-5 text-[17px] font-normal text-gray-500 mx-auto md:max-w-sm">
                            The page you are looking for doesn't seem to exist.<br/>Double-check if this is the right page.
                        </p>
                        <Link to={"/"}><button className="btn btn-soft btn-secondary">Homepage</button></Link>
                    </div>
                </div>
            </BasePageLayout>

        </React.Fragment>
    )
}