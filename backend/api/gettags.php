<?php
// Imposta l'intestazione per restituire dati JSON
header('Content-Type: application/json');

// CONFIGURAZIONE E CONNESSIONE DB
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "rigwizard";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    http_response_code(500); // Internal Server Error
    echo json_encode(['errore' => 'Connessione al database fallita: ' . $conn->connect_error]);
    exit();
}


// QUERY SQL PER RECUPERARE TUTTI I TAG

// Selezioniamo sia l'ID (utile per la logica backend) che il nome (utile per il frontend).
$sql = "SELECT id_tag, nome FROM tag ORDER BY nome ASC";

$result = $conn->query($sql);

$tags = [];

if ($result) {
    if ($result->num_rows > 0) {
        // Estrai tutti i tag nell'array
        while($row = $result->fetch_assoc()) {
            $tags[] = $row;
        }
    }
} else {
    // Gestione dell'errore di query
    http_response_code(500);
    echo json_encode(['errore' => 'Errore nell\'esecuzione della query: ' . $conn->error]);
    $conn->close();
    exit();
}

// Chiude la connessione
$conn->close();


// OUTPUT FINALE
// Restituisce l'array di tag in formato JSON
echo json_encode($tags, JSON_PRETTY_PRINT);
?>