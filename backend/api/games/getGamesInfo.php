<?php
require_once '../../cors.php';
require_once "../../DBConnect.php";

$json_data = file_get_contents("php://input");
$data = json_decode($json_data, true);

if (!isset($_SESSION)) 
    session_start();

$gameId = isset($data['gameId']) ? (int) $data['gameId'] : 0;

// Function to get PC components details
function getPCComponents($dbConnection, $pcId) {
    if (!$pcId) return null;

    // Query to get PC components
    $sql = "SELECT 
                p.config_name,
                c.manufacturer AS cpu_brand, c.model_name AS cpu_model, c.cores, c.frequency_ghz,
                g.manufacturer AS gpu_brand, g.model_name AS gpu_model, g.vram_gb,
                r.brand AS ram_brand, r.model_name AS ram_model, r.quantity_gb, r.memory_type,
                m.manufacturer AS mobo_brand, m.model_name AS mobo_model
            FROM pc p
            JOIN cpu c ON p.id_cpu = c.id
            JOIN gpu g ON p.id_gpu = g.id
            JOIN ram r ON p.id_ram = r.id
            JOIN motherboard m ON p.id_motherboard = m.id
            WHERE p.id = $pcId";
    
    $result = $dbConnection->query($sql);
    
    if ($result && $result->num_rows > 0) {
        return $result->fetch_assoc();
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

    echo json_encode($gameInfo);

} else {
    echo json_encode(["error" => "Game not found"]);
}

$dbConnection->close();
?>