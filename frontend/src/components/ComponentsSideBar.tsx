import React from "react";

export function ComponentsSideBar() {
    return (
        <React.Fragment>
            <ul className="menu bg-base-200 rounded-box w-60 my-auto">
                <li>
                    <details open>
                        <summary>Computer</summary>
                        <ul>
                            <li>
                                <details open>
                                    <summary>CPU</summary>
                                    <ul>
                                        <li>Manufacturer</li>
                                        <li>Frequency</li>
                                        <li>Model</li>
                                    </ul>
                                </details>
                            </li>
                            <li>
                                <details open>
                                    <summary>GPU</summary>
                                    <ul>
                                        <li>Manufacturer</li>
                                        <li>Model</li>
                                    </ul>
                                </details>
                            </li>
                            <li>
                                <details open>
                                    <summary>Ram</summary>
                                    <ul>
                                        <li>Brand</li>
                                        <li>Frequency</li>
                                        <li>Model</li>
                                    </ul>
                                </details>
                            </li>
                            <li>
                                <details open>
                                    <summary>Motherboard</summary>
                                    <ul>
                                        <li>Brand</li>
                                        <li>Model</li>
                                    </ul>
                                </details>
                            </li>
                        </ul>
                    </details>
                </li>
            </ul>
        </React.Fragment>
    )
}