import React from "react";
interface ComputerComponentsModalProps {
    isOpen: boolean;
    modalMode:"Edit"|"Add";
    modalId:string;
    closeModal:()=>void;
    onResult:()=>void;
}


export function ComputerComponentModal(props: ComputerComponentsModalProps) {
    return (
        <React.Fragment>
            <input type="checkbox" id={props.modalId} className="modal-toggle" checked={props.isOpen} />
            <div className="modal" role="dialog">
                <div className="modal-box">
                    <h3 className="text-lg font-bold">{props.modalMode} your pc components here</h3>

                    <div className="modal-action">
                        <button className="btn btn-default" onClick={()=>{
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