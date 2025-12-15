<?php

require_once "cors.php";
require_once "DBConnect.php";

$games_per_page = 10; 

// Get json input data
$json_data = file_get_contents("php://input");
$data = json_decode($json_data, true);

// Set current page defaulting to 1
$current_page = isset($data['current_page']) ? (int)$data['current_page'] : 1;

// Calculate start position for database query
$offset = ($current_page - 1) * $games_per_page;

// Select games for this page directly
$sql_games = "SELECT id_gioco, titolo, descrizione 
              FROM giochi 
              ORDER BY titolo ASC 
              LIMIT $games_per_page OFFSET $offset";

// Run the query
$result_games = $conn->query($sql_games);

$games_list = [];
$game_ids = [];

// Save games to list and collect ids
while($row = $result_games->fetch_assoc()) {
    $id = $row['id_gioco'];
    
    $games_list[$id] = [
        'id' => $id,
        'title' => $row['titolo'],
        'description' => $row['descrizione'],
        'tags' => []
    ];
    
    $game_ids[] = $id;
}

// Get tags if games exist
if (!empty($game_ids)) {
    // Make comma separated string of ids
    $ids_string = implode(",", $game_ids);

    // Select tags for these games
    $sql_tags = "SELECT tg.id_gioco, t.nome AS tag_name
                 FROM tag_giochi tg
                 JOIN tag t ON tg.id_tag = t.id_tag
                 WHERE tg.id_gioco IN ($ids_string)
                 ORDER BY t.nome ASC";

    // Run the query
    $result_tags = $conn->query($sql_tags);

    // Add tags to correct game
    while($row = $result_tags->fetch_assoc()) {
        $game_id = $row['id_gioco'];
        $games_list[$game_id]['tags'][] = $row['tag_name'];
    }
}

$conn->close();

// Send output as json
echo json_encode(array_values($games_list), JSON_PRETTY_PRINT);

?>