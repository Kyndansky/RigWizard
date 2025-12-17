<?php
require_once "cors.php";
require_once "../DBConnect.php";


// Select ID (for logic) and Name (for display), ordered alphabetically
$sql_tags = "SELECT id_tag, name FROM tag ORDER BY name ASC";

$result = $dbConnection->query($sql_tags);

$tags_list = [];

// If the query works, fill the array
if ($result) {
    while($row = $result->fetch_assoc()) {
        // Automatically adds the row (id_tag, name) to the list
        $tags_list[] = $row;
    }
}

// Return the list as JSON
echo json_encode($tags_list, JSON_PRETTY_PRINT);
?>