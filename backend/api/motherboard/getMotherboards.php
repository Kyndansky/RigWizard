<?php
require_once '../../cors.php';
require_once "../../DBConnect.php";

$sql = "SELECT * FROM motherboard";
// Prepare and execute the SQL statement
$stmt = $dbConnection->prepare($sql);
$stmt->execute();
$result = $stmt->get_result();

$motherboards = [];
// Fetch motherboards data
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
        "successful" => true,
        "message" => "Motherboards retrieved successfully",
        "motherboards" => $motherboards
    ];
} else {
    $response = [
        "successful" => true,
        "message" => "No motherboards found",
        "motherboards" => []
    ];
}

if (isset($stmt)) {
    $stmt->close();
}

echo json_encode($response, JSON_PRETTY_PRINT);
$dbConnection->close();
?>