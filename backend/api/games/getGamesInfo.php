<?php
require_once '../../cors.php';
require_once "../../DBConnect.php";

$json_data = file_get_contents("php://input");
$data = json_decode($json_data, true);

if (!isset($_SESSION)) 
    session_start();


$gameId = isset($data['gameId']) ? (int) $data['gameId'] : 0;

// Function to get PC components
function getPCComponents($dbConnection, $pcId) {
    // Retrieve components for a given PC build
    $sql = "SELECT c.id_component, c.name, c.type, c.specs
            FROM pc_build_components pcc
            JOIN components c ON pcc.id_component = c.id_component
            WHERE pcc.id_pc = $pcId";
    
    $result = $dbConnection->query($sql);
    $components = [];
    // Fetch components
    if ($result) {
        while ($row = $result->fetch_assoc()) {
            $components[] = $row;
        }
    }
    return $components;
}

// Query to get game info
$sql_gameInfo = "SELECT g.id_game, g.title, g.description, g.img_URL,
                        pc_min.id_pc AS pc_min_id, pc_min.name AS pc_min_name,
                        pc_rec.id_pc AS pc_rec_id, pc_rec.name AS pc_rec_name
                 FROM games g
                 LEFT JOIN pc_builds pc_min ON g.id_min_pc = pc_min.id_pc
                 LEFT JOIN pc_builds pc_rec ON g.id_rec_pc = pc_rec.id_pc
                 WHERE g.id_game = $gameId";

$result = $dbConnection->query($sql_gameInfo);

if ($result && $result->num_rows > 0) {
    $gameInfo = $result->fetch_assoc();

    // Get minimum PC components
    if (!empty($gameInfo['pc_min_id'])) {
        $gameInfo['pc_min_components'] = getPCComponents($dbConnection, $gameInfo['pc_min_id']);
    } else {
        $gameInfo['pc_min_components'] = [];
    }

    // Get recommended PC components
    if (!empty($gameInfo['pc_rec_id'])) {
        $gameInfo['pc_rec_components'] = getPCComponents($dbConnection, $gameInfo['pc_rec_id']);
    } else {
        $gameInfo['pc_rec_components'] = [];
    }
    // Get game tags
    $sql_tags = "SELECT t.id_tag, t.name 
                 FROM game_tags gt
                 JOIN tag t ON gt.id_tag = t.id_tag
                 WHERE gt.id_game = $gameId";
    
    $result_tags = $dbConnection->query($sql_tags);
    $tags = [];
    // Fetch tags
    if ($result_tags) {

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