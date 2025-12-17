<?php
require_once "cors.php";
require_once "../DBConnect.php";

$json_data = file_get_contents("php://input");
$data = json_decode($json_data, true);
$games_per_page = 20;
if(!isset($_SESSION)) {
    session_start();
}
$username = $_SESSION["username"] ?? '';

// Set page number defaulting to 1
$pageNumber = isset($data['pageNumber']) ? (int) $data['pageNumber'] : 1;

// Calculate start position for database query
$offset = ($pageNumber - 1) * $games_per_page;

// If no username in session, return empty list
if (!$username) {
    $response = [
    'total_games' => "down",
    'games' => "",
    'tags' => "",
    'message' => 'User games retrieved successfully',
    'status' => 'fail'
    
];
    echo json_encode($response, JSON_PRETTY_PRINT);
    exit();
}

$sql_games = "SELECT g.id_game, g.title, g.description
              FROM games g
              JOIN user_games ug ON g.id_game = ug.id_game
              JOIN users u ON ug.id = u.id
              WHERE u.username = '$username'
              ORDER BY g.title ASC
              LIMIT $offset, $games_per_page";

$sql_totalGames = "SELECT COUNT(*) AS total_games
                   FROM user_games ug
                   JOIN users u ON ug.id_user = u.id_user
                   WHERE u.username = '$username'";

$sql_tags = "SELECT tg.id_game, t.name AS tag_name
             FROM tag_games tg
             JOIN tag t ON tg.id_tag = t.id_tag
             JOIN user_games ug ON tg.id_game = ug.id_game
             JOIN users u ON ug.id_user = u.id_user
             WHERE u.username = '$username'";

$result_games = $dbConnection->query($sql_games);
$result_total = $dbConnection->query($sql_totalGames);
$result_tags = $dbConnection->query($sql_tags);


$total_games = 0;
if ($result_total) {
    $row = $result_total->fetch_assoc();
    $total_games = (int)$row['total_games'];
}
$games_list = [];
if ($result_games) {
    while ($row = $result_games->fetch_assoc()) {
        $games_list[] = $row;
    }
}

$tags_list = [];
if ($result_tags) {
    while ($row = $result_tags->fetch_assoc()) {
        $tags_list[] = $row;
    }
}

$response = [
    'total_games' => $total_games,
    'games' => $games_list,
    'tags' => $tags_list,
    'message' => 'User games retrieved successfully',
    'status' => 'success'
];

echo json_encode($response, JSON_PRETTY_PRINT);