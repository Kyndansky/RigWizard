import React from "react";
import type { Computer } from "../misc/interfaces";
import { CircuitBoard, Cpu, Gpu, MemoryStick } from "lucide-react";

interface ComponentsListProps {
    pc: Computer
    descriptionText?: string
    pcToCompareTo?: Computer
}

export function ComponentsList(props: ComponentsListProps) {
    const iconsSize = 20;

    return (
        <React.Fragment>
            <ul className="list bg-base-100 rounded-box shadow-md p-3">
                {props.descriptionText && (
                    <li className="p-4 pb-2 text-sm opacity-60 tracking-wide">{props.descriptionText}</li>
                )}

                <li className="list-row">
                    <div className="flex flex-col">
                        <div className="flex flex-row items-center">
                            Motherboard
                            <CircuitBoard className="ml-2" size={iconsSize} />
                        </div>
                        <div className="text-xs uppercase font-semibold opacity-60">{props.pc.motherboard.model}</div>
                    </div>
                </li>
                <li className="list-row">
                    <div className="flex flex-col">
                        <div className="flex flex-row items-center">
                            CPU
                            <Cpu className="ml-2" size={iconsSize} />
                        </div>
                        <div className="text-xs uppercase font-semibold opacity-60">{props.pc.cpu.model}</div>
                    </div>
                </li>
                <li className="list-row">
                    <div className="flex flex-col">
                        <div className="flex flex-row items-center">
                            Ram
                            <MemoryStick className="ml-2" size={iconsSize} />
                        </div>
                        <div className="text-xs uppercase font-semibold opacity-60">{props.pc.ram.quantity_gb + "GB " + props.pc.ram.memory_type}</div>
                    </div>
                </li>
                <li className="list-row">
                    <div className="flex flex-col">
                        <div className="flex flex-row items-center">
                            GPU
                            <Gpu className="ml-2" size={iconsSize} />
                        </div>
                        <div className="text-xs uppercase font-semibold opacity-60">{props.pc.gpu.model + " " + props.pc.gpu.vram_gb + "GB"}</div>
                    </div>
                </li>
            </ul>
        </React.Fragment>
    )
}