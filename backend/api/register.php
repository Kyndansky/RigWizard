<?php
//header shii
require_once("cors.php");

$json_data = file_get_contents('php://input');

$data = json_decode($json_data, true);
if (!is_array($data)) {
    $response = [
        "status" => "error",
        "message" => "Username and password are required",
        "username" => ""
    ];
    echo json_encode($response);
    exit();
}

$username = $data['username'] ?? null;
$password = $data['password'] ?? null;
//the password variable is stored because when using get_result() its value becomes ""
$input_password = $password;


if (!$username || !$password) {
    $response = [
        "status" => "error",
        "message" => "Username and password are required",
        "username" => ""
    ];
    echo json_encode($response);
    exit();
}
require_once("../DBConnect.php");

//checks if the username already exists
$stmtCheck = $dbConnection->prepare("SELECT COUNT(*) FROM users WHERE username = ?");
$stmtCheck->bind_param("s", $username);
$stmtCheck->execute();

$result = $stmtCheck->get_result();
$row = $result->fetch_row();
$userCount = $row[0];

if ($userCount > 0) {
    $response = [
        "status" => "error",
        "message" => "User already exists",
        "username" => "",
    ];
    echo json_encode($response);
    exit();
}
$stmtCheck->close();
//inserts the new user into the database
$stmt = $dbConnection->prepare("INSERT INTO users (username, password_hash) VALUES (?, ?)");
$hashed_password = password_hash($input_password, PASSWORD_BCRYPT);
$stmt->bind_param("ss", $username, $hashed_password);
$response=[
    "status" => "success",
        "message" => "User registered successfully",
        "username" => $username,
];
if(!isset($_SESSION)){
    session_start();
}
$_SESSION["username"]=$username;
echo json_encode($response);
$stmt->close();
$dbConnection->close();