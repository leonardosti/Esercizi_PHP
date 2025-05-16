<?php
include 'base/database_connection/db_functions.php';
$database = require 'base/database_connection/database_connection.php';
require 'base/mail.php';

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
    $plico = $_POST['plico'] ?? '';
    if ($plico == '') {
        echo "<script>
        alert('Compila tutti i campi obbligatori');
        history.back();
      </script>";
        exit;
    }

    $ritiro = date('Y-m-d H:i:s');

    try{
        $query = "UPDATE fastroute.plichi p set p.stato = 'consegnato', p.ritiro = :ritiro where p.id = :plico";
        $stmt = $database->prepare($query);
        $stmt->bindParam(':plico', $plico);
        $stmt->bindParam(':ritiro', $ritiro);
        $stmt->execute();
        $mitt = $stmt->fetch();
        // Mail
        $mail = getMailer();
        $mail->addAddress($mitt['email'], $mitt['nome'].' '.$mitt['cognome']);
        $mail->Subject = "Conferma Ritiro Plico #{$plico}";
        $mail->Body    =
            "Gentile {$mitt['nome']} {$mitt['cognome']},\n\n" .
            "Il destinatario ha ritirato il suo plico #{$plico} “in data “ . date('d/m/Y H:i') . “.\n" .
            "Grazie per aver scelto FastRoute.\n\n" .
            "Cordiali saluti,\nFastRoute Team";

        $mail->send();

        echo "<script>alert('Ritiro registrato e mail inviata con successo.');</script>";
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
    <!-- Registrazione spedizione -->
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-lg-8 col-md-10">
                <div class="card shadow-sm border-0 rounded-3">
                    <div class="card-header bg-white border-bottom-0 pt-4 pb-0">
                        <h2 class="card-title fw-bold text-primary">
                            <i class="fas fa-box-open me-2"></i>Registra ritiro
                        </h2>
                        <p class="text-muted">Inserisci i dettagli del ritiro</p>
                    </div>
                    <div class="card-body p-4">
                        <form method="POST" class="needs-validation" novalidate>
                            <!-- Plico -->
                            <div class="col-md-6">
                                <div class="form-floating mb-3">
                                    <select class="form-select" id="plico" name="plico" required>
                                        <option value="" selected disabled>Seleziona un plico</option>
                                        <?= StampaPlichi($database, 'ritiro') ?>
                                    </select>
                                    <label for="plico">Plico</label>
                                    <div class="invalid-feedback">
                                        Seleziona un plico valido.
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 mt-4">
                                <button type="submit" class="btn btn-primary px-4 py-2">
                                    <i class="fas fa-paper-plane me-2"></i>Registra ritiro
                                </button>
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
<?php
