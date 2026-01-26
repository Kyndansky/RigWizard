<?php
require_once '../../cors.php';
require_once "../../DBConnect.php";

$gameId=$_GET['gameId'] ?? 0;

if (!isset($_SESSION))
    session_start();


$username = $_SESSION['username'] ?? null;
// Query to check if the user owns the game
$isOwned = false;
if ($username) {
    $sql_isOwned = "SELECT ug.id_game 
                    FROM user_games ug
                    JOIN users u ON ug.id_user = u.id
                    WHERE u.username = '$username' AND ug.id_game = $gameId";

    $resultOwned = $dbConnection->query($sql_isOwned);
    if ($resultOwned && $resultOwned->num_rows > 0) {
        $isOwned = true;
    }
}
// Function to get PC components details

function getPCComponents($dbConnection, $pcId)
{
    if (!$pcId)
        return null;

    // Query to get PC components
    $sql = "SELECT 
                p.config_name,
                c.manufacturer AS cpu_brand, c.model_name AS cpu_model, c.cores, c.frequency_ghz, c.score as cpu_score,
                g.manufacturer AS gpu_brand, g.model_name AS gpu_model, g.vram_gb, g.score as gpu_score,
                r.brand AS ram_brand, r.model_name AS ram_model, r.quantity_gb, r.memory_type, r.score as ram_score,
                m.manufacturer AS mobo_brand, m.model_name AS mobo_model, m.score as mobo_score
            FROM pc p
            JOIN cpu c ON p.id_cpu = c.id
            JOIN gpu g ON p.id_gpu = g.id
            JOIN ram r ON p.id_ram = r.id
            JOIN motherboard m ON p.id_motherboard = m.id
            WHERE p.id = $pcId";

    $result = $dbConnection->query($sql);

    if ($result && $result->num_rows > 0) {
        $row = $result->fetch_assoc();
        
        return [
            "config_name" => $row['config_name'],
            "cpu" => [
                "manufacturer" => $row['cpu_brand'],
                "model" => $row['cpu_model'],
                "cores" => (int)$row['cores'],
                "frequency_ghz" => (float)$row['frequency_ghz'],
                "score"=>(float)$row['cpu_score']
            ],
            "gpu" => [
                "manufacturer" => $row['gpu_brand'],
                "model" => $row['gpu_model'],
                "vram_gb" => (int)$row['vram_gb'],
                "score"=>(float)$row['gpu_score']
            ],
            "ram" => [
                "brand" => $row['ram_brand'],
                "model" => $row['ram_model'],
                "quantity_gb" => (int)$row['quantity_gb'],
                "type" => $row['memory_type'],
                "score"=>(float)$row['ram_score']
            ],
            "motherboard" => [
                "manufacturer" => $row['mobo_brand'],
                "model" => $row['mobo_model'],
                "score"=>(float)$row['mobo_score']
            ]
        ];
    }
    return null;
}

// Query to get game info
$sql_gameInfo = "SELECT 
                    g.id_game, 
                    g.title, 
                    g.description, 
                    g.detailed_description,
                    g.price,
                    g.release_year,
                    g.publisher,
                    g.vertical_banner_URL, 
                    g.horizontal_banner_URL,
                    g.id_min_pc, 
                    g.id_recommended_pc
                 FROM games g
                 WHERE g.id_game = $gameId";

$result = $dbConnection->query($sql_gameInfo);

if ($result && $result->num_rows > 0) {
    $gameInfo = $result->fetch_assoc();

    // Minimum PC Details
    $gameInfo['pc_min_details'] = getPCComponents($dbConnection, $gameInfo['id_min_pc']);

    // Recommended PC Details
    $gameInfo['pc_rec_details'] = getPCComponents($dbConnection, $gameInfo['id_recommended_pc']);

    // Fetch tags associated with the game
    $sql_tags = "SELECT t.id_tag, t.name 
                 FROM game_tags gt
                 JOIN tag t ON gt.id_tag = t.id_tag
                 WHERE gt.id_game = $gameId";

    $result_tags = $dbConnection->query($sql_tags);
    $tags = [];
    // Collect tags
    if ($result_tags) {
        // Fetch tags
        while ($t = $result_tags->fetch_assoc()) {
            $tags[] = $t['name'];
        }
    }
    $gameInfo['tags'] = $tags;
    $gameInfo['isOwned'] = $isOwned;
    $response = [
        "status" => "success",
        "message" => "Game information retrieved successfully",
        "game" => $gameInfo
    ];
    echo json_encode($response);

} else {
    $response = [
        "status" => "error",
        "message" => "Game not found",
    ];
    echo json_encode($response);
}

$dbConnection->close();
?>