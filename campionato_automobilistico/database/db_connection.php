<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "Campionato_Automobilistico";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connessione fallita: " . $conn->connect_error);
}
$conn->set_charset("utf8mb4");
?>
