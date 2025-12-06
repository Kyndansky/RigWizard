<?php
header("Access-Control-Allow-Origin: http://localhost:5173");
header("Access-Control-Allow-Credentials: true");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type, Authorization");
header("content-type: application/json; charset=UTF-8");
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
