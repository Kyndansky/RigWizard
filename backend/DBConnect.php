<?php
$hostname = "localhost";
$dbUsername = "root";
$password = "";
$dbName = "rigwizard";
$dbConnection = new mysqli($hostname, $dbUsername, $password, $dbName);
if ($dbConnection->connect_error) {
    die("Connection failed: " . $dbConnection->connect_error);
}

