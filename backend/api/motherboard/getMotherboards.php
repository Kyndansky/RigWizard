<?php
require_once '../../cors.php';
require_once "../../DBConnect.php";
$sql = "SELECT * FROM motherboard";
$result = $dbConnection->query($sql);
$motherboards = [];
if ($result && $result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $motherboards[] = [
            "id" => (int)$row['id'],
            "manufacturer" => $row['manufacturer'],
            "model" => $row['model_name'],
            "chipset" => $row['chipset'],
            "socket_type" => $row['socket_type'],
            "score" => (float)$row['score']
        ];
    }
    $response = [
        "status" => "success",
        "message" => "Motherboards retrieved successfully",
        "motherboards" => $motherboards
    ];
} else {
    $response = [
        "status" => "success",
        "message" => "No motherboards found",
        "motherboards" => []
    ];
}
echo json_encode($response, JSON_PRETTY_PRINT);
$dbConnection->close();