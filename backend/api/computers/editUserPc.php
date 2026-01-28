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
$checkSql = "SELECT id_main_pc FROM users WHERE username = ?";
$stmt_check = $dbConnection->prepare($checkSql);
$stmt_check->bind_param("s", $username);
$stmt_check->execute();
$checkResult = $stmt_check->get_result();
$user = $checkResult->fetch_assoc();
$stmt_check->close();

$existing_pc_id = $user['id_main_pc'] ?? null;
// Update existing PC or create a new one
if ($existing_pc_id) {
    $sql = "UPDATE pc SET 
                config_name = ?, 
                id_ram = ?,
                id_motherboard = ?,
                id_cpu = ?,
                id_gpu = ?
            WHERE id = ?";

    $stmt_update = $dbConnection->prepare($sql);
    $stmt_update->bind_param("siiiii", $config_default_name, $id_ram, $id_motherboard, $id_cpu, $id_gpu, $existing_pc_id);

    if ($stmt_update->execute()) {
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
    $stmt_update->close();
} else {
    $sql = "INSERT INTO pc (config_name, id_ram, id_motherboard, id_cpu, id_gpu) 
            VALUES (?, ?, ?, ?, ?)";
    
    $stmt_insert = $dbConnection->prepare($sql);
    $stmt_insert->bind_param("siiii", $config_default_name, $id_ram, $id_motherboard, $id_cpu, $id_gpu);
    
    if ($stmt_insert->execute()) {
        $new_pc_id = $dbConnection->insert_id;
        $stmt_insert->close(); 

        $updateUser = "UPDATE users SET id_main_pc = ? WHERE username = ?";
        $stmt_link = $dbConnection->prepare($updateUser);
        $stmt_link->bind_param("is", $new_pc_id, $username);
        $stmt_link->execute();
        $stmt_link->close();

        $response = [
            "status" => "success",
            "message" => "Pc created successfully"
        ];
    } else {
        $response = [
            "status" => "error",
            "message" => "Error during creation of pc configuration: " . $dbConnection->error
        ];
        $stmt_insert->close();
    }
}

echo json_encode($response, JSON_PRETTY_PRINT);
$dbConnection->close();
?>