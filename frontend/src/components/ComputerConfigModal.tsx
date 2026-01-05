import React, { useEffect, useState } from "react";
import { type MotherBoard, type CPU, type GPU, type Ram } from "../misc/interfaces";
import { getCpus, getGpus, getMotherboards, getRams } from "../misc/api_calls_functions";
import Loader from "./Loader";
interface ComputerComponentsModalProps {
    isOpen: boolean;
    modalMode: "Edit" | "Add";
    modalId: string;
    closeModal: () => void;
    onResult: () => void;
    defaultMobo?: MotherBoard;
    defaultCpu?: CPU;
    defaultGpu?: GPU;
    defaultRam?: Ram;
}


export function ComputerComponentModal(props: ComputerComponentsModalProps) {
    const [motherboards, setMotherboards] = useState<MotherBoard[]>([]);
    const [cpus, setCpus] = useState<CPU[]>([]);
    const [gpus, setGpus] = useState<GPU[]>([]);
    const [rams, setRams] = useState<Ram[]>([]);
    const [errorMessage, setErrorMessage] = useState<string>("");
    async function fetchMotherboards() {
        const fetchedMobosResponse = await getMotherboards();
        if (fetchedMobosResponse.successful) {
            setMotherboards(fetchedMobosResponse.motherboards);
        }
        else {
            setErrorMessage("Error while retrieving some data");
        }
    }
    async function fetchCpus() {
        const fetchedCpusResponse = await getCpus();
        if (fetchedCpusResponse.successful) {
            setCpus(fetchedCpusResponse.cpus);
        }
        else {
            setErrorMessage("Error while retrieving some data");
        }
    }
    async function fetchGpus() {
        const fetchedGpusResponse = await getGpus();
        if (fetchedGpusResponse.successful) {
            setGpus(fetchedGpusResponse.gpus);
        }
        else {
            setErrorMessage("Error while retrieving some data");
        }
    }
    async function fetchRams() {
        const fetchedRamsResponse = await getRams();
        if (fetchedRamsResponse.successful) {
            setRams(fetchedRamsResponse.rams);
        }
        else {
            setErrorMessage("Error while retrieving some data");
        }
    }

    //feth stuff when the modal is opened
    useEffect(() => {
        (async () => {
            if (props.isOpen) {
                //basically runs all functions at the same time (better than awaiting all of them)
                Promise.all([
                    fetchMotherboards(),
                    fetchCpus(),
                    fetchGpus(),
                    fetchRams()
                ]);
            }
        })();
    }, [props.isOpen]);
    return (
        <React.Fragment>
            <input type="checkbox" id={props.modalId} className="modal-toggle" checked={props.isOpen} />
            <div className="modal" role="dialog">
                <div className="modal-box">
                    <h3 className="text-lg font-bold">{props.modalMode} your pc components here</h3>
                    {motherboards?.length < 1 || cpus?.length < 1 || gpus?.length < 1 || rams?.length < 1 ? (
                        <Loader />
                    ) : (
                        <React.Fragment>
                            {/* todo: add a mini preview of the user's pc build to the side */}
                            <fieldset className="fieldset">
                                <legend className="fieldset-legend">Motherboard</legend>
                                <select
                                    defaultValue={props.modalMode === "Edit" && props.defaultMobo ? props.defaultMobo.id : "None"} className="select">
                                    <option disabled={true} value="None">None</option>
                                    {motherboards?.map((motherboard) => (
                                        <option key={motherboard.id} value={motherboard.id}>{motherboard.model}</option>
                                    ))}
                                </select>
                            </fieldset>
                            <fieldset className="fieldset">
                                <legend className="fieldset-legend">CPU</legend>
                                <select
                                    defaultValue={props.modalMode === "Edit" && props.defaultCpu ? props.defaultCpu.id : "None"} className="select">
                                    <option disabled={true} value="None">None</option>
                                    {cpus?.map((cpu) => (
                                        //cpus, rams and gpus aren't shown, fixing next time
                                        <option key={cpu.id} value={cpu.id}>{cpu.model}</option>
                                    ))}
                                </select>
                            </fieldset>
                            <fieldset className="fieldset">
                                <legend className="fieldset-legend">GPU</legend>
                                <select
                                    defaultValue={props.modalMode === "Edit" && props.defaultGpu ? props.defaultGpu.id : "None"} className="select">
                                    <option disabled={true} value="None">None</option>
                                    {gpus?.map((gpu) => (
                                        //cpus, rams and gpus aren't shown, fixing next time
                                        <option key={gpu.id} value={gpu.id}>{gpu.model}</option>
                                    ))}
                                </select>
                            </fieldset>
                            <fieldset className="fieldset">
                                <legend className="fieldset-legend">Ram</legend>
                                <select
                                    defaultValue={props.modalMode === "Edit" && props.defaultRam ? props.defaultRam.id : "None"} className="select">
                                    <option disabled={true} value="None">None</option>
                                    {rams?.map((rams) => (
                                        //cpus, rams and gpus aren't shown, fixing next time
                                        <option key={rams.id} value={rams.id}>{rams.model}</option>
                                    ))}
                                </select>
                            </fieldset>
                        </React.Fragment>
                    )}

                    <div className="modal-action">
                        <button className="btn btn-default" onClick={() => {
                            props.onResult();
                            props.closeModal();
                        }}>Cancel</button>
                        <button className="btn btn-success" onClick={props.closeModal}>Save</button>
                    </div>
                </div>
            </div>
        </React.Fragment>
    )
}