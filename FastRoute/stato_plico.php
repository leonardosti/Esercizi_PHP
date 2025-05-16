<?php
include "base/database_connection/db_functions.php";
$database = require 'base/database_connection/database_connection.php';
session_start();

$consegna = null;
$spedizione = null;
$ritiro = null;
$stato = null;
$plico = '';

if($_SERVER['REQUEST_METHOD'] == 'POST' && !empty($_POST['codice_plico'])){
    $plico = trim($_POST['codice_plico']);

    try{
        $cliente = $_SESSION['ruolo'] === 'cliente' ? "AND (p.mittente = :uid OR p.destinatario = :uid)" : "";

        $query = "SELECT p.consegna, p.spedizione, p.ritiro, p.stato from fastroute.plichi p 
                    where p.id = :id $cliente";
        $stmt = $database->prepare($query);
        $stmt->bindParam(':id', $plico);
        if ($_SESSION['ruolo'] === 'cliente') {
            $stmt->bindValue(':uid', $_SESSION['user_id']);
        }
        $stmt->execute();
        if ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $consegna = $row['consegna'];
            $spedizione = $row['spedizione'];
            $ritiro = $row['ritiro'];
            $stato = $row['stato'];
        } else {
            $errore = "Nessun plico trovato con codice $plico.";
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
<?php include 'base/header.php'?>

<!-- Header -->
<div class="align-items-center m-4">
    <div class="col-lg-6">
        <h1 class="fw-bold text-primary mb-2">Verifica stato plico</h1>
        <p class="text-muted mb-0">Inserisci il codice del tuo plico per conoscere in tempo reale lo stato della spedizione, dalla consegna presso la sede di partenza fino al ritiro da parte del destinatario.</p>
    </div>
</div>

<section class="py-5">
    <div class="container mb-5">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="card border-0 shadow-sm">
                    <div class="card-header bg-primary text-white py-3">
                        <h2 class="h4 mb-0 text-center fw-bold"><i class="fas fa-search me-2"></i>Traccia il tuo plico</h2>
                    </div>
                    <div class="card-body p-4">
                        <form action="" method="POST">
                            <div class="mb-4">
                                <label for="codice_plico" class="form-label fw-bold">Codice del plico</label>
                                <div class="input-group">
                                    <span class="input-group-text bg-white border-end-0">
                                        <i class="fas fa-barcode text-primary"></i>
                                    </span>
                                    <input type="text" class="form-control border-start-0" name="codice_plico" placeholder="Inserisci il codice per il tracciamento" required>
                                </div>
                                <div class="form-text">Inserisci il codice del tuo plico</div>
                            </div>
                            <div class="d-grid">
                                <button type="submit" class="btn btn-primary py-2">
                                    <i class="fas fa-search me-2"></i>Traccia spedizione
                                </button>
                            </div>
                        </form>
                    </div>
                </div>

                <!-- Risultato -->
                <?php if (!empty($errore)): ?>
                    <div class="alert alert-danger"><?= $errore ?></div>
                <?php elseif ($stato): ?>
                    <div class="card shadow-sm">
                        <div class="card-body">
                            <h5>Plico #<?= $plico ?> – Stato: <?= $stato ?></h5>
                            <div class="container m-5 row">
                                <div class="col-md-4">
                                    <div class="tracking-icon bg-primary text-white rounded-circle d-flex align-items-center justify-content-center mb-2" style="width: 40px; height: 40px;">
                                        <i class="fas fa-box"></i>
                                    </div>
                                    <div class="tracking-details">
                                        <h4 class="h6 mb-1">In partenza</h4>
                                        <p class="small text-muted mb-0">
                                            <?= !empty($consegna) ? $consegna : 'In attesa'?>
                                        </p>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="tracking-icon bg-primary text-white rounded-circle d-flex align-items-center justify-content-center mb-2" style="width: 40px; height: 40px;">
                                        <i class="fas fa-shipping-fast"></i>
                                    </div>
                                    <div class="tracking-details">
                                        <h4 class="h6 mb-1">In transito</h4>
                                        <p class="small text-muted mb-0">
                                            <?= !empty($spedizione) ? $spedizione : 'In attesa'?>
                                        </p>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="tracking-icon bg-primary text-white rounded-circle d-flex align-items-center justify-content-center mb-2" style="width: 40px; height: 40px;">
                                        <i class="fas fa-check"></i>
                                    </div>
                                    <div class="tracking-details">
                                        <h4 class="h6 mb-1 text-muted">Consegnato</h4>
                                        <p class="small text-muted mb-0">
                                            <?= !empty($ritiro) ? $ritiro : 'In attesa'?>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</section>

<?php include 'base/footer.php'?>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>
<script src="script/script.js"></script>
</body>
</html>