interface ChoiceCardProps {
    title?: string;
    description?: string;
    button1Text?: string;
    button2Text?: string;
    onButton1Click?: () => void;
    onButton2Click?: () => void;
}

function ChoiceCard(props: ChoiceCardProps) {
    return (
        <div className="card bg-base-100 w-96 shadow-sm">
            <div className="card-body">
                <h2 className="card-title">{props.title}</h2>
                <p>{props.description}</p>
                <div className="card-actions justify-end">
                    <button className="btn btn-primary">{props.button1Text}</button>
                    <button className="btn btn-secondary">{props.button2Text}</button>
                </div>
            </div>
        </div>
    )
}
export default ChoiceCard;