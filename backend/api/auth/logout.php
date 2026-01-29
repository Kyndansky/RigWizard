<?php
require_once("../../cors.php");
if (!isset($_SESSION))
    session_start();

if (!isset($_SESSION["username"]) || $_SESSION["username"] === "") {
    echo json_encode([
        "status" => "error",
        "message" => "The user was not authenticated"
    ]);
    exit();
}
session_destroy();
echo json_encode([
    "status" => "success",
    "message" => "Logged out successfully"
]);
exit();