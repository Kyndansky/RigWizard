2.aggiungo  una tabella immagini con campo ID_game e URL_img
<?php
session_start();
require_once "../../cors.php";
require_once "../../DBConnect.php";

$json_data = file_get_contents("php://input");
$data = json_decode($json_data, true);
// Get game ID and username from session
$id_game = isset($data['id_game']) ? (int)$data['id_game'] : 0;
$username = isset($_SESSION['username']) ? $_SESSION['username'] : '';

$response = [
    'status' => 'error',
    'message' => 'Operation failed'
];
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
        }
    }
}

echo json_encode($response, JSON_PRETTY_PRINT);
$dbConnection->close();
?>
