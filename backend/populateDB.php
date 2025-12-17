<?php

require_once "DBConnect.php";


// SQL SCRIPT: DATA POPULATION
// Using 'INSERT IGNORE' prevents the script from crashing if data already exists
$sql_script = "
USE `rigwizard`;

-- RAM
INSERT IGNORE INTO `ram` (`brand`, `model_name`, `quantity_gb`, `frequency_mhz`, `memory_type`, `score`) VALUES
( 'Corsair', 'Vengeance RGB Pro 16GB', 16, 3200, 'DDR4', 8.5),
( 'Kingston', 'Fury Renegade 32GB', 32, 6000, 'DDR5', 9.2),
( 'G.Skill', 'Trident Z RGB 8GB', 8, 3000, 'DDR4', 7.9);

-- CPU
INSERT IGNORE INTO `cpu` (`manufacturer`, `model_name`, `frequency_ghz`, `cores`, `socket_type`, `score`) VALUES
( 'Intel', 'Core i5-13600K', 3.50, 14, 'LGA 1700', 9.0),
( 'AMD', 'Ryzen 5 5600X', 3.70, 6, 'AM4', 8.2),
( 'Intel', 'Core i9-14900K', 3.20, 24, 'LGA 1700', 9.8);

-- GPU
INSERT IGNORE INTO `gpu` (`manufacturer`, `model_name`, `vram_gb`, `score`) VALUES
( 'NVIDIA', 'GeForce RTX 4070 Ti', 12, 9.1),
( 'AMD', 'Radeon RX 6600 XT', 8, 7.8),
( 'NVIDIA', 'GeForce GTX 1060', 6, 6.5);

-- MOTHERBOARD
INSERT IGNORE INTO `motherboard` (`manufacturer`, `model_name`, `chipset`, `socket_type`, `score`) VALUES
( 'Gigabyte', 'Z790 AORUS ELITE AX', 'Z790', 'LGA 1700', 8.9),
( 'ASUS', 'ROG STRIX B550-F GAMING', 'B550', 'AM4', 8.1),
( 'MSI', 'PRO B760-P WIFI', 'B760', 'LGA 1700', 7.5);

-- PC (CONFIGURATIONS)
INSERT IGNORE INTO `pc` (`config_name`, `id_ram`, `id_motherboard`, `id_cpu`, `id_gpu`) VALUES
( 'Gaming High-End (2025)', 2, 1, 3, 1),
( 'Gaming Mid-Range (2024)', 1, 1, 1, 1),
( 'Budget Gaming (Legacy)', 3, 2, 2, 3),
( 'Minimum Standard PC', 3, 3, 2, 3);

-- USERS
INSERT IGNORE INTO `users` (`username`, `password_hash`, `id_main_pc`) VALUES
( 'Gamer_Pro77', 'placeholder_hash_1', 1),
( 'BetaTester01', 'placeholder_hash_2', 2),
( 'User_Without_PC', 'placeholder_hash_3', NULL);

-- GAMES (using PC IDs)
INSERT IGNORE INTO `games` (`title`, `release_year`, `publisher`, `price`, `description`, `id_min_pc`, `id_recommended_pc`, `creator`) VALUES
( 'Cyberpunk 2077', 2020, 'CD Projekt', 59.99, 'Un RPG open-world d\'azione-avventura ambientato a Night City.', 2, 1, 'CD Projekt Red'),
( 'Terraria', 2011, 'Re-Logic', 9.99, 'Un sandbox 2D con esplorazione e combattimento.', 4, 4, 'Re-Logic'),
( 'Red Dead Redemption 2', 2018, 'Rockstar Games', 49.99, 'Un epico open-world ambientato nell\'America della fine del 1800.', 3, 2, 'Rockstar Games');

-- TAGS
INSERT IGNORE INTO `tag` (`name`) VALUES
( 'RPG'),
( 'Open World'),
( 'Action'),
( 'Shooter'),
( 'Indie'),
( 'Sandbox'),
( 'Western'),
( 'Sci-Fi');

-- GAME_TAGS
INSERT IGNORE INTO `game_tags` (`id_game`, `id_tag`) VALUES 
(1, 1), (1, 2), (1, 3), (1, 4), (1, 8),
(2, 5), (2, 6),
(3, 2), (3, 3), (3, 7);

-- REVIEWS
INSERT IGNORE INTO `reviews` (`id_game`, `id_user`, `score`, `comment`) VALUES
( 1, 1, 9, 'Assolutamente incredibile dopo le patch, grafica mozzafiato!'),
( 2, 2, 10, 'Semplice e infinito. Un classico senza tempo.'),
( 3, 1, 10, 'La migliore storia e il miglior open-world mai creati.');
";



// Execute the multi-query script
if ($dbConnection->multi_query($sql_script)) {
    
    $success_message = "SQL script executed successfully. Database populated (duplicates ignored).";
    $error_occurred = false;

    // Cycle through all results of the multi_query
    do {
        // We store the result to clear the buffer (essential for multi_query)
        if ($result = $dbConnection->store_result()) {
            $result->free();
        }

        // Check for errors in the specific statement
        if ($dbConnection->errno) {
            echo "Error executing SQL script. Failed statement: " . $dbConnection->error . "\n";
            $error_occurred = true;
        }

    } while ($dbConnection->more_results() && $dbConnection->next_result());

    if (!$error_occurred) {
        echo $success_message;
    }

} else {
    echo "Error (during multi query setup): " . $dbConnection->error;
}

// Close connection
$dbConnection->close();
?>