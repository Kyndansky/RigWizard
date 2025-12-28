import { useState, useEffect } from 'react';
//this hook returns the number of tags to show based on the screen size

export function useTagsCount() {
    const [count, setCount] = useState(3);

    useEffect(() => {
        const updateCount = () => {
            const width = window.innerWidth;
            if (width >= 1280) setCount(10);      // xl
            else if (width >= 1024) setCount(8);  // lg
            else if (width >= 768) setCount(6);   // md
            else if (width >= 640) setCount(4);   // sm
            else setCount(3);                     // xs
        };

        updateCount();
        window.addEventListener('resize', updateCount);
        return () => window.removeEventListener('resize', updateCount);
    }, []);

    return count;
}