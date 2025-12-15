<?php

require_once "../DBConnect.php";
require_once "cors.php";

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Processor (CPU)
CREATE TABLE `processor` (
    `id` INT(11) NOT NULL AUTO_INCREMENT,
    `manufacturer` VARCHAR(100) NOT NULL,
    `model_name` VARCHAR(100) NOT NULL UNIQUE,
    `frequency_ghz` DECIMAL(3, 2) NOT NULL,
    `cores` INT(11) NOT NULL,
    `socket_type` VARCHAR(50),
    `score` DECIMAL(3, 1) DEFAULT 0.0,
    PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Graphics Card (GPU)
CREATE TABLE `gpu` (
    `id` INT(11) NOT NULL AUTO_INCREMENT,
    `manufacturer` VARCHAR(100) NOT NULL,
    `model_name` VARCHAR(100) NOT NULL UNIQUE,
    `vram_gb` INT(11),
    `score` DECIMAL(3, 1) DEFAULT 0.0,
    PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
    FOREIGN KEY (`id_cpu`) REFERENCES `processor`(`id`) ON DELETE RESTRICT ON UPDATE CASCADE,
    FOREIGN KEY (`id_gpu`) REFERENCES `gpu`(`id`) ON DELETE RESTRICT ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Users Table

CREATE TABLE `users` (
    `id` INT(11) NOT NULL AUTO_INCREMENT,
    `username` VARCHAR(50) NOT NULL UNIQUE,
    `email` VARCHAR(150) NOT NULL UNIQUE,
    `password_hash` VARCHAR(255) NOT NULL,
    `id_main_pc` INT(11) DEFAULT NULL,
    `registration_date` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (`id`),
    FOREIGN KEY (`id_main_pc`) REFERENCES `pc`(`id`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Tags
CREATE TABLE `tag` (
    `id_tag` INT(11) NOT NULL AUTO_INCREMENT,
    `name` VARCHAR(50) NOT NULL UNIQUE,
    PRIMARY KEY (`id_tag`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Game_Tags (Many-to-Many Bridge Table)
CREATE TABLE `game_tags` (
    `id_game` INT(11) NOT NULL,
    `id_tag` INT(11) NOT NULL,
    PRIMARY KEY (`id_game`, `id_tag`),
    FOREIGN KEY (`id_game`) REFERENCES `games`(`id_game`) ON DELETE CASCADE ON UPDATE CASCADE,
    FOREIGN KEY (`id_tag`) REFERENCES `tag`(`id_tag`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
";
