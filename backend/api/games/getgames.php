<?php
require_once "../../cors.php";
require_once "../../DBConnect.php";

$json_data = file_get_contents("php://input");
$data = json_decode($json_data, true);

// Set page number defaulting to 1
$offset = isset($data['indexStart']) ? (int) $data['indexStart'] : 0;
$numOfGames = isset($data['numOfGames']) ? (int) $data['numOfGames'] : 30;
$filters = isset($data['filters']) ? $data['filters'] : [];
$searchString = isset($data['searchString']) ? $data['searchString'] : '';
$multiple_filters = isset($data['includeAllFilters']) ? (bool) $data['includeAllFilters'] : false;
$offset = ($offset - 1);
$sql_games = "SELECT g.* FROM games g";

// If there are filters, join the tags tables
if (!empty($filters)) {
    $sql_games .= " LEFT JOIN game_tags tg ON g.id_game = tg.id_game
                    LEFT JOIN tag t ON tg.id_tag = t.id_tag";
}

// Base WHERE clause
$sql_games .= " WHERE 1=1";

// Add filter condition
if (!empty($filters)) {
    $lista_filtri = implode("','", $filters);
    $sql_games .= " AND t.name IN ('$lista_filtri')";
}

// Add search condition
if (!empty($searchString)) {
    $sql_games .= " AND (g.title LIKE '%$searchString%')";
}

// Avoid duplicates by grouping
$sql_games .= " GROUP BY g.id_game";

// If multiple filters are required, add HAVING clause
if (!empty($filters) && $multiple_filters) {
    $count_filters = count($filters);
    $sql_games .= " HAVING COUNT(DISTINCT t.name) = $count_filters";
}

$sql_games .= " ORDER BY g.title ASC LIMIT $offset, $numOfGames";

// Query to get total number of games
$sql_total_base = "SELECT g.id_game FROM games g";

if (!empty($filters)) {
    $sql_total_base .= " LEFT JOIN game_tags tg ON g.id_game = tg.id_game
                         LEFT JOIN tag t ON tg.id_tag = t.id_tag";
}

$sql_total_base .= " WHERE 1=1";

if (!empty($filters)) {
    $lista_filtri = implode("','", $filters);
    $sql_total_base .= " AND t.name IN ('$lista_filtri')";
}

if (!empty($searchString)) {
    $sql_total_base .= " AND (g.title LIKE '%$searchString%')";
}

$sql_total_base .= " GROUP BY g.id_game";

if (!empty($filters) && $multiple_filters) {
    $count_filters = count($filters);
    $sql_total_base .= " HAVING COUNT(DISTINCT t.name) = $count_filters";
}

$sql_totalGames = "SELECT COUNT(*) AS total_games FROM ($sql_total_base) AS subquery";

// query to get tags for games
$sql_tags = "SELECT tg.id_game, t.name AS tag_name
             FROM game_tags tg
             JOIN tag t ON tg.id_tag = t.id_tag";

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
$response['debug_sql'] = $sql_games;
echo json_encode($response, JSON_PRETTY_PRINT);
$dbConnection->close();
?>