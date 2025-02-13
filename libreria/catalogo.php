<?php
global $db;
$title = "Libreria - Catalogo";
require 'base/header.php';
require 'database/db_connection.php'
?>
<div class="container my-5">
    <h2 class="text-center">Catalogo Libri</h2>
    <table class="table table-striped mt-4">
        <thead class="table-dark">
        <tr>
            <th>Titolo</th>
            <th>Autore</th>
            <th>Genere</th>
            <th>Prezzo (€)</th>
            <th>Anno di Pubblicazione</th>
        </tr>
        </thead>
        <tbody>
        <?php
        $query = 'SELECT * FROM libreria.libro';
        try {
            $stm = $db->prepare($query);
            $stm->execute();
            while ($libro = $stm->fetch(PDO::FETCH_ASSOC)) {
                echo "<tr>";
                echo "<td>" . htmlspecialchars($libro['titolo']) . "</td>";
                echo "<td>" . htmlspecialchars($libro['autore']) . "</td>";
                echo "<td>" . htmlspecialchars($libro['genere']) . "</td>";
                echo "<td> €" . htmlspecialchars($libro['prezzo']) . "</td>";
                echo "<td>" . htmlspecialchars($libro['anno_pubblicazione']) . "</td>";
                echo "</tr>";
            }
            $stm->closeCursor();
        } catch (Exception $e) {
            echo "<tr><td colspan='5'>Errore nel caricamento del database</td></tr>";
        }
        ?>
        </tbody>
    </table>
</div>

<?php require 'base/footer.php'; ?>
