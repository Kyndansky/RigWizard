<?php
require_once("../../cors.php");
if (!isset($_SESSION))
    session_start();

if (!isset($_SESSION["username"]) || $_SESSION["username"] === "") {
    echo json_encode([
        "successful" => false,
        "message" => "The user was not authenticated"
    ]);
    exit();
}
session_destroy();
echo json_encode([
    "successful" => true,
    "message" => "Logged out successfully"
]);
exit();