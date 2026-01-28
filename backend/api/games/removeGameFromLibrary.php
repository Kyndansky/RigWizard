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

if ($id_game > 0 && $username !== '') {
    $sql_user = "SELECT id FROM users WHERE username = ?";
    $stmt = $dbConnection->prepare($sql_user);
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result_user = $stmt->get_result();

    if ($result_user && $result_user->num_rows > 0) {
        $user_row = $result_user->fetch_assoc();
        $id_user = $user_row['id'];
        
        $stmt->close();

        $sql_remove = "DELETE FROM user_games WHERE id_user = ? AND id_game = ?";
        
        $stmt_remove = $dbConnection->prepare($sql_remove);
        $stmt_remove->bind_param("ii", $id_user, $id_game);

        if ($stmt_remove->execute()) {
            $response = [
                'status' => 'success',
                'message' => 'Game removed from library'
            ];
            echo json_encode($response);
            $stmt_remove->close(); 
            exit;
        } else {
            $response = [
                'status' => 'error',
                'message' => 'Error while removing game from user library'
            ];
            echo json_encode($response);
            $stmt_remove->close(); 
            exit;
        }
    } else {
        $stmt->close();
    }
}
$response = [
    'status' => 'error',
    'message' => 'Error while removing game from library'
];
echo json_encode($response, JSON_PRETTY_PRINT);
$dbConnection->close();
?>