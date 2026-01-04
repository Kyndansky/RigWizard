<?php
require_once '../../cors.php';
require_once "../../DBConnect.php";
$sql = "SELECT * FROM cpu";
$result = $dbConnection->query($sql);
$cpus = [];

if ($result && $result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $cpus[] = [
            "id" => (int)$row['id'],
            "manufacturer" => $row['manufacturer'], 
            "model_name" => $row['model_name'],
            "frequency_ghz" => (float)$row['frequency_ghz'], 
            "cores" => (int)$row['cores'],           
            "socket_type" => $row['socket_type'],         
            "score" => (float)$row['score'] 
        ];
    }
    $response = [
        "status" => "success",
        "message" => "CPUs retrieved successfully",
        "data" => $cpus
    ];
} else {
    $response = [
        "status" => "success",
        "message" => "No CPUs found", 
        "data" => []
    ];
}
echo json_encode($response, JSON_PRETTY_PRINT);
$dbConnection->close();