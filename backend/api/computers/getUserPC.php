<?php
require_once '../../cors.php';
require_once "../../DBConnect.php";

if (!isset($_SESSION)) {
    session_start();
}

$username = $_SESSION["username"] ?? '';

// Sostituito '$username' con il placeholder ?
$sql = "SELECT 
            p.config_name,
            r.brand AS ram_brand, r.model_name AS ram_model, r.quantity_gb, r.frequency_mhz, r.memory_type as memory_type, r.score AS ram_score, r.id as ram_id,
            c.manufacturer AS cpu_manufacturer, c.model_name AS cpu_model, c.frequency_ghz, c.cores, c.socket_type AS cpu_socket, c.score AS cpu_score, c.id as cpu_id,
            g.manufacturer AS gpu_manufacturer, g.model_name AS gpu_model, g.vram_gb, g.score AS gpu_score,g.id as gpu_id,
            m.manufacturer AS mb_manufacturer, m.model_name AS mb_model, m.chipset, m.socket_type AS mb_socket, m.score AS mb_score, m.id as mobo_id
        FROM users u
        INNER JOIN pc p ON u.id_main_pc = p.id
        INNER JOIN ram r ON p.id_ram = r.id
        INNER JOIN cpu c ON p.id_cpu = c.id
        INNER JOIN gpu g ON p.id_gpu = g.id
        INNER JOIN motherboard m ON p.id_motherboard = m.id
        WHERE u.username = ?";

$stmt = $dbConnection->prepare($sql);
$stmt->bind_param("s", $username);
$stmt->execute();
$result = $stmt->get_result();

if ($result && $result->num_rows > 0) {
    $row = $result->fetch_assoc();
    
    $response_data = [
        "config_name" => $row['config_name'],
        "ram" => [
            "id"=>$row["ram_id"],
            "brand" => $row['ram_brand'],
            "model" => $row['ram_model'],
            "quantity_gb" => $row['quantity_gb'],
            "frequency_mhz" => $row['frequency_mhz'],
            "type" => $row['memory_type'],
            "score" => $row['ram_score']
        ],
        "cpu" => [
            "id"=>$row["cpu_id"],
            "manufacturer" => $row['cpu_manufacturer'],
            "model" => $row['cpu_model'],
            "frequency_ghz" => $row['frequency_ghz'],
            "cores" => $row['cores'],
            "socket" => $row['cpu_socket'],
            "score" => $row['cpu_score']
        ],
        "gpu" => [
            "id"=>$row["gpu_id"],
            "manufacturer" => $row['gpu_manufacturer'],
            "model" => $row['gpu_model'],
            "vram_gb" => $row['vram_gb'],
            "score" => $row['gpu_score']
        ],
        "motherboard" => [
            "id"=>$row["mobo_id"],
            "manufacturer" => $row['mb_manufacturer'],
            "model" => $row['mb_model'],
            "chipset" => $row['chipset'],
            "socket" => $row['mb_socket'],
            "score" => $row['mb_score']
        ]
    ];

    $response = [
        "status" => "success",
        "message" => "User computer retrieved successfully",
        "computer" => $response_data
    ];
    $stmt->close();
} else {
    $response = [
        "status" => "success",
        "message" => "No computer found for this user",
        "computer" => null
    ];
    if (isset($stmt)) $stmt->close();
}

echo json_encode($response, JSON_PRETTY_PRINT);
$dbConnection->close();
?>