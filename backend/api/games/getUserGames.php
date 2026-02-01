<?php
require_once "../../cors.php";
require_once "../../DBConnect.php";
require_once "../../functions.php";

$json_data = file_get_contents("php://input");
$data = json_decode($json_data, true);
if (!isset($_SESSION))
    session_start();
// username is empty if it is not set in session
$username = $_SESSION["username"] ?? '';
if ($username == "") {
    echo json_encode(
        [
            "successful" => false,
            'message' => 'User must be logged in to access library',
            'games' => []
        ]
    );
    exit;
}
$offset = isset($data['indexStart']) ? (int) $data['indexStart'] : 0;
$offset = ($offset > 0) ? ($offset - 1) : 0;
$numOfGames = isset($data['numOfGames']) ? (int) $data['numOfGames'] : 30;
$filters = isset($data['filters']) ? $data['filters'] : [];
$searchString = isset($data['searchString']) ? $data['searchString'] : '';
$multiple_filters = isset($data['includeAllFilters']) ? (bool) $data['includeAllFilters'] : false;

$params_games = [];
$types_games = "";

$sql_games = "SELECT g.*
        FROM games g
        JOIN user_games ug ON g.id_game = ug.id_game
        JOIN users u ON ug.id_user = u.id";

// If there are filters, join the tags tables
if (!empty($filters)) {
    $sql_games .= " LEFT JOIN game_tags tg ON g.id_game = tg.id_game
              LEFT JOIN tags t ON tg.id_tag = t.id_tag";
}

// Sostituisco variabile con placeholder
$sql_games .= " WHERE u.username = ?";
$params_games[] = $username;
$types_games .= "s";

// Add filter condition
if (!empty($filters)) {
    // Convert filters array to a comma-separated string for SQL IN clause
    // Generiamo placeholder dinamici
    $placeholders = implode(',', array_fill(0, count($filters), '?'));
    $sql_games .= " AND t.name IN ($placeholders)";
    
    foreach ($filters as $f) {
        $params_games[] = $f;
        $types_games .= "s";
    }
}

// Add search condition
if (!empty($searchString)) {
    $sql_games .= " AND (g.title LIKE ?)";
    $params_games[] = "%" . $searchString . "%";
    $types_games .= "s";
}

// Avoid duplicates by grouping
$sql_games .= " GROUP BY g.id_game";

// If multiple filters are required, add HAVING clause
if (!empty($filters) && $multiple_filters) {
    $count_filters = count($filters);
    $sql_games .= " HAVING COUNT(DISTINCT t.name) = $count_filters";
}

$sql_games .= " ORDER BY g.title ASC LIMIT ?, ?";
$params_games[] = $offset;
$params_games[] = $numOfGames;
$types_games .= "ii";

// Query to get total number of user games
// I use a subquery to correctly count grouped games with HAVING

$params_total = [];
$types_total = "";

$sql_total_base = "SELECT g.id_game
                    FROM games g
                    JOIN user_games ug ON g.id_game = ug.id_game
                    JOIN users u ON ug.id_user = u.id";

// If there are filters, join the tags tables
if (!empty($filters)) {
    $sql_total_base .= " LEFT JOIN game_tags tg ON g.id_game = tg.id_game
                           LEFT JOIN tags t ON tg.id_tag = t.id_tag";
}

$sql_total_base .= " WHERE u.username = ?";
$params_total[] = $username;
$types_total .= "s";

// Add filter condition
if (!empty($filters)) {
    $placeholders = implode(',', array_fill(0, count($filters), '?'));
    $sql_total_base .= " AND t.name IN ($placeholders)";
    
    foreach ($filters as $f) {
        $params_total[] = $f;
        $types_total .= "s";
    }
}

// Add search condition
if (!empty($searchString)) {
    $sql_total_base .= " AND (g.title LIKE ? OR g.description LIKE ?)";
    $searchWildcard = "%" . $searchString . "%";
    
    $params_total[] = $searchWildcard;
    $params_total[] = $searchWildcard;
    $types_total .= "ss";
}

$sql_total_base .= " GROUP BY g.id_game";
// If multiple filters are required, add HAVING clause
if (!empty($filters) && $multiple_filters) {
    $count_filters = count($filters);
    $sql_total_base .= " HAVING COUNT(DISTINCT t.name) = $count_filters";
}

$sql_totalGames = "SELECT COUNT(*) AS total_games FROM ($sql_total_base) AS subquery";

// query to get tags for user's games
$sql_tags = "SELECT tg.id_game, t.name AS tag_name
             FROM game_tags tg
             JOIN tags t ON tg.id_tag = t.id_tag
             JOIN user_games ug ON tg.id_game = ug.id_game
             JOIN users u ON ug.id_user = u.id
             WHERE u.username = ?";

$stmt_games = $dbConnection->prepare($sql_games);
if (!empty($params_games)) {
    $stmt_games->bind_param($types_games, ...$params_games);
}
$stmt_games->execute();
$result_games = $stmt_games->get_result();
$stmt_games->close();

$stmt_total = $dbConnection->prepare($sql_totalGames);
if (!empty($params_total)) {
    $stmt_total->bind_param($types_total, ...$params_total);
}
$stmt_total->execute();
$result_total = $stmt_total->get_result();
$stmt_total->close();

$stmt_tags = $dbConnection->prepare($sql_tags);
$stmt_tags->bind_param("s", $username);
$stmt_tags->execute();
$result_tags = $stmt_tags->get_result();
$stmt_tags->close();


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
    "successful" => true,
    'message' => 'User games retrieved successfully',
    'games' => $games_list,
    'total_games' => $total_games,
];

echo json_encode($response, JSON_PRETTY_PRINT);
$dbConnection->close();
?>