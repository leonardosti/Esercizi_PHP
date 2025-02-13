<?php
global $conn;
$title ="Inserimento";
require "base/header.php";
require_once 'database/db_connection.php';

if($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Registrazione Casa Automobilistica
    if(isset($_POST['registra_casa'])) {
        $nome_casa = sanitizeInput($_POST['nome_casa']);
        $colore_livrea = sanitizeInput($_POST['colore_livrea']);

        $conn->query("INSERT INTO Casa_Automobilistica (nome, colore_livrea) 
                     VALUES ('$nome_casa', '$colore_livrea')");
    }

    // Registrazione Pilota
    if(isset($_POST['registra_pilota'])) {
        $numero = sanitizeInput($_POST['numero']);
        $nome = sanitizeInput($_POST['nome']);
        $cognome = sanitizeInput($_POST['cognome']);
        $nazionalita = sanitizeInput($_POST['nazionalita']);
        $id_casa = sanitizeInput($_POST['id_casa']);

        $conn->query("INSERT INTO Pilota (numero, nome, cognome, nazionalità, id_casa) 
                     VALUES ($numero, '$nome', '$cognome', '$nazionalita', $id_casa)");

        // Inizializza classifica pilota
        $conn->query("INSERT INTO Classifica_Piloti (numero, punti_totali, posizione) 
                     VALUES ($numero, 0, 0)");
    }
}
?>
    <div class="container mt-5 py-4">
        <!-- Form Registrazione Casa -->
        <div class="card bg-black mb-4">
            <div class="card-body">
                <h3 class="text-danger">🏎️ Registra Nuova Casa</h3>
                <form method="POST">
                    <div class="row g-3">
                        <div class="col-md-6">
                            <input type="text" class="form-control" name="nome_casa" placeholder="Nome Casa" required>
                        </div>
                        <div class="col-md-4">
                            <input type="color" class="form-control" name="colore_livrea" required>
                        </div>
                        <div class="col-md-2">
                            <button type="submit" name="registra_casa" class="btn btn-danger w-100">Registra</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <!-- Form Registrazione Pilota -->
        <div class="card bg-black">
            <div class="card-body">
                <h3 class="text-danger">👤 Registra Nuovo Pilota</h3>
                <form method="POST">
                    <div class="row g-3">
                        <div class="col-md-2">
                            <input type="number" class="form-control" name="numero" placeholder="Numero" min="1" required>
                        </div>
                        <div class="col-md-3">
                            <input type="text" class="form-control" name="nome" placeholder="Nome" required>
                        </div>
                        <div class="col-md-3">
                            <input type="text" class="form-control" name="cognome" placeholder="Cognome" required>
                        </div>
                        <div class="col-md-2">
                            <input type="text" class="form-control" name="nazionalita" placeholder="Nazionalità" required>
                        </div>
                        <div class="col-md-3">
                            <select class="form-select" name="id_casa" required>
                                <option value="">Seleziona Casa</option>
                                <?php
                                $case = $conn->query("SELECT id_casa, nome FROM Casa_Automobilistica");
                                while($casa = $case->fetch_assoc()):
                                ?>
                                <option value="<?= $casa['id_casa'] ?>"><?= $casa['nome'] ?></option>
                                <?php endwhile; ?>
                            </select>
                        </div>
                        <div class="col-md-2">
                            <button type="submit" name="registra_pilota" class="btn btn-danger w-100">Registra</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
<?php require "base/footer.php"?>
