<?php
global $conn;
$title ="Statistiche";
require "base/header.php";
require_once 'database/db_connection.php';


$id_gara = isset($_GET['id']) ? $_GET['id'] : 1;

$gara = $conn->query("
    SELECT circuito, data, n_giri 
    FROM Gara 
    WHERE id_gara = $id_gara
")->fetch_assoc();

$risultati = $conn->query("
    SELECT r.posizione_finale, p.nome, p.cognome, r.miglior_giro, r.tempo_totale 
    FROM Risultato r
    JOIN Pilota p ON r.numero = p.numero
    WHERE r.id_gara = $id_gara
    ORDER BY r.posizione_finale
");

$tempo_piu_veloce = $conn->query("
    SELECT MIN(miglior_giro) AS tempo 
    FROM Risultato 
    WHERE id_gara = $id_gara
")->fetch_assoc();
?>

    <!DOCTYPE html>
    <html lang="it">
    <head>
        <!-- Intestazione identica alla home page -->
    </head>
    <body class="bg-dark text-light">
    <div class="container mt-5">
        <div class="card bg-black">
            <div class="card-body">
                <h3 class="text-danger mb-4">🏁 <?= $gara['circuito'] ?> - <?= $gara['data'] ?></h3>

                <!-- Tempo più Veloce -->
                <div class="alert alert-warning">
                    ⏱️ Tempo più veloce in gara: <?= $tempo_piu_veloce['tempo'] ?>
                </div>

                <!-- Tabella Risultati -->
                <table class="table table-dark">
                    <thead>
                    <tr>
                        <th>Pos</th>
                        <th>Pilota</th>
                        <th>Tempo Totale</th>
                        <th>Miglior Giro</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php while($row = $risultati->fetch_assoc()): ?>
                        <tr>
                            <td><?= $row['posizione_finale'] ?></td>
                            <td><?= $row['nome'] ?> <?= $row['cognome'] ?></td>
                            <td><?= $row['tempo_totale'] ?></td>
                            <td><?= $row['miglior_giro'] ?></td>
                        </tr>
                    <?php endwhile; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    </body>
    </html>
<?php require "base/footer.php"?>