<?php
require_once "../../cors.php";
require_once "../../DBConnect.php";

$json_data = file_get_contents("php://input");
$data = json_decode($json_data, true);
if (!isset($_SESSION)) 
    session_start();
// username is empty if it is not set in session
$username = $_SESSION["username"] ?? '';

// Set page number defaulting to 1
$offset = isset($data['indexStart']) ? (int) $data['indexStart']-1 : 1;
$numOfGames = isset($data['numOfGames']) ? (int) $data['numOfGames']-1 : 30;
$filters = isset($data['filters']) ? $data['filters'] : [];
$searchString = isset($data['searchString']) ? $data['searchString'] : '';

$sql_games = "SELECT DISTINCT g.id_game, g.title, g.description, g.img_URL
        FROM games g
        JOIN user_games ug ON g.id_game = ug.id_game
        JOIN users u ON ug.id_user = u.id";

// If there are filters, join the tags tables
if (!empty($filters)) {
    $sql_games .= " LEFT JOIN game_tags tg ON g.id_game = tg.id_game
              LEFT JOIN tag t ON tg.id_tag = t.id_tag";
}

$sql_games .= " WHERE u.username = '$username'";

// Add filter condition
if (!empty($filters)) {
    // Convert filters array to a comma-separated string for SQL IN clause
    $lista_filtri = implode("','", $filters);
    $sql_games .= " AND t.name IN ('$lista_filtri')";
}

// Add search condition
if (!empty($searchString)) {
    $sql_games .= " AND (g.title LIKE '%$searchString%' OR g.description LIKE '%$searchString%')";
}


$sql_games .= " ORDER BY g.title ASC LIMIT $offset, $numOfGames";

// Query to get total number of user games
$sql_totalGames = "SELECT COUNT(DISTINCT g.id_game) AS total_games
                   FROM games g
                   JOIN user_games ug ON g.id_game = ug.id_game
                   JOIN users u ON ug.id_user = u.id";

// If there are filters, join the tags tables
if (!empty($filters)) {
    $sql_totalGames .= " LEFT JOIN game_tags tg ON g.id_game = tg.id_game
                         LEFT JOIN tag t ON tg.id_tag = t.id_tag";
}


$sql_totalGames .= " WHERE u.username = '$username'";

// Add filter condition
if (!empty($filters)) {
    $lista_filtri = implode("','", $filters);
    $sql_totalGames .= " AND t.name IN ('$lista_filtri')";
}

// Add search condition
if (!empty($searchString)) {
    $sql_totalGames .= " AND (g.title LIKE '%$searchString%' OR g.description LIKE '%$searchString%')";
}


// query to get tags for user's games
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
// Fetch total games count
$total_games = 0;
if ($result_total) {
    $row = $result_total->fetch_assoc();
    $total_games = (int) $row['total_games'];
}
// Fetch games list
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
// Final response
$response = [
    'status' => 'success',
    'message' => 'User games retrieved successfully',
    'games' => $games_list,
    'total_games' => $total_games,
];

echo json_encode($response, JSON_PRETTY_PRINT);
$dbConnection->close();
?>