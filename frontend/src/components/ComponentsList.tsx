import React from "react";

export function ComponentsList() {
    return (
        <React.Fragment>
            <ul className="menu w-auto">
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