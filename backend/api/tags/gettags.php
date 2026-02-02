<?php
require_once "../../cors.php";
require_once "../../DBConnect.php";

// SQL query to fetch tags ordered alphabetically
$sql_tags = "SELECT name FROM tags ORDER BY name ASC";

$stmt = $dbConnection->prepare($sql_tags);
$stmt->execute();
$result = $stmt->get_result();

$tags = [];
// Fetch tags data
if ($result) {
    while($row = $result->fetch_assoc()) {
        $tags[] = $row['name'];
    }
}

$stmt->close();

$response=[
    "successful" => true,
    'message' => 'Tags retrieved successfully',
    'tags'=>$tags
];
echo json_encode($response, JSON_PRETTY_PRINT);
?>