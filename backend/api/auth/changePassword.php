<?php
require_once "../../cors.php";
require_once "../../DBConnect.php";
if (!isset($_SESSION))
    session_start();

$json_data = file_get_contents("php://input");
$data = json_decode($json_data, true);

$username = $_SESSION["username"];
$current_password = $data['current_password'] ?? '';
$new_password = $data['new_password'] ?? '';

//return error if user isn't authenticated
if (!$username || $username === "") {
    echo json_encode(['successful' => false, 'message' => 'You must be authenticated to perform this action']);
    exit();
}

//return error if user doesn't provide all fields
if (!$current_password || !$new_password) {
    echo json_encode(['successful' => false, 'message' => 'All fields are required.']);
    exit();
}

//sql query
$sql = "SELECT password_hash FROM users WHERE username = '$username'";
$result = $dbConnection->query($sql);
$user = $result->fetch_assoc();

// Check if user exists and password is correct
if ($user && password_verify($current_password, $user['password_hash'])) {

    $new_hash = password_hash($new_password, PASSWORD_BCRYPT);

    $sql_update_pass = "UPDATE users SET password_hash = '$new_hash' WHERE username = '$username'";

    if ($dbConnection->query(query: $sql_update_pass)) {
        echo json_encode(['successful' => true, 'message' => 'Password updated successfully.']);
    } else {
        echo json_encode(['successful' => false, 'message' => 'Database error.']);
    }

} else {
    echo json_encode(['successful' => false, 'message' => 'Your password is wrong']);
}

$dbConnection->close();
?>