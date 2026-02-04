<?php
$hostname = "localhost";
$dbUsername = "root";
$password = "";
$dbName = "rigwizard";
$dbConnection = new mysqli($hostname, $dbUsername, $password, $dbName);
$dbConnection->set_charset("utf8mb4");
if ($dbConnection->connect_error) {
    die("Connection failed: " . $dbConnection->connect_error);
}