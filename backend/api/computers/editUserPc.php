<?php
require_once '../../cors.php';
require_once "../../DBConnect.php";

if (!isset($_SESSION)) {
    session_start();
}

$username = $_SESSION["username"] ?? '';
// Check if user is logged in
if (empty($username)) {
    echo json_encode([
        "status" => "error",
        "message" => "User not logged in"
    ]);
    exit;
}
// Get input data
$json_data = file_get_contents("php://input");
$data = json_decode($json_data, true);
// Extract component IDs
$id_ram = $data['id_ram'] ?? null;
$id_motherboard = $data['id_motherboard'] ?? null;
$id_cpu = $data['id_cpu'] ?? null;
$id_gpu = $data['id_gpu'] ?? null;
$config_default_name = "config";
// Validate input
if (!$id_ram || !$id_motherboard || !$id_cpu || !$id_gpu) {
    echo json_encode(["status" => "error", "message" => "Missing components IDs"]);
    exit;
}
// Check if user already has a PC configuration
$checkSql = "SELECT id_main_pc FROM users WHERE username = '$username'";
$checkResult = $dbConnection->query($checkSql);
$user = $checkResult->fetch_assoc();
$existing_pc_id = $user['id_main_pc'] ?? null;
// Update existing PC or create a new one
if ($existing_pc_id) {
    $sql = "UPDATE pc SET 
                config_name = '$config_default_name', 
                id_ram = $id_ram,
                id_motherboard = $id_motherboard,
                id_cpu = $id_cpu,
                id_gpu = $id_gpu
            WHERE id = $existing_pc_id";

    if ($dbConnection->query($sql)) {
        $response = [
            "status" => "success",
            "message" => "Successfully updated pc configuration"
        ];
    } else {
        $response = [
            "status" => "error",
            "message" => "Error while updating pc configuration: " . $dbConnection->error
        ];
    }
} else {
    $sql = "INSERT INTO pc (config_name, id_ram, id_motherboard, id_cpu, id_gpu) 
            VALUES ('$config_default_name', $id_ram, $id_motherboard, $id_cpu, $id_gpu)";
    
    if ($dbConnection->query($sql)) {
        $new_pc_id = $dbConnection->insert_id;
        $updateUser = "UPDATE users SET id_main_pc = $new_pc_id WHERE username = '$username'";
        $dbConnection->query($updateUser);
        $response = [
            "status" => "success",
            "message" => "Pc created successfully"
        ];
    } else {
        $response = [
            "status" => "error",
            "message" => "Error during creation of pc configuration: " . $dbConnection->error
        ];
    }
}

echo json_encode($response, JSON_PRETTY_PRINT);
$dbConnection->close();
?>