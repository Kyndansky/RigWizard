import React, { useState } from "react";
import { Link } from "react-router-dom";
import { useAuth } from "../misc/AuthContextHandler";
import { logout } from "../misc/api_calls_functions";
import { CircleUserRound, Moon, SunMedium } from "lucide-react";
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

    const { isAuthenticated, setIsAuthenticated, username } =
        useAuth();
    const [theme, setTheme] = useState<"light" | "dark">("dark");
    return (
        <React.Fragment>
            <div className="navbar bg-base-100 shadow-sm">
                <div className="navbar-start">
                    <Link to={"/"}><p className="btn btn-ghost text-xl">RigWizard</p></Link>
                </div>
                <div className="navbar-center">
                    <div role="tablist" className="tabs tabs-border">
                        {tabItems.map((tabItem) => (
                            <a role="tab" className={"tab" + (props.selectedTabId === tabItem.id ? " tab-active" : "")}><Link to={tabItem.pathTo}>{tabItem.text}</Link></a>
                        ))}
                    </div>
                </div>
                <div className="navbar-end gap-3 pr-5">

                    

                    {/*Theme button section*/}
                    <label className="swap swap-rotate ">
                        {/* this hidden checkbox controls the state */}
                        <input type="checkbox" className="theme-controller" value={theme} onClick={() => { theme === "dark" ? setTheme("light") : setTheme("dark") }} />

                        {/* sun icon */}
                        <SunMedium className="swap-off" size={30}/>

                        {/* moon icon */}
                        <Moon className="swap-on" size={30}/>
                    </label>
                    {isAuthenticated ? (
                        //Profile info section
                        <div className="dropdown dropdown-end">
                            <div tabIndex={0} role="button" className="btn btn-ghost flex items-center gap-2">
                                <span>
                                    {username}
                                </span>
                                <CircleUserRound />
                            </div>
                            <ul
                                tabIndex={-1}
                                className="menu menu-sm dropdown-content bg-base-100 rounded-box z-1 mt-3 w-52 p-2 shadow">
                                <li>
                                    <Link to={'/profile'}>
                                        <p className="justify-between">
                                            Profile
                                        </p>
                                    </Link>

                                </li>
                                <li><a onClick={async () => {
                                    const loggedOut = await logout();
                                    if (loggedOut) {
                                        setIsAuthenticated(false);
                                    }
                                }}>Logout</a></li>
                            </ul>
                        </div>
                    ) :
                        (
                            <Link to={"/login"}>
                                <button className="btn btn-primary btn-soft">Login</button>
                            </Link>
                        )}

                </div>



            </div>
        </React.Fragment>
    )
}
export default NavBar;