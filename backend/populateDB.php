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
( 'User_Without_PC', 'placeholder_hash_3', NULL);

-- GAMES (using PC IDs)
INSERT IGNORE INTO `games` (`title`, `release_year`, `publisher`, `price`, `description`, `id_min_pc`, `id_recommended_pc`, `creator`, `img_URL`) VALUES
('Elden Ring', 2022, 'Bandai Namco', 59.99, 'Action RPG dark fantasy sviluppato da FromSoftware.', 1, 2, 'FromSoftware', ''),
('The Witcher 3: Wild Hunt', 2015, 'CD Projekt', 29.99, 'Geralt di Rivia cerca la figlia adottiva in un mondo devastato.', 3, 2, 'CD Projekt Red', ''),
('Minecraft', 2011, 'Mojang Studios', 23.95, 'Sandbox basato sulla costruzione con blocchi e avventura.', 4, 4, 'Mojang Studios', ''),
('Stardew Valley', 2016, 'ConcernedApe', 13.99, 'Simulatore di vita agricola e rurale.', 4, 4, 'ConcernedApe', ''),
('Grand Theft Auto V', 2013, 'Rockstar Games', 29.99, 'Tre criminali compiono rapine audaci a Los Santos.', 3, 2, 'Rockstar North', ''),
('Hades', 2020, 'Supergiant Games', 24.50, 'Roguelike dungeon crawler ambientato nell\'oltretomba greco.', 4, 3, 'Supergiant Games', ''),
('Baldur''s Gate 3', 2023, 'Larian Studios', 59.99, 'RPG basato sull''universo di Dungeons & Dragons.', 2, 1, 'Larian Studios', ''),
('Portal 2', 2011, 'Valve', 9.75, 'Puzzle game basato sulla fisica e portali spaziali.', 4, 4, 'Valve', ''),
('God of War', 2018, 'Sony Interactive', 49.99, 'Kratos e suo figlio Atreus affrontano gli dei norreni.', 2, 1, 'Santa Monica Studio', ''),
('Sekiro: Shadows Die Twice', 2019, 'Activision', 59.99, 'Un ninja cerca vendetta nel Giappone del periodo Sengoku.', 3, 2, 'FromSoftware', ''),
('Doom Eternal', 2020, 'Bethesda', 39.99, 'Stermina i demoni sulla Terra in questo FPS frenetico.', 2, 1, 'id Software', ''),
('Subnautica', 2018, 'Unknown Worlds', 29.99, 'Sopravvivenza sottomarina su un pianeta alieno.', 3, 2, 'Unknown Worlds', ''),
('Outer Wilds', 2019, 'Annapurna Interactive', 22.99, 'Mistero spaziale ambientato in un sistema solare in loop.', 4, 3, 'Mobius Digital', ''),
('Resident Evil Village', 2021, 'Capcom', 39.99, 'Ethan Winters affronta orrori in un villaggio remoto.', 2, 1, 'Capcom', ''),
('Disco Elysium', 2019, 'ZA/UM', 39.99, 'RPG investigativo con un sistema di abilità unico.', 4, 4, 'ZA/UM', ''),
('Apex Legends', 2019, 'Electronic Arts', 0.00, 'Battle royale a squadre con personaggi unici.', 3, 2, 'Respawn Entertainment', ''),
('Factorio', 2020, 'Wube Software', 32.00, 'Costruisci e gestisci fabbriche automatizzate.', 4, 3, 'Wube Software', ''),
('Celeste', 2018, 'Maddy Makes Games', 19.50, 'Platform impegnativo sulla crescita personale.', 4, 4, 'Maddy Thorson', ''),
('Civilization VI', 2016, '2K Games', 59.99, 'Strategia a turni per costruire un impero eterno.', 4, 3, 'Firaxis Games', ''),
( 'Cyberpunk 2077', 2020, 'CD Projekt', 59.99, 'Un RPG open-world d\'azione-avventura ambientato a Night City.', 2, 1, 'CD Projekt Red', ''),
( 'Terraria', 2011, 'Re-Logic', 9.99, 'Un sandbox 2D con esplorazione e combattimento.', 4, 4, 'Re-Logic', ''),
( 'Hollow Knight: Silksong', 2025, 'Team Cherry', 19.50, 'Scopri un vasto regno infestato in Hollow Knight: Silksong! Esplora, combatti e sopravvivi per conquistare la sommità di una terra dominata dalla seta e dal canto. ', 4, 4, 'Team cherry', ''),
( 'Hollow Knight', 2017, 'Team Cherry', 14.99, 'Forgia la tua strada in Hollow Knight! Un epico gioco d\'azione e avventura sullo sfondo di un vasto regno in rovina popolato da insetti ed eroi. Esplora le caverne tortuose, combatti contro sudicie creature e fai amicizia con insetti bizzarri, il tutto disegnato a mano secondo il classico stile 2D. ', 4, 4, 'Team cherry', ''),
( 'Red Dead Redemption 2', 2018, 'Rockstar Games', 49.99, 'Un epico open-world ambientato nell\'America della fine del 1800.', 3, 2, 'Rockstar Games', '');

-- TAGS
INSERT IGNORE INTO `tag` (`name`) VALUES 
('Adventure'), ('Platformer'), ('Survival'), ('Souls-like'), ('Dark Fantasy'), 
('Strategy'), ('Turn-Based'), ('Metroidvania'), ('Roguelike'), ('Building'), 
('Farming Sim'), ('First-Person'), ('Third-Person'), ('Atmospheric'), ('Story Rich'), 
('Multiplayer'), ('Singleplayer'), ('Horror'), ('Puzzle'), ('Difficult');

-- GAME_TAGS
INSERT IGNORE INTO `game_tags` (`id_game`, `id_tag`) VALUES 
-- Elden Ring (1)
(1, 1), (1, 2), (1, 3), (1, 9), (1, 10), (1, 17), (1, 25),
-- The Witcher 3 (2)
(2, 1), (2, 2), (2, 3), (2, 10), (2, 18), (2, 20),
-- Minecraft (3)
(3, 2), (3, 6), (3, 9), (3, 11), (3, 15), (3, 19),
-- Stardew Valley (4)
(4, 1), (4, 5), (4, 14), (4, 16), (4, 20),
-- GTA V (5)
(5, 2), (5, 3), (5, 4), (5, 18), (5, 19),
-- Hades (6)
(6, 3), (6, 5), (6, 12), (6, 17), (6, 20),
-- Baldur's Gate 3 (7)
(7, 1), (7, 10), (7, 13), (7, 14), (7, 20),
-- Portal 2 (8)
(8, 17), (8, 22), (8, 19), (8, 20),
-- God of War (9)
(9, 3), (9, 9), (9, 18), (9, 20),
-- Sekiro (10)
(10, 3), (10, 9), (10, 10), (10, 20), (10, 25),
-- Doom Eternal (11)
(11, 3), (11, 4), (11, 17), (11, 25),
-- Subnautica (12)
(12, 1), (12, 9), (12, 11), (12, 17), (12, 23),
-- Outer Wilds (13)
(13, 1), (13, 2), (13, 17), (13, 22), (13, 20),
-- RE Village (14)
(14, 3), (14, 17), (14, 23), (14, 18),
-- Disco Elysium (15)
(15, 1), (15, 14), (15, 18), (15, 20),
-- Apex Legends (16)
(16, 4), (16, 17), (16, 19),
-- Factorio (17)
(17, 11), (17, 13), (17, 15), (17, 19),
-- Celeste (18)
(18, 5), (18, 10), (18, 20), (18, 25),
-- Civ VI (19)
(19, 13), (19, 14), (19, 19),
-- Cyberpunk 2077 (20)
(20, 1), (20, 2), (20, 4), (20, 8), (20, 18),
-- Terraria (21)
(21, 5), (21, 6), (21, 9), (21, 11), (21, 19),
-- Silksong (22)
(22, 5), (22, 10), (22, 11), (22, 25),
-- Hollow Knight (23)
(23, 5), (23, 10), (23, 11), (23, 25),
-- RDR2 (24)
(24, 2), (24, 3), (24, 7), (24, 18), (24, 20);

-- USER_GAMES (Users' Library)
-- Linking Users (ID 1, 2) to Games (ID 1, 2, 3)
INSERT IGNORE INTO `user_games` (`id_user`, `id_game`) VALUES
(1, 1),
(1, 3),
(2, 2),
(4, 1),
(4, 2),
(4, 3),
(4, 4),
(4, 5),
(4, 6),
(4, 7),
(4, 8),
(4, 9),
(4, 10),
(4, 11),
(4, 12),
(4, 13),
(4, 14),
(4, 15),
(4, 16),
(4, 17),
(4, 18),
(4, 19),
(4, 20),
(4, 21);
-- REVIEWS
INSERT IGNORE INTO `reviews` (`id_game`, `id_user`, `score`, `comment`) VALUES
( 1, 1, 9, 'Assolutamente incredibile dopo le patch, grafica mozzafiato!'),
( 2, 2, 10, 'Semplice e infinito. Un classico senza tempo.'),
( 3, 1, 10, 'La migliore storia e il miglior open-world mai creati.');
";

// Execute the multi-query script using $conn (from DBConnect.php)
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