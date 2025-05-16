<?php
include 'base/database_connection/db_functions.php';
$database = require 'base/database_connection/database_connection.php';

session_start();
date_default_timezone_set('Europe/Rome');

if(!isset($_SESSION["user_id"])){
    echo "<script>
            alert('Devi prima accedere per usare questa pagina');
            window.location.href = 'login.php';
          </script>";
    exit;
}else if($_SESSION["ruolo"] != "personale"){
    echo "<script>
            alert('Spiacenti ma non puoi accedere a questa pagina');
            window.location.href = 'index.php';
          </script>";
    exit;
}

if($_SERVER['REQUEST_METHOD'] === "POST")
{
    $campi = ['mittente', 'destinatario', 'sede_partenza', 'sede_arrivo'];
    foreach ($campi as $campo) {
        if (empty($_POST[$campo])) {
            echo "<script>
        alert('Compila tutti i campi obbligatori');
        history.back();
      </script>";
            exit;
        }
    }
    $consegna = date('Y-m-d H:i:s');
    $stato = "in_partenza";
    $mittente = $_POST['mittente'] ?? '';
    $destinatario = $_POST['destinatario'] ?? '';
    $sede_partenza = $_POST['sede_partenza'] ?? '';
    $sede_arrivo = $_POST['sede_arrivo'] ?? '';
    try{
        $query = "INSERT INTO fastroute.plichi(consegna, stato, mittente, destinatario, sede_partenza, sede_arrivo) VALUES 
                    (:consegna, :stato, :mittente, :destinatario, :sede_partenza, :sede_arrivo)";
        $stmt = $database->prepare($query);
        $stmt->bindParam(':consegna', $consegna);
        $stmt->bindParam(':stato', $stato);
        $stmt->bindParam(':mittente', $mittente);
        $stmt->bindParam(':destinatario', $destinatario);
        $stmt->bindParam(':sede_partenza', $sede_partenza);
        $stmt->bindParam(':sede_arrivo', $sede_arrivo);
        $stmt->execute();
        if ($stmt->rowCount() > 0) {
            echo "<script>alert('Operazione terminata con successo!')</script>";
            try{
                $query = "UPDATE fastroute.clienti c SET c.punti_fedelta = (c.punti_fedelta + 1) WHERE c.id = :mittente";
                $stmt = $database->prepare($query);
                $stmt->bindParam(':mittente', $mittente);
                $stmt->execute();
            }catch(PDOException $e){
                echo "<script>alert('" . addslashes($e->getMessage()) . "');</script>";
            }
        }
    }catch(PDOException $e){
        // error message
        echo "<script>alert('" . addslashes($e->getMessage()) . "');</script>";
    }
}
?>
<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FastRoute - Corriere Espresso</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <link href="style/style.css" rel="stylesheet">
</head>
<body class="d-flex flex-column min-vh-100">
<?php include 'base/header.php' ?>
<!-- Registrazione consegna -->
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-8 col-md-10">
            <div class="card shadow-sm border-0 rounded-3">
                <div class="card-header bg-white border-bottom-0 pt-4 pb-0">
                    <h2 class="card-title fw-bold text-primary">
                        <i class="fas fa-box-open me-2"></i>Registra nuova consegna
                    </h2>
                    <p class="text-muted">Inserisci i dettagli della consegna</p>
                </div>
                <div class="card-body p-4">
                    <form method="POST" class="needs-validation" novalidate>
                        <div class="row g-3">
                            <!-- Mittente -->
                            <div class="col-md-6">
                                <div class="form-floating mb-3">
                                    <select class="form-select" id="mittente" name="mittente" required>
                                        <option value="" selected disabled>Seleziona un mittente</option>
                                        <?= StampaClienti($database) ?>
                                    </select>
                                    <label for="mittente">Mittente</label>
                                    <div class="invalid-feedback">
                                        Seleziona un mittente valido.
                                    </div>
                                </div>
                            </div>

                            <!-- Destinatario -->
                            <div class="col-md-6">
                                <div class="form-floating mb-3">
                                    <select class="form-select" id="destinatario" name="destinatario" required>
                                        <option value="" selected disabled>Seleziona un destinatario</option>
                                        <?= StampaClienti($database) ?>
                                    </select>
                                    <label for="destinatario">Destinatario</label>
                                    <div class="invalid-feedback">
                                        Seleziona un destinatario valido.
                                    </div>
                                </div>
                            </div>

                            <!-- Sede partenza -->
                            <div class="col-md-6">
                                <div class="form-floating mb-3">
                                    <select class="form-select" id="sede_partenza" name="sede_partenza" required>
                                        <option value="" selected disabled>Seleziona la sede di partenza</option>
                                        <?= StampaSedi($database) ?>
                                    </select>
                                    <label for="sede_partenza">Sede di partenza</label>
                                    <div class="invalid-feedback">
                                        Seleziona una sede di partenza valida.
                                    </div>
                                </div>
                            </div>

                            <!-- Sede arrivo -->
                            <div class="col-md-6">
                                <div class="form-floating mb-3">
                                    <select class="form-select" id="sede_arrivo" name="sede_arrivo" required>
                                        <option value="" selected disabled>Seleziona la sede di arrivo</option>
                                        <?= StampaSedi($database) ?>
                                    </select>
                                    <label for="sede_arrivo">Sede di arrivo</label>
                                    <div class="invalid-feedback">
                                        Seleziona una sede di arrivo valida.
                                    </div>
                                </div>
                            </div>

                            <!-- Submit Button -->
                            <div class="col-12 mt-4">
                                <button type="submit" class="btn btn-primary px-4 py-2">
                                    <i class="fas fa-paper-plane me-2"></i>Registra consegna
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<?php include 'base/footer.php' ?>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>
<script src="script/script.js"></script>
</body>
</html>
