<?php
header("Access-Control-Allow-Origin: http://localhost:5173");
header("Access-Control-Allow-Credentials: true");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type, Authorization");
header("content-type: application/json; charset=UTF-8");

if (!isset($_SESSION))
    session_start();

if (isset($_SESSION['username'])) {
    $response = [
        "status" => "success",
        "message" => "User is logged in",
        "username" => $_SESSION['username']
    ];
} else {
    $response = [
        "status" => "error",
        "message" => "User is not logged in",
        "username"=>""
    ];
}
echo json_encode($response);