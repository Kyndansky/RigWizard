import React, { useState } from "react";
import { Link, useLocation, useNavigate } from "react-router-dom";
import { useAuth } from "../misc/AuthContextHandler";
import { logout } from "../misc/api_calls_functions";
import { CircleUserRound, Moon, SunMedium } from "lucide-react";
import { motion } from "motion/react";
interface NavBarProps {
    selectedTabId?: number;
}
interface TabItem {
    id: number;
    pathTo: string;
    text: string;
}
export const tabItems: TabItem[] = [
    {
        id: 1,
        pathTo: "/library",
        text: "Library"
    },
    {
        id: 2,
        pathTo: "/shop",
        text: "Shop"
    },
]
export function NavBar(props: NavBarProps) {
    const location = useLocation();
    const navigate = useNavigate();
    const { isAuthenticated, setIsAuthenticated, username, setUsername, isLoadingAuthState } =
        useAuth();
    const [theme, setTheme] = useState<"light" | "dark">("dark");
    return (
        <React.Fragment>
            <div className="navbar bg-base-100/50 shadow-sm z-1 backdrop-blur-md">
                <div className="navbar-start">
                    <Link to={"/"}><button className="btn btn-ghost text-xl">
                        <motion.h1
                            className="relative bg-linear-to-r from-primary via-purple-600 to-secondary bg-clip-text text-transparent bg-size-[200%_auto]"
                            animate={{
                                backgroundPosition: ["0% 50%", "100% 50%", "0% 50%"],
                            }}
                            transition={{
                                duration: 8,
                                repeat: Infinity,
                                ease: "linear",
                            }}
                        >
                            RigWizard
                        </motion.h1>
                    </button></Link>
                </div>
                <div className="navbar-center">
                    <div role="tablist" className="tabs tabs-border">
                        {tabItems.map((tabItem) => (
                            <a role="tab" className={"tab" + (props.selectedTabId === tabItem.id ? " tab-active" : "")}
                                key={tabItem.text}
                                onClick={() => {
                                    navigate(tabItem.pathTo);
                                }}>{tabItem.text}</a>
                        ))}
                    </div>
                </div>
                <div className="navbar-end gap-3 pr-5">



                    {/*Theme button section*/}
                    <label className="swap swap-rotate ">
                        {/* this hidden checkbox controls the state */}
                        <input type="checkbox" className="theme-controller" value={theme} onClick={() => { theme === "dark" ? setTheme("light") : setTheme("dark") }} />

                        {/* sun icon */}
                        <SunMedium className="swap-off" size={30} />

                        {/* moon icon */}
                        <Moon className="swap-on" size={30} />
                    </label>
                    {isAuthenticated === true && username !== "" && !isLoadingAuthState ? (
                        //Profile info section
                        <div className="dropdown dropdown-end z-100">
                            <div tabIndex={0} role="button" className="btn btn-ghost flex items-center gap-2">
                                <span>
                                    {username}
                                </span>
                                <CircleUserRound />
                            </div>
                            <ul
                                tabIndex={-1}
                                className="menu menu-sm dropdown-content bg-base-100 rounded-box mt-3 w-52 p-2 shadow">
                                <li>
                                    <Link to={'/profile'}>
                                        <p className="justify-between">
                                            Profile
                                        </p>
                                    </Link>

                                </li>
                                <li><a onClick={async () => {
                                    const logoutResponse = await logout();
                                    if (logoutResponse.successful) {
                                        setIsAuthenticated(false);
                                        setUsername("");
                                        window.location.reload();
                                    }

                                }}>Logout</a></li>
                            </ul>
                        </div>
                    ) :
                        (
                            <Link to={"/login"} state={{ from: location.pathname }}>
                                <button className="btn btn-primary btn-soft">Login</button>
                            </Link>
                        )}

                </div>



            </div>
        </React.Fragment>
    )
}
export default NavBar;