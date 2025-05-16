<?php
include "base/database_connection/db_functions.php";
$database = require 'base/database_connection/database_connection.php';
session_start();

if($_SERVER['REQUEST_METHOD'] == 'POST' && !empty($_POST['giorni_filtro'])){
    $giorni = trim($_POST['giorni_filtro']);
    $data = date('Y-m-d H:i:s', strtotime("-{$giorni} days"));
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
        <h1 class="fw-bold text-primary mb-2">Consegne ultimi N giorni</h1>
        <p class="text-muted mb-0">Seleziona il numero di giorni e scopri quante consegne sono state ritirate in questo periodo, per monitorare facilmente l’andamento delle spedizioni e ottimizzare la pianificazione delle corse.</p>
    </div>
</div>
<section class="py-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-10">
                <div class="card border-0 shadow-sm">
                    <div class="card-header bg-primary text-white py-3">
                        <h2 class="h4 mb-0 text-center fw-bold">
                            <i class="fas fa-filter me-2"></i>Filtra consegne per periodo
                        </h2>
                    </div>
                    <div class="card-body p-4">
                        <form action="" method="POST">
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <label for="giorni_filtro" class="form-label fw-bold">Ultimi giorni</label>
                                    <div class="input-group">
                                        <span class="input-group-text bg-white border-end-0">
                                            <i class="fas fa-calendar-alt text-primary"></i>
                                        </span>
                                        <input type="number" class="form-control border-start-0"
                                               name="giorni_filtro" min="1" max="90" required>
                                    </div>
                                    <div class="form-text">Inserisci il numero di giorni da considerare (1-90)</div>
                                </div>
                                <div class="col-12">
                                    <div class="d-grid">
                                        <button type="submit" class="btn btn-primary py-2">
                                            <i class="fas fa-search me-2"></i>Filtra risultati
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

                <!-- Risultati -->
                <?php if(isset($giorni)) {?>
                <div class="mt-4 ">
                    <div class="card border-0 shadow-sm">
                        <div class="card-header bg-white py-3 d-flex justify-content-between align-items-center">
                            <h3 class="h5 mb-0 fw-bold">Risultati consegne</h3>
                        </div>
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
                                if (isset($_SESSION['ruolo']) && $_SESSION['ruolo'] == 'personale')
                                    StampaSpedizioniFiltrate($database, $data);
                                else if(isset($_SESSION['ruolo']) && $_SESSION['ruolo'] == 'cliente')
                                    StampaSpedizioniFiltrateClienti($database, $data);
                                else
                                    echo "<h2 class='text-primary text-center my-5'>Accedi per vedere le tue spedizioni</h2>";
                                ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <?php } ?>
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