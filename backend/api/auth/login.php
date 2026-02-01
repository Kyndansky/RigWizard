<?php
require_once("../../cors.php");


//retrieves the JSON data from the request body
$json_data = file_get_contents("php://input");
$data = json_decode($json_data, true);
$username = $data['username'];
$password = $data['password'];
//the password variable is stored because when using get_result() its value becomes ""
$input_password = $password;

if (!isset($username) || !isset($password)) {
    $response = [
        "successful" => false,
        "message" => "Username and password are required"
    ];
    echo json_encode($response);
    exit();
}
require_once("../../DBConnect.php");

$stmt = $dbConnection->prepare("SELECT * FROM users WHERE username = ?");
$stmt->bind_param("s", $username);
$stmt->execute();

$result = $stmt->get_result();

//checks if the user exists
if ($result->num_rows < 1) {
    $response = [
        "successful" => false,
        "message" => "User does not exist"
    ];
    echo json_encode($response);
    exit();
}
//checks if password is correct
$row = $result->fetch_assoc();
$dbPass = $row['password_hash'];
$stmt->close();

if (password_verify($input_password, $dbPass) === false) {
    $response = [
        "successful" => false,
        "message" => "Incorrect password",

    ];
    echo json_encode($response);
    exit();
} else {
    $response = [
        "successful" => true,
        "message" => "Login successful",
        "username" => $username
    ];
}


if (!isset($_SESSION))
    session_start();

$_SESSION['username'] = $username;
echo json_encode($response);
