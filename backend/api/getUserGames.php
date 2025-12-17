<?php
require_once "cors.php";
require_once "../DBConnect.php";

$json_data = file_get_contents("php://input");
$data = json_decode($json_data, true);
define('GAMES_PER_PAGE', 20);
$games_per_page = GAMES_PER_PAGE;
if (!isset($_SESSION)) 
    session_start();
// Use null coalescing operator to fallback to empty string if username is not set in session
$username = $_SESSION["username"] ?? '';
$username = $_SESSION["username"] ?? '';

// Set page number defaulting to 1
$pageNumber = isset($data['pageNumber']) ? (int) $data['pageNumber'] : 1;

// Calculate start position for database query
$offset = ($pageNumber - 1) * $games_per_page;

// If no username in session, return empty list
if (!$username) {
    $response = [
        'status' => 'error',
        'message' => 'User games retrieved successfully',
        'games' => [],
    ];


    echo json_encode($response, JSON_PRETTY_PRINT);
    exit();
}
// query to get user games with pagination
$sql_games = "SELECT g.id_game, g.title, g.description, g.img_URL
              FROM games g
              JOIN user_games ug ON g.id_game = ug.id_game
              JOIN users u ON ug.id_user = u.id
              WHERE u.username = '$username'
              ORDER BY g.title ASC
              LIMIT $offset, $games_per_page";

// query to get total number of user games

$sql_totalGames = "SELECT COUNT(*) AS total_games
                   FROM user_games ug
                   JOIN users u ON ug.id_user = u.id
                   WHERE u.username = '$username'";

// query to get tags for user games
$sql_tags = "SELECT tg.id_game, t.name AS tag_name
             FROM game_tags tg
             JOIN tag t ON tg.id_tag = t.id_tag
             JOIN user_games ug ON tg.id_game = ug.id_game
             JOIN users u ON ug.id_user = u.id
             WHERE u.username = '$username'";

$result_games = $dbConnection->query($sql_games);
$result_total = $dbConnection->query($sql_totalGames);
$result_tags = $dbConnection->query($sql_tags);

$tags_list = [];
if ($result_tags) {
    while ($tag_row = $result_tags->fetch_assoc()) {
        $tags_list[] = $tag_row;
    }
}


$total_games = 0;
if ($result_total) {
    $row = $result_total->fetch_assoc();
    $total_games = (int) $row['total_games'];
}
$games_list = [];
if ($result_games) {
    while ($row = $result_games->fetch_assoc()) {
        $games_list[] = $row;
    }
}


// Attach tags to corresponding games
foreach ($games_list as &$game) {
    $game_tags = [];
    foreach ($tags_list as $tag) {
        if ($tag['id_game'] == $game['id_game']) {
            $game_tags[] = $tag['tag_name'];
        }
    }
    $game['tags'] = $game_tags;
}

$response = [
    'status' => 'success',
    'message' => 'User games retrieved successfully',
    'games' => $games_list,
    'total_games' => $total_games,
];

echo json_encode($response, JSON_PRETTY_PRINT);
$dbConnection->close();
?>