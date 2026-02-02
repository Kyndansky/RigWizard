<?php
require_once '../../cors.php';
require_once "../../DBConnect.php";

$sql = "SELECT * FROM gpu";
// Prepare and execute the SQL statement
$stmt = $dbConnection->prepare($sql);
$stmt->execute();
$result = $stmt->get_result();

$gpus = [];
// Fetch gpus data
if ($result && $result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
    $gpus[] = [
        "id" => (int)$row['id'],
        "manufacturer" => $row['manufacturer'], 
        "model" => $row['model_name'],
        "vram_gb" => (int)$row['vram_gb'],
        "score" => (float)$row['score'] 
        
    ];
}
    $response = [
        "successful" => true,
        "message" => "GPUs retrieved successfully",
        "gpus" => $gpus
    ];
} else {
    $response = [
        "successful" => true,
        "message" => "No GPUs found",
        "gpus" => []
    ];
}

if (isset($stmt)) {
    $stmt->close();
}

echo json_encode($response, JSON_PRETTY_PRINT);
$dbConnection->close();