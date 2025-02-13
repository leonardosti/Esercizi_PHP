<?php
global $conn;
$title ="Classifiche";
require "base/header.php";
require_once 'database/db_connection.php';

function aggiornaClassifiche($conn) {
    // Aggiorna posizioni piloti
    $conn->query("SET @rank=0;
                 UPDATE Classifica_Piloti 
                 SET posizione = (@rank:=@rank+1) 
                 ORDER BY punti_totali DESC");

    // Aggiorna posizioni squadre
    $conn->query("SET @rank=0;
                 UPDATE Classifica_Squadre 
                 SET posizione = (@rank:=@rank+1) 
                 ORDER BY punti_totali DESC");

    // Aggiorna punti squadre
    $conn->query("UPDATE Classifica_Squadre cs
                 JOIN (
                     SELECT p.id_casa, SUM(cp.punti_totali) AS punti
                     FROM Classifica_Piloti cp
                     JOIN Pilota p ON cp.numero = p.numero
                     GROUP BY p.id_casa
                 ) AS temp ON cs.id_casa = temp.id_casa
                 SET cs.punti_totali = temp.punti");
}
?>
    <div class="container mt-5 py-4">
        <!-- Sezione Classifica Piloti -->
        <div class="card bg-black mb-4">
            <div class="card-body">
                <h3 class="text-danger">🏆 Classifica Piloti</h3>
                <table class="table table-dark">
                    <thead>
                    <tr>
                        <th>Pos</th>
                        <th>Pilota</th>
                        <th>Squadra</th>
                        <th>Punti</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    $result = $conn->query("
                            SELECT cp.posizione, p.nome, p.cognome, ca.nome AS squadra, cp.punti_totali 
                            FROM Classifica_Piloti cp
                            JOIN Pilota p ON cp.numero = p.numero
                            JOIN Casa_Automobilistica ca ON p.id_casa = ca.id_casa
                            ORDER BY cp.posizione
                        ");

                    while($row = $result->fetch_assoc()):
                        ?>
                        <tr>
                            <td><?= $row['posizione'] ?></td>
                            <td><?= $row['nome'] ?> <?= $row['cognome'] ?></td>
                            <td><?= $row['squadra'] ?></td>
                            <td><?= $row['punti_totali'] ?></td>
                        </tr>
                    <?php endwhile; ?>
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Sezione Classifica Squadre -->
        <div class="card bg-black">
            <div class="card-body">
                <h3 class="text-danger">🏁 Classifica Squadre</h3>
                <table class="table table-dark">
                    <thead>
                    <tr>
                        <th>Pos</th>
                        <th>Squadra</th>
                        <th>Punti</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    $result = $conn->query("
                            SELECT cs.posizione, ca.nome, cs.punti_totali 
                            FROM Classifica_Squadre cs
                            JOIN Casa_Automobilistica ca ON cs.id_casa = ca.id_casa
                            ORDER BY cs.posizione
                        ");

                    while($row = $result->fetch_assoc()):
                        ?>
                        <tr>
                            <td><?= $row['posizione'] ?></td>
                            <td><?= $row['nome'] ?></td>
                            <td><?= $row['punti_totali'] ?></td>
                        </tr>
                    <?php endwhile; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
<?php require "base/footer.php"?>