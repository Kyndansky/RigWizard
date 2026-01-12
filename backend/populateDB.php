<?php

require_once "DBConnect.php";

$sql_script = "
USE `rigwizard`;

-- RAM
INSERT IGNORE INTO `ram` (`brand`, `model_name`, `quantity_gb`, `frequency_mhz`, `memory_type`, `score`) VALUES
( 'G.Skill', 'Trident Z5 CK (CUDIMM) 32GB', 32, 9000, 'DDR5', 10.0),
( 'G.Skill', 'Trident Z5 RGB 48GB', 48, 8400, 'DDR5', 10.0),
( 'Corsair', 'Dominator Titanium 64GB', 64, 8000, 'DDR5', 9.9),
( 'TeamGroup', 'T-Force XTREEM ARGB 32GB', 32, 8200, 'DDR5', 9.9),
( 'Kingston', 'Fury Renegade Pro 128GB', 128, 5600, 'DDR5', 9.9),
( 'Patriot', 'Viper Xtreme 5 32GB', 32, 8000, 'DDR5', 9.8),
( 'Kingston', 'Fury Renegade RGB 48GB', 48, 8000, 'DDR5', 9.8),
( 'Corsair', 'Dominator Platinum RGB 32GB', 32, 7200, 'DDR5', 9.8),
( 'G.Skill', 'Trident Z5 RGB 32GB', 32, 6400, 'DDR5', 9.7),
( 'G.Skill', 'Trident Z Royal 64GB', 64, 3600, 'DDR4', 9.6),
( 'Corsair', 'Vengeance RGB 64GB', 64, 6000, 'DDR5', 9.5),
( 'G.Skill', 'Trident Z5 Neo RGB (AMD Expo) 32GB', 32, 6000, 'DDR5', 9.5),
( 'Kingston', 'Fury Renegade 32GB', 32, 7200, 'DDR5', 9.5),
( 'Corsair', 'Vengeance RGB 32GB', 32, 6400, 'DDR5', 9.4),
( 'Patriot', 'Viper Venom 32GB', 32, 7400, 'DDR5', 9.4),
( 'TeamGroup', 'T-Force Delta RGB 48GB', 48, 7200, 'DDR5', 9.4),
( 'ADATA', 'XPG Lancer Blade RGB 32GB', 32, 6400, 'DDR5', 9.3),
( 'Patriot', 'Viper Steel 16GB', 16, 4400, 'DDR4', 9.3),
( 'Kingston', 'Fury Renegade 32GB', 32, 6000, 'DDR5', 9.2),
( 'Lexar', 'ARES RGB 32GB', 32, 6400, 'DDR5', 9.2),
( 'G.Skill', 'Trident Z Neo 32GB', 32, 4000, 'DDR4', 9.2),
( 'TeamGroup', 'T-Force Delta RGB 32GB', 32, 6000, 'DDR5', 9.1),
( 'Crucial', 'Pro Overclocking 32GB', 32, 6000, 'DDR5', 9.1),
( 'Corsair', 'Dominator Platinum RGB 32GB', 32, 4000, 'DDR4', 9.1),
( 'Mushkin', 'Redline Lumina 32GB', 32, 4133, 'DDR4', 9.0),
( 'ADATA', 'XPG Lancer RGB 32GB', 32, 6000, 'DDR5', 8.8),
( 'Thermaltake', 'TOUGHRAM RGB 16GB', 16, 4400, 'DDR4', 8.8),
( 'G.Skill', 'Ripjaws V 16GB', 16, 3600, 'DDR4', 8.7),
( 'Crucial', 'Ballistix 16GB', 16, 3600, 'DDR4', 8.6),
( 'Corsair', 'Vengeance RGB Pro 16GB', 16, 3200, 'DDR4', 8.5),
( 'Gigabyte', 'AORUS RGB 16GB', 16, 3733, 'DDR4', 8.5),
( 'Crucial', 'Pro RAM 32GB', 32, 5600, 'DDR5', 8.5),
( 'Corsair', 'Vengeance LPX 32GB', 32, 3200, 'DDR4', 8.4),
( 'Kingston', 'Fury Beast 16GB', 16, 5200, 'DDR5', 8.3),
( 'PNY', 'XLR8 Gaming Epic-X 16GB', 16, 3200, 'DDR4', 8.0),
( 'G.Skill', 'Trident Z RGB 8GB', 8, 3000, 'DDR4', 7.9),
( 'TeamGroup', 'T-Force Vulcan Z 16GB', 16, 3200, 'DDR4', 7.8),
( 'Samsung', 'OEM Desktop 16GB', 16, 3200, 'DDR4', 7.5),
( 'Crucial', 'Standard Desktop 8GB', 8, 4800, 'DDR5', 7.2),
( 'TeamGroup', 'Elite DDR5 16GB', 16, 4800, 'DDR5', 6.9),
( 'Crucial', 'Classic Desktop 16GB', 16, 3200, 'DDR4', 6.8),
( 'Silicon Power', 'DDR4 16GB RAM', 16, 3200, 'DDR4', 6.5),
( 'Kingston', 'ValueRAM 8GB', 8, 2666, 'DDR4', 6.2),
( 'ADATA', 'Premier 8GB', 8, 3200, 'DDR4', 6.1),
( 'Patriot', 'Signature Line 8GB', 8, 2400, 'DDR4', 5.9),
( 'Pny', 'Performance 8GB', 8, 2666, 'DDR4', 5.5),
( 'G.Skill', 'Value Series 4GB', 4, 2400, 'DDR4', 4.8),
( 'Samsung', 'OEM Green Stick 4GB', 4, 2133, 'DDR4', 4.5),
( 'Apacer', 'DDR4 Unbuffered 4GB', 4, 2400, 'DDR4', 4.4),
( 'Mushkin', 'Essentials 8GB', 8, 1600, 'DDR3', 4.2),
( 'Timetec', 'Hynix IC 8GB', 8, 1600, 'DDR3', 4.0),
( 'Hynix', 'Generic Desktop 4GB', 4, 1600, 'DDR3', 3.8),
( 'Crucial', 'CT51264BA160B 4GB', 4, 1600, 'DDR3', 3.5),
( 'Kingston', 'KVR DDR3 4GB', 4, 1333, 'DDR3', 3.2),
( 'Patriot', 'Signature Line 4GB', 4, 1333, 'DDR3', 3.0),
( 'Integral', 'Value Series 2GB', 2, 1333, 'DDR3', 2.1);

-- CPU
INSERT IGNORE INTO `cpu` (`manufacturer`, `model_name`, `frequency_ghz`, `cores`, `socket_type`, `score`) VALUES
( 'AMD', 'Ryzen 9 9950X', 4.30, 16, 'AM5', 10.0),
( 'Intel', 'Core i9-14900KS', 3.20, 24, 'LGA 1700', 9.9),
( 'AMD', 'Ryzen 7 9800X3D', 4.70, 8, 'AM5', 9.9),
( 'Intel', 'Core Ultra 9 285K', 3.70, 24, 'LGA 1851', 9.8),
( 'Intel', 'Core i9-14900K', 3.20, 24, 'LGA 1700', 9.8),
( 'AMD', 'Ryzen 9 7950X3D', 4.20, 16, 'AM5', 9.7),
( 'Intel', 'Core i9-13900K', 3.00, 24, 'LGA 1700', 9.6),
( 'AMD', 'Ryzen 9 9900X', 4.40, 12, 'AM5', 9.5),
( 'AMD', 'Ryzen 7 7800X3D', 4.20, 8, 'AM5', 9.4),
( 'Intel', 'Core i7-14700K', 3.40, 20, 'LGA 1700', 9.3),
( 'AMD', 'Ryzen 7 9700X', 3.80, 8, 'AM5', 9.2),
( 'Intel', 'Core Ultra 7 265K', 3.90, 20, 'LGA 1851', 9.1),
( 'Intel', 'Core i5-13600K', 3.50, 14, 'LGA 1700', 9.0),
( 'AMD', 'Ryzen 9 5950X', 3.40, 16, 'AM4', 8.9),
( 'Intel', 'Core i7-13700K', 3.40, 16, 'LGA 1700', 8.8),
( 'Intel', 'Core i5-14600K', 3.50, 14, 'LGA 1700', 8.7),
( 'AMD', 'Ryzen 5 9600X', 3.90, 6, 'AM5', 8.6),
( 'AMD', 'Ryzen 5 7600X', 4.70, 6, 'AM5', 8.5),
( 'Intel', 'Core i5-12600K', 3.70, 10, 'LGA 1700', 8.3),
( 'AMD', 'Ryzen 5 5600X', 3.70, 6, 'AM4', 8.2),
( 'Intel', 'Core i5-13400F', 2.50, 10, 'LGA 1700', 8.1),
( 'AMD', 'Ryzen 7 5700X', 3.40, 8, 'AM4', 8.0),
( 'AMD', 'Ryzen 5 5600', 3.50, 6, 'AM4', 7.8),
( 'Intel', 'Core i5-11600K', 3.90, 6, 'LGA 1200', 7.5),
( 'Intel', 'Core i3-14100', 3.50, 4, 'LGA 1700', 6.8),
( 'AMD', 'Ryzen 5 5500', 3.60, 6, 'AM4', 6.5),
( 'Intel', 'Core i3-12100F', 3.30, 4, 'LGA 1700', 6.2),
( 'AMD', 'Ryzen 3 4100', 3.80, 4, 'AM4', 5.5),
( 'Intel', 'Pentium Gold G7400', 3.70, 2, 'LGA 1700', 4.8),
( 'AMD', 'Athlon 3000G', 3.50, 2, 'AM4', 4.2),
( 'Intel', 'Core i7-4770K', 3.50, 4, 'LGA 1150', 3.9),
( 'AMD', 'FX-8350', 4.00, 8, 'AM3+', 3.5),
( 'Intel', 'Core i5-2500K', 3.30, 4, 'LGA 1155', 3.2),
( 'Intel', 'Celeron G5905', 3.50, 2, 'LGA 1200', 3.0),
( 'Intel', 'Core 2 Quad Q9550', 2.83, 4, 'LGA 775', 2.8),
( 'AMD', 'Phenom II X4 965', 3.40, 4, 'AM3', 2.5),
( 'Intel', 'Core 2 Duo E8400', 3.00, 2, 'LGA 775', 1.5);

-- GPU
INSERT IGNORE INTO `gpu` (`manufacturer`, `model_name`, `vram_gb`, `score`) VALUES
( 'NVIDIA', 'GeForce RTX 5090', 32, 10.0),
( 'NVIDIA', 'GeForce RTX 4090', 24, 9.9),
( 'AMD', 'Radeon RX 7900 XTX', 24, 9.6),
( 'NVIDIA', 'GeForce RTX 5080', 16, 9.8),
( 'NVIDIA', 'GeForce RTX 4080 Super', 16, 9.5),
( 'AMD', 'Radeon RX 7900 XT', 20, 9.2),
( 'NVIDIA', 'GeForce RTX 4070 Ti Super', 16, 9.1),
( 'Intel', 'Arc B580', 12, 8.4),
( 'NVIDIA', 'GeForce RTX 4070 Super', 12, 8.9),
( 'AMD', 'Radeon RX 7800 XT', 16, 8.7),
( 'NVIDIA', 'GeForce RTX 3080', 10, 8.5),
( 'AMD', 'Radeon RX 6800 XT', 16, 8.3),
( 'Intel', 'Arc A770', 16, 8.2),
( 'NVIDIA', 'GeForce RTX 4060 Ti', 16, 8.0),
( 'AMD', 'Radeon RX 7700 XT', 12, 7.9),
( 'NVIDIA', 'GeForce RTX 4060', 8, 7.7),
( 'AMD', 'Radeon RX 7600 XT', 16, 7.5),
( 'NVIDIA', 'GeForce RTX 3060', 12, 7.3),
( 'AMD', 'Radeon RX 6700 XT', 12, 7.6),
( 'NVIDIA', 'GeForce RTX 2080 Ti', 11, 7.4),
( 'AMD', 'Radeon RX 6650 XT', 8, 7.1),
( 'NVIDIA', 'GeForce GTX 1080 Ti', 11, 7.0),
( 'Intel', 'Arc A380', 6, 6.0),
( 'NVIDIA', 'GeForce RTX 3050', 8, 6.5),
( 'AMD', 'Radeon RX 6500 XT', 4, 5.8),
( 'NVIDIA', 'GeForce GTX 1660 Super', 6, 6.2),
( 'AMD', 'Radeon RX 580', 8, 5.5),
( 'NVIDIA', 'GeForce GTX 1650', 4, 5.0),
( 'NVIDIA', 'GeForce GTX 1050 Ti', 4, 4.5),
( 'AMD', 'Radeon RX 560', 4, 4.0),
( 'NVIDIA', 'GeForce GT 1030', 2, 3.2),
( 'AMD', 'Radeon RX 550', 4, 3.8),
( 'NVIDIA', 'GeForce GT 730', 2, 2.0),
( 'NVIDIA', 'GeForce GT 710', 2, 1.0);

-- MOTHERBOARD
INSERT IGNORE INTO `motherboard` (`manufacturer`, `model_name`, `chipset`, `socket_type`, `score`) VALUES
( 'ASUS', 'ROG Maximus Z890 Extreme', 'Z890', 'LGA 1851', 10.0),
( 'MSI', 'MEG X870E GODLIKE', 'X870E', 'AM5', 10.0),
( 'Gigabyte', 'X870E AORUS MASTER', 'X870E', 'AM5', 9.8),
( 'ASRock', 'Z890 Taichi', 'Z890', 'LGA 1851', 9.7),
( 'ASUS', 'ROG Crosshair X670E Hero', 'X670E', 'AM5', 9.6),
( 'MSI', 'MPG Z790 Carbon WIFI', 'Z790', 'LGA 1700', 9.4),
( 'Gigabyte', 'Z790 AORUS ELITE AX', 'Z790', 'LGA 1700', 8.9),
( 'ASUS', 'TUF Gaming X870-Plus WIFI', 'X870', 'AM5', 9.1),
( 'MSI', 'MAG B650 Tomahawk WIFI', 'B650', 'AM5', 8.8),
( 'ASRock', 'B650E Steel Legend WIFI', 'B650E', 'AM5', 8.9),
( 'Gigabyte', 'B650 Gaming X AX', 'B650', 'AM5', 8.5),
( 'ASUS', 'ROG STRIX B760-F GAMING WIFI', 'B760', 'LGA 1700', 8.6),
( 'MSI', 'PRO B760-P WIFI', 'B760', 'LGA 1700', 7.5),
( 'ASRock', 'Z790 Pro RS', 'Z790', 'LGA 1700', 8.2),
( 'ASUS', 'ROG STRIX B550-F GAMING', 'B550', 'AM4', 8.1),
( 'Gigabyte', 'X570S AORUS Master', 'X570', 'AM4', 8.7),
( 'MSI', 'MAG B550 Torpedo', 'B550', 'AM4', 7.9),
( 'ASRock', 'B550 Phantom Gaming 4', 'B550', 'AM4', 7.2),
( 'ASUS', 'Prime B650M-A WIFI', 'B650', 'AM5', 7.4),
( 'Gigabyte', 'A620M GAMING X', 'A620', 'AM5', 6.8),
( 'MSI', 'PRO H610M-G DDR4', 'H610', 'LGA 1700', 6.2),
( 'ASRock', 'A620M-HDV/M.2', 'A620', 'AM5', 6.0),
( 'ASUS', 'Prime H510M-E', 'H510', 'LGA 1200', 5.5),
( 'Gigabyte', 'B450M DS3H V2', 'B450', 'AM4', 6.5),
( 'MSI', 'A520M-A PRO', 'A520', 'AM4', 5.8),
( 'ASRock', 'H110M-DGS', 'H110', 'LGA 1151', 4.5),
( 'ASUS', 'H81M-K', 'H81', 'LGA 1150', 3.8),
( 'Gigabyte', 'GA-H61M-DS2', 'H61', 'LGA 1155', 3.2),
( 'MSI', 'G41M-P33 Combo', 'G41', 'LGA 775', 2.5),
( 'Biostar', 'H310MHP', 'H310', 'LGA 1151', 4.2),
( 'ASRock', 'N68-GS4 FX', 'nForce 630a', 'AM3+', 2.0);

-- PC 
INSERT IGNORE INTO `pc` (`config_name`, `id_ram`, `id_motherboard`, `id_cpu`, `id_gpu`) VALUES
( 'Gaming High-End (2025)', 2, 1, 3, 1),
( 'Gaming Mid-Range (2024)', 1, 1, 1, 1),
( 'Budget Gaming (Legacy)', 3, 2, 2, 3),
( 'Minimum Standard PC', 3, 3, 2, 3);

-- USERS
INSERT IGNORE INTO `users` (`username`, `password_hash`, `id_main_pc`) VALUES
( 'Kynda', '$2y$10$5WCy65o2Im23rQHGPsNpOe61N2jxjqvqoUqYH4VZLKEwZXpQRaXyW', 1),
( 'User_Without_PC', 'placeholder_hash_3', NULL);

-- GAMES 
INSERT IGNORE INTO `games` (`title`, `release_year`, `publisher`, `price`, `description`,`detailed_description`, `id_min_pc`, `id_recommended_pc`, `creator`) VALUES
('Elden Ring', 2022, 'Bandai Namco', 59.99, 'Action RPG dark fantasy sviluppato da FromSoftware.', 'Alzati, Senzaluce, e lasciati guidare dalla grazia per sfoggiare il potere dell''Anello Elden e diventare un Lord Ancestrale nell''Interregno. Un mondo vasto e pieno di pericoli ti attende, con dungeon complessi e nemici leggendari.', 1, 2, 'FromSoftware'),
('The Witcher 3: Wild Hunt', 2015, 'CD Projekt', 29.99, 'Geralt di Rivia cerca la figlia adottiva in un mondo devastato.', 'Vivi l''avventura definitiva nei panni di Geralt di Rivia, un cacciatore di mostri mercenario. In un mondo aperto devastato dalla guerra e infestato da creature terribili, dovrai trovare Ciri, la Figlia della Profezia, un''arma vivente capace di mutare la forma del mondo.', 3, 2, 'CD Projekt Red'),
('Minecraft', 2011, 'Mojang Studios', 23.95, 'Sandbox basato sulla costruzione con blocchi e avventura.', 'Esplora mondi infiniti e costruisci di tutto, dalla più semplice delle case al più maestoso dei castelli. Gioca in Modalità Creativa con risorse illimitate o scava nelle profondità del mondo in Modalità Sopravvivenza, fabbricando armi e armature per difenderti dai mostri.', 4, 4, 'Mojang Studios'),
('Stardew Valley', 2016, 'ConcernedApe', 13.99, 'Simulatore di vita agricola e rurale.', 'Hai ereditato il vecchio appezzamento di terra di tuo nonno a Stardew Valley. Armato di strumenti di seconda mano e poche monete, ti appresti a iniziare la tua nuova vita. Riuscirai a imparare a vivere della terra e a trasformare questi campi incolti in una casa fiorente?', 4, 4, 'ConcernedApe'),
('Grand Theft Auto V', 2013, 'Rockstar Games', 29.99, 'Tre criminali compiono rapine audaci a Los Santos.', 'Quando un giovane imbroglione, un rapinatore di banche in pensione e un terribile psicopatico si ritrovano invischiati con alcuni degli elementi più spaventosi e folli del mondo criminale, del governo degli Stati Uniti e dell''industria dello spettacolo, devono compiere una serie di pericolose rapine.', 3, 2, 'Rockstar North'),
('Hades', 2020, 'Supergiant Games', 24.50, 'Roguelike dungeon crawler ambientato nell''oltretomba greco.', 'In quanto immortale Principe dell''Oltretomba, brandirai i poteri e le mitiche armi dell''Olimpo per liberarti dalle grinfie del dio dei morti in persona, diventando sempre più forte e scoprendo nuovi segreti della storia a ogni tentativo di fuga.', 4, 3, 'Supergiant Games'),
('Baldur''s Gate 3', 2023, 'Larian Studios', 59.99, 'RPG basato sull''universo di Dungeons & Dragons.', 'Raduna la tua compagnia e torna ai Reami Perduti in una storia di amicizia e tradimento, sacrificio e sopravvivenza, e del fascino del potere assoluto. Abilità misteriose si stanno risvegliando dentro di te, derivanti da un parassita dei Mind Flayer impiantato nel tuo cervello.', 2, 1, 'Larian Studios'),
('Portal 2', 2011, 'Valve', 9.75, 'Puzzle game basato sulla fisica e portali spaziali.', 'Portal 2 attinge alla formula vincente fatta di gameplay innovativo, storia coinvolgente e musica creativa che ha permesso al Portal originale di vincere oltre 70 premi del settore. La modalità single player introduce nuovi personaggi e una serie di enigmi ancora più complessi.', 4, 4, 'Valve'),
('God of War', 2018, 'Sony Interactive', 49.99, 'Kratos e suo figlio Atreus affrontano gli dei norreni.', 'Dopo aver compiuto la sua vendetta contro gli dei dell''Olimpo, Kratos vive ora nel regno delle divinità e dei mostri norreni. È in questo mondo spietato e selvaggio che deve combattere per la sopravvivenza e insegnare a suo figlio a fare lo stesso.', 2, 1, 'Santa Monica Studio'),
('Sekiro: Shadows Die Twice', 2019, 'Activision', 59.99, 'Un ninja cerca vendetta nel Giappone del periodo Sengoku.', 'Esplora il Giappone della fine del 1500, in pieno periodo Sengoku: un''epoca brutale, segnata da conflitti costanti. Affronta nemici più grandi della vita stessa in un mondo oscuro e perverso. Scatena un arsenale di protesi letali e abilità ninja mentre mescoli stealth e combattimenti viscerali.', 3, 2, 'FromSoftware'),
('Doom Eternal', 2020, 'Bethesda', 39.99, 'Stermina i demoni sulla Terra in questo FPS frenetico.', 'Le armate dell''inferno hanno invaso la Terra. Diventa lo Slayer in un''epica campagna per giocatore singolo, sconfiggi i demoni attraverso le dimensioni e ferma la distruzione finale dell''umanità. L''unica cosa di cui hanno paura... sei tu.', 2, 1, 'id Software'),
('Subnautica', 2018, 'Unknown Worlds', 29.99, 'Sopravvivenza sottomarina su un pianeta alieno.', 'Sei precipitato su un mondo alieno oceanico e l''unica via è scendere. Gli oceani di Subnautica spaziano da barriere coralline baciate dal sole a pericolose fosse abissali, campi di lava e fiumi sottomarini bio-luminescenti. Gestisci il tuo ossigeno mentre esplori.', 3, 2, 'Unknown Worlds'),
('Outer Wilds', 2019, 'Annapurna Interactive', 22.99, 'Mistero spaziale ambientato in un sistema solare in loop.', 'Vincitore del premio come Miglior Gioco ai BAFTA Games Awards 2020, Outer Wilds è un mistero open world su un sistema solare intrappolato in un loop temporale infinito. Sei il nuovo acquisto della Outer Wilds Ventures, un programma spaziale alla ricerca di risposte.', 4, 3, 'Mobius Digital'),
('Resident Evil Village', 2021, 'Capcom', 39.99, 'Ethan Winters affronta orrori in un villaggio remoto.', 'Vivi l''orrore della sopravvivenza come mai prima d''ora nell''ottavo capitolo principale della serie Resident Evil. Ambientato pochi anni dopo i tragici eventi di Resident Evil 7, la nuova storia vede Ethan Winters in un villaggio innevato pieno di creature terrificanti.', 2, 1, 'Capcom'),
('Disco Elysium', 2019, 'ZA/UM', 39.99, 'RPG investigativo con un sistema di abilità unico.', 'Disco Elysium - The Final Cut è un rivoluzionario gioco di ruolo. Sei un detective con un sistema di abilità unico a tua disposizione e un intero quartiere cittadino da esplorare. Interroga personaggi indimenticabili, risolvi omicidi o accetta mazzette.', 4, 4, 'ZA/UM'),
('Apex Legends', 2019, 'Electronic Arts', 0.00, 'Battle royale a squadre con personaggi unici.', 'Domina con stile in Apex Legends, uno sparatutto Battle Royale gratuito in cui personaggi leggendari con abilità potenti si scontrano.', 3, 2, 'Respawn Entertainment');

-- TAGS
INSERT IGNORE INTO `tag` (`name`) VALUES 
('Adventure'), ('Platformer'), ('Survival'), ('Souls-like'), ('Dark Fantasy'), 
('Strategy'), ('Turn-Based'), ('Metroidvania'), ('Roguelike'), ('Building'), 
('Farming Sim'), ('First-Person'), ('Third-Person'), ('Atmospheric'), ('Story Rich'), 
('Multiplayer'), ('Singleplayer'), ('Horror'), ('Puzzle'), ('Difficult');

-- GAME_TAGS 
INSERT IGNORE INTO `game_tags` (`id_game`, `id_tag`) VALUES 
-- Elden Ring (1)
(1, 1), (1, 2), (1, 3), (1, 9), (1, 10), (1, 17), (1, 20),
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
(8, 17), (8, 19), (8, 20),
-- God of War (9)
(9, 3), (9, 9), (9, 18), (9, 20),
-- Sekiro (10)
(10, 3), (10, 9), (10, 10), (10, 20),
-- Doom Eternal (11)
(11, 3), (11, 4), (11, 17),
-- Subnautica (12)
(12, 1), (12, 9), (12, 11), (12, 17),
-- Outer Wilds (13)
(13, 1), (13, 2), (13, 17), (13, 20),
-- RE Village (14)
(14, 3), (14, 17), (14, 18),
-- Disco Elysium (15)
(15, 1), (15, 14), (15, 18), (15, 20),
-- Apex Legends (16)
(16, 4), (16, 17), (16, 19);

-- USER_GAMES 
INSERT IGNORE INTO `user_games` (`id_user`, `id_game`) VALUES
(1, 1), (1, 3), (1, 2), (1, 4), (1, 5), (1, 6), (1, 7), 
(1, 8), (1, 9), (1, 10), (1, 11), (1, 12), (1, 13), (1, 14), (1, 15), (1, 16);

-- REVIEWS
INSERT IGNORE INTO `reviews` (`id_game`, `id_user`, `score`, `comment`) VALUES
( 1, 1, 9, 'Assolutamente incredibile dopo le patch, grafica mozzafiato!'),
( 2, 2, 10, 'Semplice e infinito. Un classico senza tempo.'),
( 3, 1, 10, 'La migliore storia e il miglior open-world mai creati.');
";

if ($dbConnection->multi_query($sql_script)) {
    $success_message = "SQL script executed successfully.";
    $error_occurred = false;
    do {
        if ($result = $dbConnection->store_result()) {
            $result->free();
        }
        if ($dbConnection->errno) {
            echo "Error executing SQL script: " . $dbConnection->error . "\n";
            $error_occurred = true;
        }
    } while ($dbConnection->more_results() && $dbConnection->next_result());

    if (!$error_occurred) echo $success_message;
} else {
    echo "Error: " . $dbConnection->error;
}

$dbConnection->close();
?>