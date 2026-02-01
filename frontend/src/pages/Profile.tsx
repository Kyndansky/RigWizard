import { useAuth } from "../misc/AuthContextHandler";
import { BasePageLayout, showToastAlert } from "../components/BasePageLayout";
import { Navigate } from "react-router-dom";
import { motion } from "motion/react";
import { useState } from "react";
import { changeUserPassword } from "../misc/api_calls_functions";
import Loader from "../components/Loader";

export function Profile() {
    const { username, isAuthenticated, isLoadingAuthState } = useAuth();
    const [oldPasswordText, setOldPasswordText] = useState<string>("");
    const [newPasswordText, setNewPasswordText] = useState<string>("");

    if (isLoadingAuthState) return (<Loader />)
    if (!isAuthenticated) return (<Navigate to={"/"} />)

    return (
        <BasePageLayout>
            <motion.div
                initial={{ y: 50, opacity: 0 }}
                animate={{ y: 0, opacity: 1 }}
                transition={{ duration: 0.3 }}
                className="card w-96 bg-base-100 card-xl shadow-sm mx-auto my-auto">
                <div className="card-body">
                    <h2 className="card-title">Profile information</h2>
                    <p>Username: {username}</p>
                    <fieldset className="fieldset bg-base-200 border-base-300 rounded-box w-xs p-4">
                        <legend className="fieldset-legend">Change password</legend>

                        <label className="label">Old password</label>
                        <input type="password" className="input" placeholder="Type old password"
                            value={oldPasswordText}
                            onChange={(e) => {
                                setOldPasswordText(e.target.value);
                            }}
                        />

                        <label className="label">New password</label>
                        <input type="password" className="input" placeholder="Type new password"
                            value={newPasswordText}
                            onChange={(e) => {
                                setNewPasswordText(e.target.value);
                            }}
                        />
                    </fieldset>
                    <div className="card-actions">
                        <button className="btn btn-primary mt-4 w-full" onClick={async () => {
                            const result = await changeUserPassword(oldPasswordText, newPasswordText);
                            showToastAlert(result.successful ? "success" : "error", result.message);
                            if (result.successful) {
                                setOldPasswordText("");
                                setNewPasswordText("");
                            }
                        }}>Change password</button>
                    </div>
                </div>
            </motion.div>
        </BasePageLayout>
    )
}