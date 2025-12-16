<?php

// this script adds example data into the database
$sql_script = "
USE `rigwizard`;

-- RAM
INSERT INTO `ram` (`brand`, `model_name`, `quantity_gb`, `frequency_mhz`, `memory_type`, `score`) VALUES
( 'Corsair', 'Vengeance RGB Pro 16GB', 16, 3200, 'DDR4', 8.5),
( 'Kingston', 'Fury Renegade 32GB', 32, 6000, 'DDR5', 9.2),
( 'G.Skill', 'Trident Z RGB 8GB', 8, 3000, 'DDR4', 7.9);

-- CPU
INSERT INTO `cpu` (`manufacturer`, `model_name`, `frequency_ghz`, `cores`, `socket_type`, `score`) VALUES
( 'Intel', 'Core i5-13600K', 3.50, 14, 'LGA 1700', 9.0),
( 'AMD', 'Ryzen 5 5600X', 3.70, 6, 'AM4', 8.2),
( 'Intel', 'Core i9-14900K', 3.20, 24, 'LGA 1700', 9.8);

-- GPU
INSERT INTO `gpu` (`manufacturer`, `model_name`, `vram_gb`, `score`) VALUES
( 'NVIDIA', 'GeForce RTX 4070 Ti', 12, 9.1),
( 'AMD', 'Radeon RX 6600 XT', 8, 7.8),
( 'NVIDIA', 'GeForce GTX 1060', 6, 6.5);

-- MOTHERBOARD
INSERT INTO `motherboard` (`manufacturer`, `model_name`, `chipset`, `socket_type`, `score`) VALUES
( 'Gigabyte', 'Z790 AORUS ELITE AX', 'Z790', 'LGA 1700', 8.9),
( 'ASUS', 'ROG STRIX B550-F GAMING', 'B550', 'AM4', 8.1),
( 'MSI', 'PRO B760-P WIFI', 'B760', 'LGA 1700', 7.5);

-- PC (CONFIGURATIONS)
INSERT INTO `pc` (`config_name`, `id_ram`, `id_motherboard`, `id_cpu`, `id_gpu`) VALUES
( 'Gaming High-End (2025)', 2, 1, 3, 1),    -- ID 1
( 'Gaming Mid-Range (2024)', 1, 1, 1, 1),   -- ID 2
( 'Budget Gaming (Legacy)', 3, 2, 2, 3),    -- ID 3
( 'Minimum Standard PC', 3, 3, 2, 3);       -- ID 4

-- USERS
INSERT INTO `users` (`username`, `email`, `password_hash`, `id_main_pc`) VALUES
( 'Gamer_Pro77', 'pro.gamer@example.com', 'placeholder_hash_1', 1),
( 'BetaTester01', 'beta.test@example.com', 'placeholder_hash_2', 2),
( 'User_Without_PC', 'no.pc@example.com', 'placeholder_hash_3', NULL);

-- GAMES (using PC ID 2, 1, 4, 3)
INSERT INTO `games` (`title`, `release_year`, `publisher`, `price`, `description`, `id_min_pc`, `id_recommended_pc`, `creator`) VALUES
( 'Cyberpunk 2077', 2020, 'CD Projekt', 59.99, 'Un RPG open-world d\'azione-avventura ambientato a Night City.', 2, 1, 'CD Projekt Red'),
( 'Terraria', 2011, 'Re-Logic', 9.99, 'Un sandbox 2D con esplorazione e combattimento.', 4, 4, 'Re-Logic'),
( 'Red Dead Redemption 2', 2018, 'Rockstar Games', 49.99, 'Un epico open-world ambientato nell\'America della fine del 1800.', 3, 2, 'Rockstar Games');

-- TAGS
INSERT INTO `tag` (`name`) VALUES
( 'RPG'),
( 'Open World'),
( 'Action'),
( 'Shooter'),
( 'Indie'),
( 'Sandbox'),
( 'Western'),
( 'Sci-Fi');

-- GAME_TAGS
INSERT INTO `game_tags` (`id_game`, `id_tag`) VALUES 
(1, 1), (1, 2), (1, 3), (1, 4), (1, 8), -- Cyberpunk 2077
(2, 5), (2, 6),                         -- Terraria
(3, 2), (3, 3), (3, 7);                 -- Red Dead Redemption 2

-- REVIEWS
INSERT INTO `reviews` (`id_game`, `id_user`, `score`, `comment`) VALUES
( 1, 1, 9, 'Assolutamente incredibile dopo le patch, grafica mozzafiato!'),
( 2, 2, 10, 'Semplice e infinito. Un classico senza tempo.'),
( 3, 1, 10, 'La migliore storia e il miglior open-world mai creati.');
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

    } while ($dbConnection->more_results() && $dbConnection->next_result());

    if (!$error_occurred) {
        echo $success_message;
    }

} else {
    echo "Error (during multi query): " . $dbConnection->error;
}

$dbConnection->close();