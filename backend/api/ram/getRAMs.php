<?php
require_once '../../cors.php';
require_once "../../DBConnect.php";
$sql = "SELECT * FROM ram";
$result = $dbConnection->query($sql);
$rams = [];
if ($result && $result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $rams[] = [
            "id" => (int) $row['id'],
            "brand" => $row['brand'],
            "model" => $row['model_name'],
            "quantity_gb" => (int) $row['quantity_gb'],
            "type" => $row['memory_type'],
            "frequency_mhz" => (int) $row['frequency_mhz'],
            "score" => (float) $row['score']
        ];
    }
    $response = [
        "successful" => true,
        "message" => "Rams retrieved successfully",
        "rams" => $rams
    ];
} else {
    $response = [
        "successful" => true,
        "message" => "No rams found",
        "rams" => []
    ];
}
echo json_encode($response, JSON_PRETTY_PRINT);
$dbConnection->close();