
interface GameCardSkeletonProps {
    withImage: boolean;
}

export function GameCardSkeleton(props: GameCardSkeletonProps) {
    return (
        <div className="w-full">
            {props.withImage === true ? (
                <div className="flex flex-row w-full h-40 bg-base-200 rounded-xl">
                    <div className="skeleton w-2/5 shrink-0" />
                    <div className="flex flex-col gap-3 w-full p-6">
                        <div className="skeleton h-8 w-3/5" />
                        <div className="skeleton h-3 w-full" />
                        <div className="skeleton h-3 w-full" />
                        <div className="skeleton h-3 w-1/3" />
                    </div>
                </div>
            ) : (
                <div className="flex flex-col gap-4 h-80 bg-base-200 rounded-xl p-4">
                    <div className="skeleton h-6 w-full" />
                    <div className="skeleton h-4 w-full mt-3" />
                    <div className="skeleton h-4 w-full" />
                    <div className="skeleton h-4 w-full" />
                    <div className="skeleton h-4 w-full" />
                    <div className="flex flex-row w-full items-end mt-auto gap-4">
                        <div className="skeleton h-4 w-1/4" />
                        <div className="skeleton h-4 w-1/4" />
                        <div className="skeleton h-4 w-1/4" />
                    </div>
                </div>
            )}
        </div>
    );
}