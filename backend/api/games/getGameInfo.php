<?php
require_once '../../cors.php';
require_once "../../DBConnect.php";
require_once "../../functions.php";

$gameId = $_GET['gameId'] ?? 0;

if (!isset($_SESSION))
    session_start();


$username = $_SESSION['username'] ?? null;
// Query to check if the user owns the game
$isOwned = false;
if ($username) {
    
    $sql_isOwned = "SELECT ug.id_game 
                    FROM user_games ug
                    JOIN users u ON ug.id_user = u.id
                    WHERE u.username = ? AND ug.id_game = ?";

    $stmt_owned = $dbConnection->prepare($sql_isOwned);
   
    $stmt_owned->bind_param("si", $username, $gameId);
    $stmt_owned->execute();
    $resultOwned = $stmt_owned->get_result();
    
    if ($resultOwned && $resultOwned->num_rows > 0) {
        $isOwned = true;
    }
    $stmt_owned->close();
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
                    g.id_min_pc, 
                    g.id_recommended_pc
                 FROM games g
                 WHERE g.id_game = ?";

$stmt_info = $dbConnection->prepare($sql_gameInfo);

$stmt_info->bind_param("i", $gameId);
$stmt_info->execute();
$result = $stmt_info->get_result();

if ($result && $result->num_rows > 0) {
    $gameInfo = $result->fetch_assoc();
    $stmt_info->close();

    // Minimum PC Details
    $gameInfo['pc_min_details'] = getPCComponents($dbConnection, $gameInfo['id_min_pc']);

    // Recommended PC Details
    $gameInfo['pc_rec_details'] = getPCComponents($dbConnection, $gameInfo['id_recommended_pc']);


    // Fetch tags associated with the game
    $sql_tags = "SELECT t.id_tag, t.name 
                 FROM game_tags gt
                 JOIN tags t ON gt.id_tag = t.id_tag
                 WHERE gt.id_game = ?";

    $stmt_tags = $dbConnection->prepare($sql_tags);
    
    $stmt_tags->bind_param("i", $gameId);
    $stmt_tags->execute();
    $result_tags = $stmt_tags->get_result();

    $tags = [];
    // Collect tags
    if ($result_tags) {
        // Fetch tags
        while ($t = $result_tags->fetch_assoc()) {
            $tags[] = $t['name'];
        }
    }
    $stmt_tags->close();
    
    $gameInfo['tags'] = $tags;

    // Fetch gallery images for the game
    $gameInfo['images'] = getGameImages($gameId);
    $gameInfo['isOwned'] = $isOwned;
    $response = [
        "successful" => true,
        "message" => "Game information retrieved successfully",
        "game" => $gameInfo
    ];
    echo json_encode($response);

} else {
    if(isset($stmt_info)){
        $stmt_info->close();
    }
    
    $response = [
        "successful" => false,
        "message" => "Game not found",
    ];
    echo json_encode($response);
}

$dbConnection->close();
?>