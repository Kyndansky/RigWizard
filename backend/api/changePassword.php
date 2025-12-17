<?php
require_once "cors.php";
require_once "../DBConnect.php";

$json_data = file_get_contents("php://input");
$data = json_decode($json_data, true);

$username = $data['username'] ?? '';
$current_password = $data['current_password'] ?? '';
$new_password = $data['new_password'] ?? '';

// Basic validation
if (!$username || !$current_password || !$new_password) {
    echo json_encode(['success' => false, 'message' => 'All fields are required.']);
    exit();
}


$sql = "SELECT password_hash FROM users WHERE username = '$username'";
$result = $dbConnection->query($sql);
$user = $result->fetch_assoc();

// Check if user exists and password is correct
if ($user && password_verify($current_password, $user['password_hash'])) {

    $new_hash = password_hash($new_password, PASSWORD_DEFAULT);

    // We put '$new_hash' and '$username' directly inside the string
    $sql_update = "UPDATE users SET password_hash = '$new_hash' WHERE username = '$username'";

    if ($dbConnection->query($sql_update)) {
        echo json_encode(['success' => true, 'message' => 'Password updated successfully.']);
    } else {
        echo json_encode(['success' => false, 'message' => 'Database error.']);
    }

} else {
    echo json_encode(['success' => false, 'message' => 'Invalid username or current password.']);
}

$dbConnection->close();
?>