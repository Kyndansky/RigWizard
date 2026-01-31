<?php
require_once "../../cors.php";
require_once "../../DBConnect.php";
require_once "../../functions.php";

$json_data = file_get_contents("php://input");
$data = json_decode($json_data, true);

$offset = isset($data['indexStart']) ? (int) $data['indexStart'] : 0;
$offset = ($offset > 0) ? ($offset - 1) : 0;

$numOfGames = isset($data['numOfGames']) ? (int) $data['numOfGames'] : 30;
$filters = isset($data['filters']) ? $data['filters'] : [];
$searchString = isset($data['searchString']) ? trim($data['searchString']) : '';
$multiple_filters = isset($data['includeAllFilters']) ? (bool) $data['includeAllFilters'] : false;
if (!isset($_SESSION)) {
    session_start();
}
$username = isset($_SESSION["username"]) ? $_SESSION["username"] : '';

$params_games = [];
$types_games = "";

$sql_games = "SELECT g.* FROM games g";
// Join with tags if filters are applied
if (!empty($filters)) {
    $sql_games .= " JOIN game_tags tg ON g.id_game = tg.id_game
                    JOIN tags t ON tg.id_tag = t.id_tag";
}

$sql_games .= " WHERE 1=1";
// Apply filters if any
if (!empty($filters)) {
    // Costruiamo placeholder dinamici (?, ?, ?)
    $placeholders = implode(',', array_fill(0, count($filters), '?'));
    $sql_games .= " AND t.name IN ($placeholders)";
    
    // Aggiungiamo i tipi e i parametri
    $types_games .= str_repeat('s', count($filters));
    foreach ($filters as $filter) {
        $params_games[] = $filter;
    }
}
// Apply search string if provided
if ($searchString !== '') {
    $sql_games .= " AND g.title LIKE ?";
    $types_games .= "s";
    $params_games[] = "%" . $searchString . "%";
}

$sql_games .= " GROUP BY g.id_game";
// Ensure all filters are matched if multiple_filters is true
if (!empty($filters) && $multiple_filters) {
    $count_filters = count($filters);

    $sql_games .= " HAVING COUNT(DISTINCT t.name) = $count_filters";
}

$sql_games .= " ORDER BY g.title ASC LIMIT ?, ?";

$types_games .= "ii";
$params_games[] = $offset;
$params_games[] = $numOfGames;

// Query to get total number of games

$params_total = [];
$types_total = "";


$sql_total_base = "SELECT g.id_game FROM games g";

if (!empty($filters)) {
    $sql_total_base .= " LEFT JOIN game_tags tg ON g.id_game = tg.id_game
                         LEFT JOIN tags t ON tg.id_tag = t.id_tag";
}

$sql_total_base .= " WHERE 1=1";

if (!empty($filters)) {
    $placeholders = implode(',', array_fill(0, count($filters), '?'));
    $sql_total_base .= " AND t.name IN ($placeholders)";
    
    $types_total .= str_repeat('s', count($filters));
    foreach ($filters as $filter) {
        $params_total[] = $filter;
    }
}

if (!empty($searchString)) {
    $sql_total_base .= " AND (g.title LIKE ?)";
    $types_total .= "s";
    $params_total[] = "%" . $searchString . "%";
}

$sql_total_base .= " GROUP BY g.id_game";

if (!empty($filters) && $multiple_filters) {
    $count_filters = count($filters);
    $sql_total_base .= " HAVING COUNT(DISTINCT t.name) = $count_filters";
}

$sql_totalGames = "SELECT COUNT(*) AS total_games FROM ($sql_total_base) AS subquery";

// Query to get tags for games
$sql_tags = "SELECT tg.id_game, t.name AS tag_name
             FROM game_tags tg
             JOIN tags t ON tg.id_tag = t.id_tag";

$stmt_games = $dbConnection->prepare($sql_games);
if (!empty($params_games)) {
    $stmt_games->bind_param($types_games, ...$params_games);
}
$stmt_games->execute();
$result_games = $stmt_games->get_result();
$stmt_games->close();


if (!empty($params_total)) {
    $stmt_total = $dbConnection->prepare($sql_totalGames);
    $stmt_total->bind_param($types_total, ...$params_total);
    $stmt_total->execute();
    $result_total = $stmt_total->get_result();
    $stmt_total->close();
} else {
    $result_total = $dbConnection->query($sql_totalGames);
}

$result_tags = $dbConnection->query($sql_tags);

// Fetch user's owned games
$user_owned_ids = [];
if ($username !== '') {
    // Query to get user's owned games
    $sql_owned = "SELECT ug.id_game FROM user_games ug 
                  JOIN users u ON ug.id_user = u.id 
                  WHERE u.username = ?"; 
    
    $stmt_owned = $dbConnection->prepare($sql_owned);
    $stmt_owned->bind_param("s", $username);
    $stmt_owned->execute();
    $result_owned = $stmt_owned->get_result();
    
    if ($result_owned) {
        while ($row_owned = $result_owned->fetch_assoc()) {
            $user_owned_ids[] = (int) $row_owned['id_game'];
        }
    }
    $stmt_owned->close();
}

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
    $total_games = (int) ($row['total_games'] ?? 0);
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
    $game['isOwned'] = in_array((int) $game['id_game'], $user_owned_ids);
    $game['pc_min_details'] = getPCComponents($dbConnection, $game['id_min_pc']);
    $game['pc_rec_details'] = getPCComponents($dbConnection, $game['id_recommended_pc']);
    $game_tags = [];
    foreach ($tags_list as $tag) {
        if ($tag['id_game'] == $game['id_game']) {
            $game_tags[] = $tag['tag_name'];
        }
    }
    $game['tags'] = $game_tags;
}
unset($game);

// Final response
$response = [
    'status' => 'success',
    'message' => 'Games retrieved successfully',
    'games' => $games_list,
    'total_games' => $total_games,
];
echo json_encode($response, JSON_PRETTY_PRINT);
$dbConnection->close();
?>