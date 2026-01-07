<?php
require_once '../../cors.php';
require_once "../../DBConnect.php";

if (!isset($_SESSION)) {
    session_start();
}

$username = $_SESSION["username"] ?? '';



$sql = "SELECT 
            p.config_name,
            r.brand AS ram_brand, r.model_name AS ram_model, r.quantity_gb, r.frequency_mhz, r.memory_type, r.score AS ram_score,
            c.manufacturer AS cpu_manufacturer, c.model_name AS cpu_model, c.frequency_ghz, c.cores, c.socket_type AS cpu_socket, c.score AS cpu_score,
            g.manufacturer AS gpu_manufacturer, g.model_name AS gpu_model, g.vram_gb, g.score AS gpu_score,
            m.manufacturer AS mb_manufacturer, m.model_name AS mb_model, m.chipset, m.socket_type AS mb_socket, m.score AS mb_score,
        FROM users u
        INNER JOIN pc p ON u.id_main_pc = p.id
        INNER JOIN ram r ON p.id_ram = r.id
        INNER JOIN cpu c ON p.id_cpu = c.id
        INNER JOIN gpu g ON p.id_gpu = g.id
        INNER JOIN motherboard m ON p.id_motherboard = m.id
        WHERE u.username = '$username'";

$result = $dbConnection->query($sql);

if ($result && $result->num_rows > 0) {
    $row = $result->fetch_assoc();
    
    $response_data = [
        "config_name" => $row['config_name'],
        "ram" => [
            "brand" => $row['ram_brand'],
            "model" => $row['ram_model'],
            "quantity_gb" => $row['quantity_gb'],
            "frequency_mhz" => $row['frequency_mhz'],
            "type" => $row['memory_type'],
            "score" => $row['ram_score']
        ],
        "cpu" => [
            "manufacturer" => $row['cpu_manufacturer'],
            "model" => $row['cpu_model'],
            "frequency_ghz" => $row['frequency_ghz'],
            "cores" => $row['cores'],
            "socket" => $row['cpu_socket'],
            "score" => $row['cpu_score']
        ],
        "gpu" => [
            "manufacturer" => $row['gpu_manufacturer'],
            "model" => $row['gpu_model'],
            "vram_gb" => $row['vram_gb'],
            "score" => $row['gpu_score']
        ],
        "motherboard" => [
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
} else {
    $response = [
        "status" => "success",
        "message" => "No computer found for this user",
        "computer" => null
    ];
}

echo json_encode($response, JSON_PRETTY_PRINT);
$dbConnection->close();
?>