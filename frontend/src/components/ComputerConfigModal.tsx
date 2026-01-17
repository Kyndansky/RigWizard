import React, { useEffect, useState } from "react";
import { type MotherBoard, type CPU, type GPU, type Ram, type Computer } from "../misc/interfaces";
import { editPcConfiguration, getCpus, getGpus, getMotherboards, getRams } from "../misc/api_calls_functions";
import Loader from "./Loader";
import { showToastAlert } from "./BasePageLayout";
import { ComponentsList } from "./ComponentsList";
import { X } from "lucide-react";
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
    const [selectedMotherboard, setSelectedMotherboard] = useState<MotherBoard>();
    const [selectedCpu, setSelectedCpu] = useState<CPU>();
    const [selectedGpu, setSelectedGpu] = useState<GPU>();
    const [selectedRam, setSelectedRam] = useState<Ram>();
    const [errorMessage, setErrorMessage] = useState<string>("");

    async function fetchMotherboards() {
        if (!props.isOpen) return;
        const fetchedMobosResponse = await getMotherboards();
        if (fetchedMobosResponse.successful && fetchedMobosResponse.motherboards.length > 0) {
            setMotherboards(fetchedMobosResponse.motherboards);
            //if the modal is in edit mode and the mobo in the props is in the fetched motherboards list then we set the
            //selectedMotherboard as the one in the props. same for other components
            if (props.modalMode === "Edit" && fetchedMobosResponse.motherboards.some((mobo) => String(mobo.id) === String(props.defaultMobo?.id))) {
                setSelectedMotherboard(props.defaultMobo);
            }
        }
        else {
            setErrorMessage("Error while retrieving some data");
        }
    }
    async function fetchCpus() {
        if (!props.isOpen) return;
        const fetchedCpusResponse = await getCpus();
        if (fetchedCpusResponse.successful && fetchedCpusResponse.cpus.length > 0) {
            setCpus(fetchedCpusResponse.cpus);
            if (props.modalMode === "Edit" && fetchedCpusResponse.cpus.some((cpu) => String(cpu.id) === String(props.defaultCpu?.id))) {
                setSelectedCpu(props.defaultCpu);
            }
        }
        else {
            setErrorMessage("Error while retrieving some data");
        }
    }
    async function fetchGpus() {
        if (!props.isOpen) return;
        const fetchedGpusResponse = await getGpus();

        if (fetchedGpusResponse.successful && fetchedGpusResponse.gpus.length > 0) {
            setGpus(fetchedGpusResponse.gpus);
            if (props.modalMode === "Edit" && fetchedGpusResponse.gpus.some((gpu) => String(gpu.id) === String(props.defaultGpu?.id))) {
                setSelectedGpu(props.defaultGpu);
            }
        }
        else {
            setErrorMessage("Error while retrieving some data");
        }
    }
    async function fetchRams() {
        if (!props.isOpen) return;
        const fetchedRamsResponse = await getRams();
        if (fetchedRamsResponse.successful && fetchedRamsResponse.rams.length > 0) {
            setRams(fetchedRamsResponse.rams);
            if (props.modalMode === "Edit" && fetchedRamsResponse.rams.some((ram) => String(ram.id) === String(props.defaultRam?.id))) {
                setSelectedRam(props.defaultRam);
            }
        }
        else {
            setErrorMessage("Error while retrieving some data");
        }
    }

    //feth stuff when the modal is opened
    useEffect(() => {
        if (props.modalMode === "Add") {
            // Reset per modalità "Add"
            setSelectedMotherboard(undefined);
            setSelectedCpu(undefined);
            setSelectedGpu(undefined);
            setSelectedRam(undefined);
        }
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
                <div className="modal-box p-7 min-w-2/5">
                    <button className="btn btn-sm btn-circle absolute right-2 top-2 transition duration-350 hover:rotate-90 hover:btn-error " onClick={()=>{
                        props.closeModal();
                    }}><X size={20} strokeWidth={2.5}/></button>
                    <h3 className="text-lg font-bold">{props.modalMode} your pc components here</h3>
                    {motherboards?.length < 1 || cpus?.length < 1 || gpus?.length < 1 || rams?.length < 1 ? (
                        <div className="p-6 mt-10">
                            <Loader />
                        </div>
                    ) : (
                        <React.Fragment>
                            {/* todo: add a mini preview of the user's pc build to the side */}
                            <div className="flex flex-row mt-5 gap-10 items-center w-full">
                                <div className="flex flex-row mx-auto gap-10">
                                    <div className="flex flex-col gap-3">
                                        <fieldset className="fieldset">
                                            <legend className="fieldset-legend block text-xs font-bold uppercase tracking-widest">Motherboard</legend>
                                            <select
                                                className="select"
                                                value={selectedMotherboard?.id?.toString() || "0"}
                                                onChange={(e) => {
                                                    const selectedMoboId = parseInt(e.target.value, 10);
                                                    const mobo = motherboards.find((mobo) => mobo.id === selectedMoboId);
                                                    setSelectedMotherboard(mobo);
                                                }}>
                                                <option disabled={true} value="0">None</option>
                                                {motherboards?.map((motherboard) => (
                                                    <option key={motherboard.id} value={motherboard.id}>{motherboard.model}</option>
                                                ))}
                                            </select>
                                        </fieldset>
                                        <fieldset className="fieldset">
                                            <legend className="fieldset-legend block text-xs font-bold uppercase tracking-widest">CPU</legend>
                                            <select
                                                className="select"
                                                value={selectedCpu?.id?.toString() || "0"}
                                                onChange={(e) => {
                                                    const selectedCpuId = parseInt(e.target.value, 10);
                                                    const cpu = cpus.find((cpu) => cpu.id === selectedCpuId);
                                                    setSelectedCpu(cpu);
                                                }}>
                                                <option disabled={true} value="0">None</option>
                                                {cpus?.map((cpu) => (
                                                    <option key={cpu.id} value={cpu.id}>{cpu.model}</option>
                                                ))}
                                            </select>
                                        </fieldset>
                                        <fieldset className="fieldset">
                                            <legend className="fieldset-legend block text-xs font-bold uppercase tracking-widest">Ram</legend>
                                            <select
                                                className="select"
                                                value={selectedRam?.id?.toString() || "0"}
                                                onChange={(e) => {
                                                    const selectedRamId = parseInt(e.target.value, 10);
                                                    const ram = rams.find((ram) => ram.id === selectedRamId);
                                                    setSelectedRam(ram);
                                                }}>
                                                <option disabled={true} value="0">None</option>
                                                {rams?.map((ram) => (
                                                    <option key={ram.id} value={ram.id}>{ram.model}</option>
                                                ))}
                                            </select>
                                        </fieldset>
                                        <fieldset className="fieldset">
                                            <legend className="fieldset-legend block text-xs font-bold uppercase tracking-widest">GPU</legend>
                                            <select
                                                className="select"
                                                value={selectedGpu?.id?.toString() || "0"}
                                                onChange={(e) => {
                                                    const selectedGpuId = parseInt(e.target.value, 10);
                                                    const gpu = gpus.find((gpu) => gpu.id === selectedGpuId);
                                                    setSelectedGpu(gpu);
                                                }}>
                                                <option disabled={true} value="0">None</option>
                                                {gpus?.map((gpu) => (
                                                    <option key={gpu.id} value={gpu.id}>{gpu.model}</option>
                                                ))}
                                            </select>
                                        </fieldset>
                                    </div>
                                    {selectedCpu && selectedGpu && selectedMotherboard && selectedRam && (
                                        <div className="w-full">
                                            <ComponentsList showGeneralEvaluation={true}
                                                pc={
                                                    {
                                                        cpu: selectedCpu,
                                                        gpu: selectedGpu,
                                                        motherboard: selectedMotherboard,
                                                        ram: selectedRam
                                                    }
                                                }
                                                showRamBrand={true}
                                                bgClass="bg-base-200"

                                            />
                                        </div>

                                    )}
                                </div>

                            </div>
                        </React.Fragment>
                    )}

                    <div className="modal-action">
                        <button className={"btn btn-default "}
                            onClick={props.closeModal}>Cancel</button>
                        <button className={(selectedCpu && selectedGpu && selectedMotherboard && selectedRam) ? "btn btn-success" : "btn btn-success btn-disabled"}
                            onClick={async () => {
                                if (selectedCpu && selectedGpu && selectedMotherboard && selectedRam) {
                                    const pc: Computer = {
                                        cpu: selectedCpu,
                                        gpu: selectedGpu,
                                        ram: selectedRam,
                                        motherboard: selectedMotherboard
                                    }
                                    const response = await editPcConfiguration(pc);
                                    showToastAlert(response.successful ? "success" : "error", response.message);
                                    props.onResult();
                                }
                                props.closeModal();
                            }}>Save</button>
                    </div>
                </div>
            </div>
        </React.Fragment>
    )
}