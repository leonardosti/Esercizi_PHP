<?php
$host = 'localhost';  // o il tuo host
$dbname = 'libreria'; // nome del database
$username = 'root';   // nome utente del database
$password = '';       // password del database

try {
    $db = new PDO(
        "mysql:host=$host;dbname=$dbname",
        "$username",
        "$password",
        [PDO::ATTR_ERRMODE =>PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE=>PDO::FETCH_OBJ]);
} catch (PDOException $e) {
    echo "Errore di connessione: " . $e->getMessage();
}
?>

