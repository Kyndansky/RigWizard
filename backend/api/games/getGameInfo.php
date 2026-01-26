<?php
require_once '../../cors.php';
require_once "../../DBConnect.php";
require_once "../../functions.php";

$gameId=$_GET['gameId'] ?? 0;

if (!isset($_SESSION))
    session_start();


$username = $_SESSION['username'] ?? null;
// Query to check if the user owns the game
$isOwned = false;
if ($username) {
    $sql_isOwned = "SELECT ug.id_game 
                    FROM user_games ug
                    JOIN users u ON ug.id_user = u.id
                    WHERE u.username = '$username' AND ug.id_game = $gameId";

    $resultOwned = $dbConnection->query($sql_isOwned);
    if ($resultOwned && $resultOwned->num_rows > 0) {
        $isOwned = true;
    }
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
    $gameInfo['isOwned'] = $isOwned;
    $response = [
        "status" => "success",
        "message" => "Game information retrieved successfully",
        "game" => $gameInfo
    ];
    echo json_encode($response);

} else {
    $response = [
        "status" => "error",
        "message" => "Game not found",
    ];
    echo json_encode($response);
}

$dbConnection->close();
?>