<?php
require_once '../../cors.php';
require_once "../../DBConnect.php";

$sql = "SELECT * FROM cpu";
// Prepare and execute the SQL statement
$stmt = $dbConnection->prepare($sql);
$stmt->execute();
$result = $stmt->get_result();

$cpus = [];
// Fetch cpus data
if ($result && $result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $cpus[] = [
            "id" => (int)$row['id'],
            "manufacturer" => $row['manufacturer'], 
            "model" => $row['model_name'],
            "frequency_ghz" => (float)$row['frequency_ghz'], 
            "cores" => (int)$row['cores'],           
            "socket_type" => $row['socket_type'],         
            "score" => (float)$row['score'] 
        ];
    }
    $response = [
        "successful" => true,
        "message" => "CPUs retrieved successfully",
        "cpus" => $cpus
    ];
} else {
    $response = [
        "successful" => true,
        "message" => "No CPUs found", 
        "cpus" => []
    ];
}

if (isset($stmt)) {
    $stmt->close();
}

echo json_encode($response, JSON_PRETTY_PRINT);
$dbConnection->close();
?>