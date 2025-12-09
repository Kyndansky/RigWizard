<?php
require_once("cors.php");
if (!isset($_SESSION)) {
    echo json_encode([
        "status" => "success",
        "message" => "The user was not authenticated to begin with"
    ]);
}
if (!isset($_SESSION["username"]) || !$_SESSION["username"] !== "") {
    echo json_encode([
        "status" => "success",
        "message" => "The user was not authenticated to begin with"
    ]);
}
session_start();
session_destroy();
echo json_encode([
    "status" => "success",
    "message" => "Logged out successfully"
]);
