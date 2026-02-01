<?php
require_once("../../cors.php");
if (!isset($_SESSION))
    session_start();

if (isset($_SESSION['username'])) {
    $response = [
        "successful" => true,
        "message" => "User is logged in",
        "username" => $_SESSION['username']
    ];
} else {
    $response = [
        "successful" => false,
        "message" => "User is not logged in",
        "username" => ""
    ];
}
echo json_encode($response);