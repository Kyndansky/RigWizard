import { motion } from "motion/react";
import React from "react";
import { MorphingPopover, MorphingPopoverTrigger, MorphingPopoverContent } from "./Popover";

interface TagListProps {
    tags: string[];
    numVisible: number;
}

export function TagList(props: TagListProps) {
    const showPopover = props.tags.length > props.numVisible;
    const visibleTags = showPopover ? props.tags.slice(0, props.numVisible ) : props.tags;
    const hiddenTags = showPopover ? props.tags.slice(props.numVisible) : [];
    return (
        <React.Fragment>
            {/* showing visible tags normally */}
            {visibleTags.map((tag) => (
                <div key={tag} className="badge badge-outline border-secondary text-secondary text-xs">{tag}</div>
            ))}

            {/* if the popover has to be shown, show it with all the extra tags inside */}
            {showPopover && (
                <MorphingPopover >
                    <MorphingPopoverTrigger asChild>
                        <button className="badge badge-outline border-secondary text-secondary text-xs max-w-[90px]">
                            <motion.span
                                layoutId='morphing-popover-basic-label'
                                layout='position'
                            >
                                <div>
                                    +{hiddenTags.length}
                                </div>
                            </motion.span>
                        </button>
                    </MorphingPopoverTrigger>
                    <MorphingPopoverContent className='p-2 shadow-sm'>
                        <div className="flex flex-col gap-2 p-2">
                            {hiddenTags.map((tag) => (
                                <div key={tag} className="badge badge-outline border-secondary text-secondary text-xs max-w-[90px]">{tag}</div>
                            ))}
                        </div>
                    </MorphingPopoverContent>
                </MorphingPopover>
            )}
        </React.Fragment>
    )
}