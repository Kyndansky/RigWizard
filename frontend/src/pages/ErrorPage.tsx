import React from "react";
import { BasePageLayout } from "../components/BasePageLayout";

export function ErrorPage() {
    return (
        <React.Fragment>
            <BasePageLayout>
                <p>There was an error while retrieving data</p>
            </BasePageLayout>

        </React.Fragment>
    )
}