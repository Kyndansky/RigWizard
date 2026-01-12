import React from "react";
import type { Computer } from "../misc/interfaces";
import { CircuitBoard, Cpu, Gpu, MemoryStick } from "lucide-react";

interface ComponentsListProps {
    pc: Computer;
    descriptionText?: string;
    pcToCompareTo?: Computer;
    showGeneralEvaluation: boolean;
    showRamBrand: boolean;
    bg?: string
}

export function ComponentsList(props: ComponentsListProps) {
    const iconsSize = 20;
    let totalScore = 0;
    let percentage = 0;
    let hue = 120;
    let progressEvaluationColor: string = "#fffff";

    if (props.showGeneralEvaluation) {
        //in this case 40 is the max score (10 max per component)
        totalScore = props.pc.cpu.score + props.pc.gpu.score + props.pc.motherboard.score + props.pc.ram.score;
        percentage = Math.round((totalScore / 40) * 100);
        // find tonality based on the score: 0 is red, 120 is green
        // (using HSL color circle or whatever it is called)
        hue = (totalScore / 40) * 120;

        // Genera la stringa HSL
        progressEvaluationColor = `hsl(${hue}, 80%, 45%)`;
    }

    return (
        <React.Fragment>
            <ul className={"list rounded-box shadow-md p-2 w-full bg-" + (props.bg ?? "base-100")}>
                {props.descriptionText && (
                    <li className="p-4 pb-2 text-sm opacity-60 tracking-wide">{props.descriptionText}</li>
                )}

                <li className={"list-row bg-" + (props.bg ?? "base-100")}>
                    <div className="flex flex-col">
                        <div className="flex flex-row items-center">
                            Motherboard
                            <CircuitBoard className="ml-2" size={iconsSize} />
                        </div>
                        <div className="text-xs uppercase font-semibold opacity-60">{props.pc.motherboard.manufacturer + " " + props.pc.motherboard.model}</div>
                    </div>
                </li>
                <li className={"list-row bg-" + (props.bg ?? "base-100")}>
                    <div className="flex flex-col">
                        <div className="flex flex-row items-center">
                            CPU
                            <Cpu className="ml-2" size={iconsSize} />
                        </div>
                        <div className="text-xs uppercase font-semibold opacity-60">{props.pc.cpu.manufacturer + " " + props.pc.cpu.model}</div>
                    </div>
                </li>
                <li className={"list-row bg-" + (props.bg ?? "base-100")}>
                    <div className="flex flex-col">
                        <div className="flex flex-row items-center">
                            Ram
                            <MemoryStick className="ml-2" size={iconsSize} />
                        </div>
                        <div className="text-xs uppercase font-semibold opacity-60">{(props.showRamBrand ? props.pc.ram.brand + " " : "") + props.pc.ram.quantity_gb + "GB " + props.pc.ram.type}</div>
                    </div>
                </li>
                <li className={"list-row bg-" + (props.bg ?? "base-100")}>
                    <div className="flex flex-col">
                        <div className="flex flex-row items-center">
                            Graphics Card
                            <Gpu className="ml-2" size={iconsSize} />
                        </div>
                        <div className="text-xs uppercase font-semibold opacity-60">{props.pc.gpu.manufacturer + " " + props.pc.gpu.model + " " + props.pc.gpu.vram_gb + "GB"}</div>
                    </div>
                </li>
                {props.showGeneralEvaluation && (
                    <li className={"list-row items-center grow mx-auto bg-" + (props.bg ?? "base-100")}>
                        {/* For TSX uncomment the commented types below */}
                        <div className="radial-progress" aria-setsize={2}
                            style={{
                                "--value": percentage,
                                "--size": "3.5rem",
                                "color": progressEvaluationColor
                            } as React.CSSProperties}
                            aria-valuenow={percentage}
                            role="progressbar">{percentage}%</div>
                    </li>
                )}
            </ul>
        </React.Fragment>
    )
}