'use client';
import { useEffect, useRef, useState } from 'react';
import { motion, useMotionValue, animate } from 'motion/react';
import React from 'react';

interface CarouselProps {
    imgUrls: string[];
}

export default function Carousel(props: CarouselProps) {
    const [index, setIndex] = useState(0);
    const containerRef = useRef<HTMLDivElement>(null);

    const x = useMotionValue(0);

    useEffect(() => {
        if (containerRef.current) {
            const containerWidth = containerRef.current.offsetWidth || 1;
            const targetX = -index * containerWidth;

            animate(x, targetX, {
                type: 'spring',
                stiffness: 300,
                damping: 30,
            });
        }
    }, [index, x]);

    return (
        <React.Fragment>
            <div className='w-full h-full'>

                <div className='relative overflow-hidden rounded-lg h-full w-full' ref={containerRef}>
                    <motion.div className='flex' style={{ x }}>
                        {props.imgUrls.map((item) => (
                            <div key={item} className='shrink-0 w-full h-auto'>
                                <img
                                    src={item}
                                    className='w-full h-full object-cover select-none pointer-events-none'
                                    draggable={false}
                                />
                            </div>
                        ))}
                    </motion.div>

                    {/* Navigation Buttons */}
                    <motion.button
                        disabled={index === 0}
                        onClick={() => setIndex((i) => Math.max(0, i - 1))}
                        className={`absolute left-4 top-1/2 -translate-y-1/2 w-10 h-10 rounded-full flex items-center justify-center shadow-lg transition-transform z-10
              ${index === 0
                                ? 'opacity-40 cursor-not-allowed'
                                : 'bg-white hover:scale-110 hover:opacity-100 opacity-70'
                            }`}
                    >
                        <svg
                            className='w-6 h-6'
                            fill='none'
                            stroke='currentColor'
                            viewBox='0 0 24 24'
                        >
                            <path
                                strokeLinecap='round'
                                strokeLinejoin='round'
                                strokeWidth={2}
                                d='M15 19l-7-7 7-7'
                            />
                        </svg>
                    </motion.button>

                    {/* Next Button */}
                    <motion.button
                        disabled={index === props.imgUrls.length - 1}
                        onClick={() => setIndex((i) => Math.min(props.imgUrls.length - 1, i + 1))}
                        className={`absolute right-4 top-1/2 -translate-y-1/2 w-10 h-10 rounded-full flex items-center justify-center shadow-lg transition-transform z-10
              ${index === props.imgUrls.length - 1
                                ? 'opacity-40 cursor-not-allowed'
                                : 'bg-white hover:scale-110 hover:opacity-100 opacity-70'
                            }`}
                    >
                        <svg
                            className='w-6 h-6'
                            fill='none'
                            stroke='currentColor'
                            viewBox='0 0 24 24'
                        >
                            <path
                                strokeLinecap='round'
                                strokeLinejoin='round'
                                strokeWidth={2}
                                d='M9 5l7 7-7 7'
                            />
                        </svg>
                    </motion.button>
                    {/* Progress Indicator */}
                    <div className='absolute bottom-4 left-1/2 -translate-x-1/2 flex gap-2 p-2 bg-white/20 rounded-xl border border-white/30'>
                        {props.imgUrls.map((_, i) => (
                            <button
                                key={i}
                                onClick={() => setIndex(i)}
                                className={`h-2 rounded-full transition-all ${i === index ? 'w-8 bg-white' : 'w-2 bg-white/50'
                                    }`}
                            />
                        ))}
                    </div>
                </div>

            </div>
        </React.Fragment>

    );
}
