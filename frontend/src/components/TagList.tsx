import React from "react";

interface TagListProps {
    tags: string[];
    numVisible: number;
    id: number;
}

export function TagList(props: TagListProps) {
    const showPopover = props.tags.length > props.numVisible;
    const visibleTags = showPopover ? props.tags.slice(0, props.numVisible) : props.tags;
    const hiddenTags = showPopover ? props.tags.slice(props.numVisible) : [];
    return (
        <React.Fragment>
            {/* showing visible tags normally */}
            {visibleTags.map((tag) => (
                <div key={tag} className="badge badge-outline border-secondary text-secondary text-xs">{tag}</div>
            ))}
            {/* if there are hidden tags, show the +N badge with popover containing the remaining tags */}
            {hiddenTags.length > 0 && (
                <div className="dropdown dropdown-top dropdown-center dropdown-hover group">
                    <div className="badge badge-outline border-secondary text-secondary text-xs max-w-[90px] h-auto p-1">
                        +{hiddenTags.length}
                    </div>
                    <ul className="dropdown-content z-100 invisible group-hover:visible mb-2">
                        <div className="flex flex-col card card-sm bg-base-300/80 shadow-md gap-2 p-2 items-center w-auto rounded-lg">
                            {hiddenTags.map((tag) => (
                                <div key={tag} className="badge badge-outline border-secondary text-secondary text-xs max-w-[90px] h-auto p-1">{tag}</div>
                            ))}
                        </div>
                    </ul>
                </div>
            )}

        </React.Fragment>
    )
}