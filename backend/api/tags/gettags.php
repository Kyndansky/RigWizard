<?php
require_once "../../cors.php";
require_once "../../DBConnect.php";


//  tag Name (for display), ordered alphabetically
$sql_tags = "SELECT name FROM tag ORDER BY name ASC";
$result = $dbConnection->query($sql_tags);

$tags = [];

if ($result) {
    while($row = $result->fetch_assoc()) {
        // Estrai solo la stringa dalla colonna 'name'
        $tags[] = $row['name'];
    }
}
$response=[
    'status' => 'success',
    'message' => 'Tags retrieved successfully',
    'tags'=>$tags
];
echo json_encode($response, JSON_PRETTY_PRINT);
?>