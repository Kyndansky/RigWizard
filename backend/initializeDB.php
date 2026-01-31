<?php
//database creation
$dbConn = new mysqli("localhost", "root", "");
$dbConn->query("CREATE DATABASE IF NOT EXISTS rigwizard");
$dbConn->close();
//getting content of .sql file
$dbImportFilePath = "rigwizard.sql";
$dbImportQuery = file_get_contents($dbImportFilePath);
if ($dbImportQuery === false) {
    echo ("Couldn't read file " . $filename);
    exit();
}
//executing .sql file queries
include('DBConnect.php');
if ($dbConnection->multi_query($dbImportQuery)) {
    $success_message = "RigWizard database imported successfully";
    $error_occurred = false;
    do {
        if ($result = $dbConnection->store_result()) {
            $result->free();
        }
        if ($dbConnection->error) {
            echo "Error executing SQL script: " . $dbConnection->error . "\n";
            $error_occurred = true;
        }
    } while ($dbConnection->more_results() && $dbConnection->next_result());

    if (!$error_occurred)
        echo $success_message;
} else {
    echo "Error: " . $dbConnection->error;
}

$dbConnection->close();
?>