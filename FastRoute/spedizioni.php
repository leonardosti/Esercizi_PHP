<?php
include "base/database_connection/db_functions.php";
$database = require 'base/database_connection/database_connection.php';
session_start();
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
        <h1 class="fw-bold text-primary mb-2">Dashboard Operativa</h1>
        <p class="text-muted mb-0">Benvenuto nel sistema di gestione spedizioni FastRoute. Qui puoi monitorare e gestire tutte le spedizioni in tempo reale.</p>
    </div>
</div>
<!-- Dashboard spedizioni -->
<div class="card shadow-sm">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-hover align-middle" id="shipmentsTable">
                <thead class="table-light">
                <tr>
                    <th scope="col" class="fw-semibold">
                        <i class="fas fa-hashtag me-1 text-primary"></i>Codice
                    </th>
                    <th scope="col" class="fw-semibold">
                        <i class="fas fa-user me-1 text-primary"></i>Mittente
                    </th>
                    <th scope="col" class="fw-semibold">
                        <i class="fas fa-user-check me-1 text-primary"></i>Destinatario
                    </th>
                    <th scope="col" class="fw-semibold">
                        <i class="fas fa-tag me-1 text-primary"></i>Stato
                    </th>
                    <th scope="col" class="fw-semibold">
                        <i class="fas fa-calendar me-1 text-primary"></i>Data Consegna
                    </th>
                    <th scope="col" class="fw-semibold">
                        <i class="fas fa-calendar-alt me-1 text-primary"></i>Data Spedizione
                    </th>
                    <th scope="col" class="fw-semibold">
                        <i class="fas fa-calendar-check me-1 text-primary"></i>Data Ritiro
                    </th>
                </tr>
                </thead>
                <tbody>
                <?php
                if (isset($_SESSION['ruolo']) && $_SESSION['ruolo'] = 'personale')
                    StampaSpedizioni($database);
                else
                    StampaSpedizioniCliente($database);
                ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?php include 'base/footer.php'?>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>
<script src="script/script.js"></script>
</body>
</html>