<?php
// Imposta l'intestazione per restituire dati JSON
header('Content-Type: application/json');

// GESTIONE INPUT DAL FRONTEND (RICHIESTA JSON)
$json_data = file_get_contents("php://input");
$data = json_decode($json_data, true);

// Estrazione dei Parametri
$username = isset($data['username']) ? trim($data['username']) : null;
$current_password = isset($data['current_password']) ? $data['current_password'] : null;
$new_password = isset($data['new_password']) ? $data['new_password'] : null;

// Validazione base
if (empty($username) || empty($current_password) || empty($new_password)) {
    http_response_code(400);
    echo json_encode(['successo' => false, 'messaggio' => 'Tutti i campi (username, password corrente e nuova password) sono obbligatori.']);
    exit();
}


// CONFIGURAZIONE E CONNESSIONE DB
$servername = "localhost";
$username_db = "root";
$password_db = "";
$dbname = "rigwizard";

$conn = new mysqli($servername, $username_db, $password_db, $dbname);
if ($conn->connect_error) {
    http_response_code(500);
    echo json_encode(['successo' => false, 'messaggio' => 'Connessione al database fallita.']);
    exit();
}

// RECUPERO E VERIFICA PASSWORD CORRENTE

// Prepara la query per recuperare l'hash della password basato sull'username
$sql_select = "SELECT password_hash FROM users WHERE username = ?";
$stmt_select = $conn->prepare($sql_select);

if (!$stmt_select) {
    http_response_code(500);
    echo json_encode(['successo' => false, 'messaggio' => 'Errore nella preparazione della query di verifica.']);
    $conn->close();
    exit();
}

$stmt_select->bind_param("s", $username);
$stmt_select->execute();
$result = $stmt_select->get_result();

if ($result->num_rows === 0) {
    http_response_code(401);
    echo json_encode(['successo' => false, 'messaggio' => 'Utente non trovato.']);
    $stmt_select->close();
    $conn->close();
    exit();
}

$user = $result->fetch_assoc();
$stored_hash = $user['password_hash'];
$stmt_select->close();

// Verifica se la password corrente fornita è corretta
if (!password_verify($current_password, $stored_hash)) {
    http_response_code(401);
    echo json_encode(['successo' => false, 'messaggio' => 'Password corrente non corretta.']);
    $conn->close();
    exit();
}

// AGGIORNAMENTO DELLA PASSWORD

// ⚠️ Genera un NUOVO hash sicuro per la nuova password ⚠️
$new_password_hash = password_hash($new_password, PASSWORD_DEFAULT);

// Prepara la query per aggiornare l'hash della password
$sql_update = "UPDATE users SET password_hash = ? WHERE username = ?";
$stmt_update = $conn->prepare($sql_update);

if (!$stmt_update) {
    http_response_code(500);
    echo json_encode(['successo' => false, 'messaggio' => 'Errore nella preparazione della query di aggiornamento.']);
    $conn->close();
    exit();
}

// "ss": entrambi i parametri (il nuovo hash e l'username) sono stringhe
$stmt_update->bind_param("ss", $new_password_hash, $username);

if ($stmt_update->execute()) {
    http_response_code(200);
    echo json_encode(['successo' => true, 'messaggio' => 'Password aggiornata con successo.']);
} else {
    http_response_code(500);
    echo json_encode(['successo' => false, 'messaggio' => 'Errore durante l\'aggiornamento nel database: ' . $stmt_update->error]);
}

$stmt_update->close();
$conn->close();
?>