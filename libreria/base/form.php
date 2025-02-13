<?php
$title = "Libreria - Aggiungi";
require 'base/header.php';
?>

<?php
if (isset($success) && $success) {
    echo '<div class="container my-5">';
    echo '<h2 class="text-center">Libro aggiunto con successo!</h2>';
    echo '<div class="text-center">';
    echo '<a href="inserisci.php" class="btn btn-primary my-3">Aggiungi un altro libro</a>';
    echo '<a href="index.php" class="btn btn-secondary my-3">Torna alla Home</a>';
    echo '</div>';
    echo '</div>';
} else {
?>
<!-- From -->
<div class="container my-5">
    <h2 class="text-center">Aggiungi un Nuovo Libro</h2>
    <form class="mt-4" action="database/db_inserisci.php" method="POST">
        <div class="mb-3">
            <label class="form-label">Titolo</label>
            <input type="text" class="form-control" name="titolo" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Autore</label>
            <input type="text" class="form-control" name="autore" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Genere</label>
            <select class="form-select" name="genere">
                <option>Romanzo</option>
                <option>Saggio</option>
                <option>Fantascienza</option>
                <option>Giallo</option>
            </select>
        </div>
        <div class="mb-3">
            <label class="form-label">Prezzo (€)</label>
            <input type="number" class="form-control" name="prezzo" step="0.01" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Anno di Pubblicazione</label>
            <input type="date" class="form-control" name="anno" required>
        </div>
        <button type="submit" class="btn my-3 text-white bg-dark">Aggiungi Libro</button>
    </form>
</div>
    <?php
}
?>