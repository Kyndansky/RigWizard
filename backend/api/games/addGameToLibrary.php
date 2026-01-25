<?php

require_once "../../cors.php";
require_once "../../DBConnect.php";

$id_game = isset($_GET["gameId"]) ? (int) $_GET["gameId"] : 0;
if (!isset($_SESSION)) {
    session_start();
}
$username = isset($_SESSION['username']) ? $_SESSION['username'] : '';
if ($username === "") {
    $response = [
        'status' => 'error',
        'message' => 'You must be authenticated to do this'
    ];
    echo json_encode($response);
    exit;
}
// Get user ID from username
if ($id_game > 0 && $username !== '') {
    $sql_user = "SELECT id FROM users WHERE username = '$username'";
    $result_user = $dbConnection->query($sql_user);
    // If user exists, add game to their library
    if ($result_user && $result_user->num_rows > 0) {
        $user_row = $result_user->fetch_assoc();
        $id_user = $user_row['id'];
        // Insert game into user_games table
        $sql_add = "INSERT IGNORE INTO user_games (id_user, id_game, purchase_date) 
                    VALUES ($id_user, $id_game, NOW())";
        // Execute query and set success response
        if ($dbConnection->query($sql_add)) {
            $response = [
                'status' => 'success',
                'message' => 'Game added to library'
            ];
            echo json_encode($response);
            exit;
        } else {
            $response = [
                'status' => 'error',
                'message' => 'Error while adding game to user library'
            ];
            echo json_encode($response);
            exit;
        }
    }
}
$response = [
    'status' => 'error',
    'message' => 'Error while adding game to library'
];
echo json_encode($response, JSON_PRETTY_PRINT);
$dbConnection->close();
?>