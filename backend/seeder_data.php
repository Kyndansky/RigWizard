<?php
// IMPOSTAZIONI DI CONNESSIONE
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "rigwizard";

// SCRIPT SQL: POPOLAMENTO DATI (DML)
$sql_data = "
USE `rigwizard`;

-- RAM
INSERT INTO `ram` (`marca`, `model_name`, `quantita_gb`, `frequenza_mhz`, `tipo_memoria`, `punteggio`) VALUES
( 'Corsair', 'Vengeance RGB Pro 16GB', 16, 3200, 'DDR4', 8.5),
( 'Kingston', 'Fury Renegade 32GB', 32, 6000, 'DDR5', 9.2),
( 'G.Skill', 'Trident Z RGB 8GB', 8, 3000, 'DDR4', 7.9);

-- PROCESSORE (CPU)
INSERT INTO `processore` (`manufacturer`, `model_name`, `frequenza_ghz`, `core`, `socket_type`, `punteggio`) VALUES
( 'Intel', 'Core i5-13600K', 3.50, 14, 'LGA 1700', 9.0),
( 'AMD', 'Ryzen 5 5600X', 3.70, 6, 'AM4', 8.2),
( 'Intel', 'Core i9-14900K', 3.20, 24, 'LGA 1700', 9.8);

-- SCHEDA VIDEO (GPU)
INSERT INTO `scheda_video` (`manufacturer`, `model_name`, `vram_gb`, `punteggio`) VALUES
( 'NVIDIA', 'GeForce RTX 4070 Ti', 12, 9.1),
( 'AMD', 'Radeon RX 6600 XT', 8, 7.8),
( 'NVIDIA', 'GeForce GTX 1060', 6, 6.5);

-- MOTHERBOARD
INSERT INTO `motherboard` (`manufacturer`, `model_name`, `chipset`, `socket_type`, `punteggio`) VALUES
( 'Gigabyte', 'Z790 AORUS ELITE AX', 'Z790', 'LGA 1700', 8.9),
( 'ASUS', 'ROG STRIX B550-F GAMING', 'B550', 'AM4', 8.1),
( 'MSI', 'PRO B760-P WIFI', 'B760', 'LGA 1700', 7.5);

-- PC (CONFIGURAZIONI)
INSERT INTO `pc` (`nome_configurazione`, `id_ram`, `id_motherboard`, `id_cpu`, `id_gpu`) VALUES
( 'Gaming High-End (2025)', 2, 1, 3, 1),    -- ID 1
( 'Gaming Mid-Range (2024)', 1, 1, 1, 1),   -- ID 2
( 'Budget Gaming (Legacy)', 3, 2, 2, 3),    -- ID 3
( 'PC Minimo Standard', 3, 3, 2, 3);        -- ID 4

-- USERS
INSERT INTO `users` (`username`, `email`, `password_hash`, `id_pc_principale`) VALUES
( 'Gamer_Pro77', 'pro.gamer@example.com', 'placeholder_hash_1', 1),
( 'BetaTester01', 'beta.test@example.com', 'placeholder_hash_2', 2),
( 'Utente_Senza_PC', 'no.pc@example.com', 'placeholder_hash_3', NULL);

-- GIOCHI (usiamo PC ID 2, 1, 4, 3)
INSERT INTO `giochi` (`titolo`, `anno_uscita`, `publisher`, `prezzo`, `descrizione`, `id_pc_minimo`, `id_pc_consigliato`, `creatore`) VALUES
( 'Cyberpunk 2077', 2020, 'CD Projekt', 59.99, 'Un RPG open-world d\'azione-avventura ambientato a Night City.', 2, 1, 'CD Projekt Red'),
( 'Terraria', 2011, 'Re-Logic', 9.99, 'Un sandbox 2D con esplorazione e combattimento.', 4, 4, 'Re-Logic'),
( 'Red Dead Redemption 2', 2018, 'Rockstar Games', 49.99, 'Un epico open-world ambientato nell\'America della fine del 1800.', 3, 2, 'Rockstar Games');

-- TAG
INSERT INTO `tag` (`nome`) VALUES
( 'RPG'),
( 'Open World'),
( 'Azione'),
( 'Sparatutto'),
( 'Indie'),
( 'Sandbox'),
( 'Western'),
( 'Sci-Fi');

-- TAG_GIOCHI (COLLEGAMENTI)
INSERT INTO `tag_giochi` (`id_gioco`, `id_tag`) VALUES 
(1, 1), (1, 2), (1, 3), (1, 4), (1, 8), -- Cyberpunk 2077
(2, 5), (2, 6),                         -- Terraria
(3, 2), (3, 3), (3, 7);                 -- Red Dead Redemption 2

-- RECENSIONI (User ID 1 e 2)
INSERT INTO `recensioni` (`id_gioco`, `id_user`, `punteggio`, `commento`) VALUES
( 1, 1, 9, 'Assolutamente incredibile dopo le patch, grafica mozzafiato!'),
( 2, 2, 10, 'Semplice e infinito. Un classico senza tempo.'),
( 3, 1, 10, 'La migliore storia e il miglior open-world mai creati.');
";


// Ci connettiamo direttamente al DB appena creato
$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("<h1> Connessione fallita:</h1><p>Assicurati di aver eseguito prima **setup_db.php** per creare il database '$dbname'.</p>Errore: " . $conn->connect_error);
}

if ($conn->multi_query($sql_data) === TRUE) {
    echo "<h1> Popolamento (Seeder) del Database '$dbname' completato con successo!</h1>";
    echo "I dati di esempio sono stati inseriti nelle tabelle.";
} else {
    echo "<h1> Errore durante il popolamento dei dati: " . $conn->error . "</h1>";
    echo "<p>Controlla che gli ID delle Chiavi Esterne (Foreign Keys) siano validi, e che il database non sia vuoto.</p>";
}

$conn->close();
?>