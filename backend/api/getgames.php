<?php

// GESTIONE INPUT DAL FRONTEND (RICHIESTA JSON)

header('Content-Type: application/json'); // Assicura che la risposta sia JSON

$json_data = file_get_contents("php://input");
$data = json_decode($json_data, true);

// Estrazione e Validazione dei Parametri
$giochi_per_pagina = isset($data['giochi_per_pagina']) ? (int)$data['giochi_per_pagina'] : 10;
$pagina_corrente = isset($data['pagina_corrente']) ? (int)$data['pagina_corrente'] : 1;

// Assicuriamoci che i valori siano positivi e validi
if ($giochi_per_pagina < 1 || $pagina_corrente < 1) {
    http_response_code(400); // Bad Request
    echo json_encode(['errore' => 'I parametri di paginazione devono essere numeri positivi.']);
    exit();
}

// Calcolo dell'OFFSET
$offset = ($pagina_corrente - 1) * $giochi_per_pagina;



// CONFIGURAZIONE E CONNESSIONE DB

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "rigwizard";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    // Risposta di errore JSON in caso di fallimento della connessione
    http_response_code(500); // Internal Server Error
    echo json_encode(['errore' => 'Connessione al database fallita: ' . $conn->connect_error]);
    exit();
}



//  Recupera i Giochi Impaginati

// Prende l'ID, Titolo e Descrizione del set di giochi desiderato.
$sql_giochi = "SELECT id_gioco, titolo, descrizione FROM giochi ORDER BY titolo ASC LIMIT ? OFFSET ?";
$stmt_giochi = $conn->prepare($sql_giochi);
$stmt_giochi->bind_param("ii", $giochi_per_pagina, $offset);
$stmt_giochi->execute();
$result_giochi = $stmt_giochi->get_result();

$lista_giochi = [];
$game_ids = []; // Array per memorizzare gli ID dei giochi recuperati

while($row = $result_giochi->fetch_assoc()) {
    $game_id = $row['id_gioco'];
    $lista_giochi[$game_id] = [
        'id' => $game_id,
        'titolo' => $row['titolo'],
        'descrizione' => $row['descrizione'],
        'tags' => [] // Array vuoto dove inseriremo i tag
    ];
    $game_ids[] = $game_id;
}
$stmt_giochi->close();

//  Recupera TUTTI i Tag per QUEI Giochi
if (!empty($game_ids)) {
    // Creiamo una lista di placeholder '?, ?, ?...' per gli ID dei giochi
    $placeholders = implode(',', array_fill(0, count($game_ids), '?'));
    $types = str_repeat('i', count($game_ids)); // Tipi di dati tutti interi 'i'

    // Query per unire i tag ai giochi specifici
    $sql_tags = "
        SELECT 
            tg.id_gioco, 
            t.nome AS nome_tag
        FROM tag_giochi tg
        JOIN tag t ON tg.id_tag = t.id_tag
        WHERE tg.id_gioco IN ($placeholders)
        ORDER BY t.nome ASC
    ";

    $stmt_tags = $conn->prepare($sql_tags);
    $stmt_tags->bind_param($types, ...$game_ids);
    $stmt_tags->execute();
    $result_tags = $stmt_tags->get_result();

    // Mappa i Tag nell'Oggetto Risultante
    while($tag_row = $result_tags->fetch_assoc()) {
        $id_gioco = $tag_row['id_gioco'];
        
        if (isset($lista_giochi[$id_gioco])) {
            $lista_giochi[$id_gioco]['tags'][] = $tag_row['nome_tag'];
        }
    }
    $stmt_tags->close();
}

// Chiude la connessione
$conn->close();


// OUTPUT FINALE


// Converte l'array associativo (che usa gli ID come chiave) in un array sequenziale per l'output finale
$output_array = array_values($lista_giochi);

echo json_encode($output_array, JSON_PRETTY_PRINT);
?>