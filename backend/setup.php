<?php

// Complete SQL Script Content
$sql_script = "
-- Initial Setup
DROP DATABASE IF EXISTS `rigwizard`;
CREATE DATABASE `rigwizard`
    DEFAULT CHARACTER SET utf8mb4
    DEFAULT COLLATE utf8mb4_general_ci;
USE `rigwizard`;

-- Hardware Component Tables

-- Motherboard
CREATE TABLE `motherboard` (
    `id` INT(11) NOT NULL AUTO_INCREMENT,
    `manufacturer` VARCHAR(100) NOT NULL,
    `model_name` VARCHAR(100) NOT NULL UNIQUE,
    `chipset` VARCHAR(50),
    `socket_type` VARCHAR(50),
    `score` DECIMAL(3, 1) DEFAULT 0.0,
    PRIMARY KEY (`id`)
);

-- RAM (Memory)
CREATE TABLE `ram` (
    `id` INT(11) NOT NULL AUTO_INCREMENT,
    `brand` VARCHAR(100) NOT NULL,
    `model_name` VARCHAR(100) NOT NULL UNIQUE,
    `quantity_gb` INT(11) NOT NULL,
    `frequency_mhz` INT(11) NOT NULL,
    `memory_type` VARCHAR(10) NOT NULL,
    `score` DECIMAL(3, 1) DEFAULT 0.0,
    PRIMARY KEY (`id`)
);

-- Processor (CPU)
CREATE TABLE `cpu` ( 
    `id` INT(11) NOT NULL AUTO_INCREMENT,
    `manufacturer` VARCHAR(100) NOT NULL,
    `model_name` VARCHAR(100) NOT NULL UNIQUE,
    `frequency_ghz` DECIMAL(3, 2) NOT NULL,
    `cores` INT(11) NOT NULL,
    `socket_type` VARCHAR(50),
    `score` DECIMAL(3, 1) DEFAULT 0.0,
    PRIMARY KEY (`id`)
);

-- Graphics Card (GPU)
CREATE TABLE `gpu` (
    `id` INT(11) NOT NULL AUTO_INCREMENT,
    `manufacturer` VARCHAR(100) NOT NULL,
    `model_name` VARCHAR(100) NOT NULL UNIQUE,
    `vram_gb` INT(11),
    `score` DECIMAL(3, 1) DEFAULT 0.0,
    PRIMARY KEY (`id`)
);

-- PC Table (Hardware Configuration)
-- Links individual hardware components

CREATE TABLE `pc` (
    `id` INT(11) NOT NULL AUTO_INCREMENT,
    `config_name` VARCHAR(150),
    `id_ram` INT(11) NOT NULL,
    `id_motherboard` INT(11) NOT NULL,
    `id_cpu` INT(11) NOT NULL,
    `id_gpu` INT(11) NOT NULL,
    PRIMARY KEY (`id`),
    FOREIGN KEY (`id_ram`) REFERENCES `ram`(`id`) ON DELETE RESTRICT ON UPDATE CASCADE,
    FOREIGN KEY (`id_motherboard`) REFERENCES `motherboard`(`id`) ON DELETE RESTRICT ON UPDATE CASCADE,
    FOREIGN KEY (`id_cpu`) REFERENCES `cpu`(`id`) ON DELETE RESTRICT ON UPDATE CASCADE, 
    FOREIGN KEY (`id_gpu`) REFERENCES `gpu`(`id`) ON DELETE RESTRICT ON UPDATE CASCADE
);

-- Users Table

CREATE TABLE `users` (
    `id` INT(11) NOT NULL AUTO_INCREMENT,
    `username` VARCHAR(50) NOT NULL UNIQUE,
    `password_hash` VARCHAR(255) NOT NULL,
    `id_main_pc` INT(11) DEFAULT NULL,
    `registration_date` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (`id`),
    FOREIGN KEY (`id_main_pc`) REFERENCES `pc`(`id`) ON DELETE SET NULL ON UPDATE CASCADE
);

-- Games and Relationships Tables

-- Games
CREATE TABLE `games` (
    `id_game` INT(11) NOT NULL AUTO_INCREMENT,
    `title` VARCHAR(255) NOT NULL,
    `release_year` YEAR(4) NOT NULL,
    `publisher` VARCHAR(150),
    `price` DECIMAL(6, 2) DEFAULT 0.00,
    `description` TEXT,
    `id_min_pc` INT(11),
    `id_recommended_pc` INT(11),
    `creator` VARCHAR(150),
    PRIMARY KEY (`id_game`),
    FOREIGN KEY (`id_min_pc`) REFERENCES `pc`(`id`) ON DELETE SET NULL ON UPDATE CASCADE,
    FOREIGN KEY (`id_recommended_pc`) REFERENCES `pc`(`id`) ON DELETE SET NULL ON UPDATE CASCADE
);

-- Reviews
CREATE TABLE `reviews` (
    `id` INT(11) NOT NULL AUTO_INCREMENT,
    `id_game` INT(11) NOT NULL,
    `id_user` INT(11) NOT NULL,
    `score` TINYINT(1) CHECK (`score` BETWEEN 1 AND 10),
    `comment` TEXT,
    `review_date` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (`id`),
    UNIQUE KEY `unique_review` (`id_game`, `id_user`),
    FOREIGN KEY (`id_game`) REFERENCES `games`(`id_game`) ON DELETE CASCADE ON UPDATE CASCADE,
    FOREIGN KEY (`id_user`) REFERENCES `users`(`id`) ON DELETE CASCADE ON UPDATE CASCADE
);

-- Tags
CREATE TABLE `tag` (
    `id_tag` INT(11) NOT NULL AUTO_INCREMENT,
    `name` VARCHAR(50) NOT NULL UNIQUE,
    PRIMARY KEY (`id_tag`)
);

-- Game_Tags (Many-to-Many Bridge Table)
CREATE TABLE `game_tags` (
    `id_game` INT(11) NOT NULL,
    `id_tag` INT(11) NOT NULL,
    PRIMARY KEY (`id_game`, `id_tag`),
    FOREIGN KEY (`id_game`) REFERENCES `games`(`id_game`) ON DELETE CASCADE ON UPDATE CASCADE,
    FOREIGN KEY (`id_tag`) REFERENCES `tag`(`id_tag`) ON DELETE CASCADE ON UPDATE CASCADE
);
";

//connecting to mysql (without connecting to the database (because it hasn't been created yet))
$dbConnection = new mysqli("localhost", "root", "");
if ($dbConnection->connect_error) {
    die("<h1> Connessione fallita: " . $dbConnection->connect_error . "</h1>");
}

if ($dbConnection->multi_query($sql_script)) {

    $success_message = "SQL script executed successfully. Database 'rigwizard' created and tables populated.";
    $error_occurred = false;

    do {
        // Check for errors that occurred during the execution of the statement
        if ($dbConnection->errno) {
            echo "Error executing SQL script. Failed statement: " . $dbConnection->error . "\n";
            $error_occurred = true;
            break;
        }
        
        // This is needed to advance to the next result set if there was no error
        if ($result = $dbConnection->store_result()) {
            $result->free();
        }

    } while ($dbConnection->more_results() && $dbConnection->next_result());

    if (!$error_occurred) {
        echo $success_message;
    }

} else {
    echo "Error (during multi query): " . $dbConnection->error;
}

$dbConnection->close();