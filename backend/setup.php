<?php

// Impostazioni di Connessione al Database XAMPP
$servername = "localhost";
$username = "root"; // L'utente di default di XAMPP/MySQL
$password = "";     // La password di default è vuota
$dbname = "rigwizard"; // Il database che vogliamo creare/gestire

// Contenuto dello script SQL completo
$sql_script = "
-- 1. Setup Iniziale
DROP DATABASE IF EXISTS `rigwizard`;
CREATE DATABASE `rigwizard`
    DEFAULT CHARACTER SET utf8mb4
    DEFAULT COLLATE utf8mb4_general_ci;
USE `rigwizard`;

-- 2. Tabelle Componenti Hardware

-- motherboard
CREATE TABLE `motherboard` (
    `id` INT(11) NOT NULL AUTO_INCREMENT,
    `manufacturer` VARCHAR(100) NOT NULL,
    `model_name` VARCHAR(100) NOT NULL UNIQUE,
    `chipset` VARCHAR(50),
    `socket_type` VARCHAR(50),
    `punteggio` DECIMAL(3, 1) DEFAULT 0.0,
    PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- ram (memoria)
CREATE TABLE `ram` (
    `id` INT(11) NOT NULL AUTO_INCREMENT,
    `marca` VARCHAR(100) NOT NULL,
    `model_name` VARCHAR(100) NOT NULL UNIQUE,
    `quantita_gb` INT(11) NOT NULL,
    `frequenza_mhz` INT(11) NOT NULL,
    `tipo_memoria` VARCHAR(10) NOT NULL,
    `punteggio` DECIMAL(3, 1) DEFAULT 0.0,
    PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- processore (cpu)
CREATE TABLE `processore` (
    `id` INT(11) NOT NULL AUTO_INCREMENT,
    `manufacturer` VARCHAR(100) NOT NULL,
    `model_name` VARCHAR(100) NOT NULL UNIQUE,
    `frequenza_ghz` DECIMAL(3, 2) NOT NULL,
    `core` INT(11) NOT NULL,
    `socket_type` VARCHAR(50),
    `punteggio` DECIMAL(3, 1) DEFAULT 0.0,
    PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- scheda video (gpu)
CREATE TABLE `scheda_video` (
    `id` INT(11) NOT NULL AUTO_INCREMENT,
    `manufacturer` VARCHAR(100) NOT NULL,
    `model_name` VARCHAR(100) NOT NULL UNIQUE,
    `vram_gb` INT(11),
    `punteggio` DECIMAL(3, 1) DEFAULT 0.0,
    PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- 3. Tabella PC (Configurazione Hardware)
-- Collega i singoli componenti hardware

CREATE TABLE `pc` (
    `id` INT(11) NOT NULL AUTO_INCREMENT,
    `nome_configurazione` VARCHAR(150),
    `id_ram` INT(11) NOT NULL,
    `id_motherboard` INT(11) NOT NULL,
    `id_cpu` INT(11) NOT NULL,
    `id_gpu` INT(11) NOT NULL,
    PRIMARY KEY (`id`),
    FOREIGN KEY (`id_ram`) REFERENCES `ram`(`id`) ON DELETE RESTRICT ON UPDATE CASCADE,
    FOREIGN KEY (`id_motherboard`) REFERENCES `motherboard`(`id`) ON DELETE RESTRICT ON UPDATE CASCADE,
    FOREIGN KEY (`id_cpu`) REFERENCES `processore`(`id`) ON DELETE RESTRICT ON UPDATE CASCADE,
    FOREIGN KEY (`id_gpu`) REFERENCES `scheda_video`(`id`) ON DELETE RESTRICT ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- 4. Tabella Utenti

CREATE TABLE `users` (
    `id` INT(11) NOT NULL AUTO_INCREMENT,
    `username` VARCHAR(50) NOT NULL UNIQUE,
    `email` VARCHAR(150) NOT NULL UNIQUE,
    `password_hash` VARCHAR(255) NOT NULL,
    `id_pc_principale` INT(11) DEFAULT NULL,
    `data_registrazione` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (`id`),
    FOREIGN KEY (`id_pc_principale`) REFERENCES `pc`(`id`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- 5. Tabelle Giochi e Relazioni

-- giochi
CREATE TABLE `giochi` (
    `id_gioco` INT(11) NOT NULL AUTO_INCREMENT,
    `titolo` VARCHAR(255) NOT NULL,
    `anno_uscita` YEAR(4) NOT NULL,
    `publisher` VARCHAR(150),
    `prezzo` DECIMAL(6, 2) DEFAULT 0.00,
    `descrizione` TEXT,
    `id_pc_minimo` INT(11),
    `id_pc_consigliato` INT(11),
    `creatore` VARCHAR(150),
    PRIMARY KEY (`id_gioco`),
    FOREIGN KEY (`id_pc_minimo`) REFERENCES `pc`(`id`) ON DELETE SET NULL ON UPDATE CASCADE,
    FOREIGN KEY (`id_pc_consigliato`) REFERENCES `pc`(`id`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- recensioni
CREATE TABLE `recensioni` (
    `id` INT(11) NOT NULL AUTO_INCREMENT,
    `id_gioco` INT(11) NOT NULL,
    `id_user` INT(11) NOT NULL,
    `punteggio` TINYINT(1) CHECK (`punteggio` BETWEEN 1 AND 10),
    `commento` TEXT,
    `data_recensione` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (`id`),
    UNIQUE KEY `unique_recensione` (`id_gioco`, `id_user`),
    FOREIGN KEY (`id_gioco`) REFERENCES `giochi`(`id_gioco`) ON DELETE CASCADE ON UPDATE CASCADE,
    FOREIGN KEY (`id_user`) REFERENCES `users`(`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- tag
CREATE TABLE `tag` (
    `id_tag` INT(11) NOT NULL AUTO_INCREMENT,
    `nome` VARCHAR(50) NOT NULL UNIQUE,
    PRIMARY KEY (`id_tag`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- tag_giochi (Tabella ponte Many-to-Many tra giochi e tag)
CREATE TABLE `tag_giochi` (
    `id_gioco` INT(11) NOT NULL,
    `id_tag` INT(11) NOT NULL,
    PRIMARY KEY (`id_gioco`, `id_tag`),
    FOREIGN KEY (`id_gioco`) REFERENCES `giochi`(`id_gioco`) ON DELETE CASCADE ON UPDATE CASCADE,
    FOREIGN KEY (`id_tag`) REFERENCES `tag`(`id_tag`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
";

// 1. Crea la connessione al server MySQL (senza specificare il DB)
$conn = new mysqli($servername, $username, $password);

// Verifica la connessione
if ($conn->connect_error) {
    die("<h1> Connessione fallita: " . $conn->connect_error . "</h1>");
}

// 2. Esegue lo script SQL
// NOTA: mysqli::multi_query() è usato perché ci sono più istruzioni SQL separate da ';'.
if ($conn->multi_query($sql_script) === TRUE) {
    echo "<h1>Setup del Database '$dbname' completato con successo!</h1>";
    echo "Tutte le tabelle e le relazioni sono state create.";
} else {
    echo "<h1>Errore durante il setup del database: " . $conn->error . "</h1>";
    echo "<p>Controlla che MySQL sia attivo in XAMPP.</p>";
}

$conn->close();
