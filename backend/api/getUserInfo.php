<?php
require_once("cors.php");
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