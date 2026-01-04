<?php
require_once '../../cors.php';
require_once "../../DBConnect.php";
$sql = "SELECT * FROM gpu";
$result = $dbConnection->query($sql);
$gpus = [];
if ($result && $result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
    $gpus[] = [
        "id" => (int)$row['id'],
        "manufacturer" => $row['manufacturer'], 
        "model_name" => $row['model_name'],
        "vram_gb" => (int)$row['vram_gb'],
        "score" => (float)$row['score'] 
       
    ];
}
    $response = [
        "status" => "success",
        "message" => "GPUs retrieved successfully",
        "data" => $gpus
    ];
} else {
    $response = [
        "status" => "success",
        "message" => "No GPUs found",
        "data" => []
    ];
}
echo json_encode($response, JSON_PRETTY_PRINT);
$dbConnection->close();