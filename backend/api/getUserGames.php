<?php
require_once "cors.php";
require_once "DBConnect.php";

$json_data = file_get_contents("php://input");
$data = json_decode($json_data, true);

$username = $_SESSION["username"] ?? '';

// If no username in session, return empty list
if (!$username) {
    echo json_encode([], JSON_PRETTY_PRINT);
    exit();
}

$sql_games = "SELECT g.id_gioco, g.titolo, g.descrizione 
              FROM giochi g
              JOIN user_games ug ON g.id_gioco = ug.id_gioco
              JOIN users u ON ug.id_utente = u.id_utente
              WHERE u.username = '$username'
              ORDER BY g.titolo ASC";

$sql_totalGames = "SELECT COUNT(*) AS total_games
                   FROM user_games ug
                   JOIN users u ON ug.id_utente = u.id_utente
                   WHERE u.username = '$username'";

$sql_tags = "SELECT tg.id_gioco, t.nome AS tag_name
             FROM tag_giochi tg
             JOIN tag t ON tg.id_tag = t.id_tag
             JOIN user_games ug ON tg.id_gioco = ug.id_gioco
             JOIN users u ON ug.id_utente = u.id_utente
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
    'tags' => $tags_list
];

echo json_encode($response, JSON_PRETTY_PRINT);