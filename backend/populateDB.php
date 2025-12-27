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
INSERT IGNORE INTO `games` (`title`, `release_year`, `publisher`, `price`, `description`,`detailed_description`, `id_min_pc`, `id_recommended_pc`, `creator`, `img_URL`) VALUES
('Elden Ring', 2022, 'Bandai Namco', 59.99, 'Action RPG dark fantasy sviluppato da FromSoftware.', 'Alzati, Senzaluce, e lasciati guidare dalla grazia per sfoggiare il potere dell''Anello Elden e diventare un Lord Ancestrale nell''Interregno. Un mondo vasto e pieno di pericoli ti attende, con dungeon complessi e nemici leggendari.', 1, 2, 'FromSoftware', ''),
('The Witcher 3: Wild Hunt', 2015, 'CD Projekt', 29.99, 'Geralt di Rivia cerca la figlia adottiva in un mondo devastato.', 'Vivi l''avventura definitiva nei panni di Geralt di Rivia, un cacciatore di mostri mercenario. In un mondo aperto devastato dalla guerra e infestato da creature terribili, dovrai trovare Ciri, la Figlia della Profezia, un''arma vivente capace di mutare la forma del mondo.', 3, 2, 'CD Projekt Red', ''),
('Minecraft', 2011, 'Mojang Studios', 23.95, 'Sandbox basato sulla costruzione con blocchi e avventura.', 'Esplora mondi infiniti e costruisci di tutto, dalla più semplice delle case al più maestoso dei castelli. Gioca in Modalità Creativa con risorse illimitate o scava nelle profondità del mondo in Modalità Sopravvivenza, fabbricando armi e armature per difenderti dai mostri.', 4, 4, 'Mojang Studios', ''),
('Stardew Valley', 2016, 'ConcernedApe', 13.99, 'Simulatore di vita agricola e rurale.', 'Hai ereditato il vecchio appezzamento di terra di tuo nonno a Stardew Valley. Armato di strumenti di seconda mano e poche monete, ti appresti a iniziare la tua nuova vita. Riuscirai a imparare a vivere della terra e a trasformare questi campi incolti in una casa fiorente?', 4, 4, 'ConcernedApe', ''),
('Grand Theft Auto V', 2013, 'Rockstar Games', 29.99, 'Tre criminali compiono rapine audaci a Los Santos.', 'Quando un giovane imbroglione, un rapinatore di banche in pensione e un terribile psicopatico si ritrovano invischiati con alcuni degli elementi più spaventosi e folli del mondo criminale, del governo degli Stati Uniti e dell''industria dello spettacolo, devono compiere una serie di pericolose rapine.', 3, 2, 'Rockstar North', ''),
('Hades', 2020, 'Supergiant Games', 24.50, 'Roguelike dungeon crawler ambientato nell''oltretomba greco.', 'In quanto immortale Principe dell''Oltretomba, brandirai i poteri e le mitiche armi dell''Olimpo per liberarti dalle grinfie del dio dei morti in persona, diventando sempre più forte e scoprendo nuovi segreti della storia a ogni tentativo di fuga.', 4, 3, 'Supergiant Games', ''),
('Baldur''s Gate 3', 2023, 'Larian Studios', 59.99, 'RPG basato sull''universo di Dungeons & Dragons.', 'Raduna la tua compagnia e torna ai Reami Perduti in una storia di amicizia e tradimento, sacrificio e sopravvivenza, e del fascino del potere assoluto. Abilità misteriose si stanno risvegliando dentro di te, derivanti da un parassita dei Mind Flayer impiantato nel tuo cervello.', 2, 1, 'Larian Studios', ''),
('Portal 2', 2011, 'Valve', 9.75, 'Puzzle game basato sulla fisica e portali spaziali.', 'Portal 2 attinge alla formula vincente fatta di gameplay innovativo, storia coinvolgente e musica creativa che ha permesso al Portal originale di vincere oltre 70 premi del settore. La modalità single player introduce nuovi personaggi e una serie di enigmi ancora più complessi.', 4, 4, 'Valve', ''),
('God of War', 2018, 'Sony Interactive', 49.99, 'Kratos e suo figlio Atreus affrontano gli dei norreni.', 'Dopo aver compiuto la sua vendetta contro gli dei dell''Olimpo, Kratos vive ora nel regno delle divinità e dei mostri norreni. È in questo mondo spietato e selvaggio che deve combattere per la sopravvivenza e insegnare a suo figlio a fare lo stesso.', 2, 1, 'Santa Monica Studio', ''),
('Sekiro: Shadows Die Twice', 2019, 'Activision', 59.99, 'Un ninja cerca vendetta nel Giappone del periodo Sengoku.', 'Esplora il Giappone della fine del 1500, in pieno periodo Sengoku: un''epoca brutale, segnata da conflitti costanti. Affronta nemici più grandi della vita stessa in un mondo oscuro e perverso. Scatena un arsenale di protesi letali e abilità ninja mentre mescoli stealth e combattimenti viscerali.', 3, 2, 'FromSoftware', ''),
('Doom Eternal', 2020, 'Bethesda', 39.99, 'Stermina i demoni sulla Terra in questo FPS frenetico.', 'Le armate dell''inferno hanno invaso la Terra. Diventa lo Slayer in un''epica campagna per giocatore singolo, sconfiggi i demoni attraverso le dimensioni e ferma la distruzione finale dell''umanità. L''unica cosa di cui hanno paura... sei tu.', 2, 1, 'id Software', ''),
('Subnautica', 2018, 'Unknown Worlds', 29.99, 'Sopravvivenza sottomarina su un pianeta alieno.', 'Sei precipitato su un mondo alieno oceanico e l''unica via è scendere. Gli oceani di Subnautica spaziano da barriere coralline baciate dal sole a pericolose fosse abissali, campi di lava e fiumi sottomarini bio-luminescenti. Gestisci il tuo ossigeno mentre esplori.', 3, 2, 'Unknown Worlds', ''),
('Outer Wilds', 2019, 'Annapurna Interactive', 22.99, 'Mistero spaziale ambientato in un sistema solare in loop.', 'Vincitore del premio come Miglior Gioco ai BAFTA Games Awards 2020, Outer Wilds è un mistero open world su un sistema solare intrappolato in un loop temporale infinito. Sei il nuovo acquisto della Outer Wilds Ventures, un programma spaziale alla ricerca di risposte.', 4, 3, 'Mobius Digital', ''),
('Resident Evil Village', 2021, 'Capcom', 39.99, 'Ethan Winters affronta orrori in un villaggio remoto.', 'Vivi l''orrore della sopravvivenza come mai prima d''ora nell''ottavo capitolo principale della serie Resident Evil. Ambientato pochi anni dopo i tragici eventi di Resident Evil 7, la nuova storia vede Ethan Winters in un villaggio innevato pieno di creature terrificanti.', 2, 1, 'Capcom', ''),
('Disco Elysium', 2019, 'ZA/UM', 39.99, 'RPG investigativo con un sistema di abilità unico.', 'Disco Elysium - The Final Cut è un rivoluzionario gioco di ruolo. Sei un detective con un sistema di abilità unico a tua disposizione e un intero quartiere cittadino da esplorare. Interroga personaggi indimenticabili, risolvi omicidi o accetta mazzette.', 4, 4, 'ZA/UM', ''),
('Apex Legends', 2019, 'Electronic Arts', 0.00, 'Battle royale a squadre con personaggi unici.', 'Domina con stile in Apex Legends, uno sparatutto Battle Royale gratuito in cui personaggi leggendari con

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