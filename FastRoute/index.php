<?php
require_once 'base/database_connection/db_functions.php';
session_start();
/*$password = [
        '1234',
    'ciao1234',
    'password',
    'qwerty',
    '5678'
];
foreach ($password as $key) {
    echo password_hash($key, PASSWORD_DEFAULT).'<hr>';
}*/
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

<main>
    <main>
        <!-- Hero Section -->
        <section class="py-5 bg-light">
            <div class="container">
                <div class="row justify-content-center text-center">
                    <div class="col-lg-8">
                        <h1 class="fw-bold text-primary mb-3">Benvenuti in FastRoute</h1>
                        <p class="lead mb-4">Il tuo corriere espresso di fiducia, rapido e sicuro, con sedi in tutta Italia.</p>
                    </div>
                </div>
            </div>
        </section>

        <!-- Services Section -->
        <section class="py-5">
            <div class="container">
                <h2 class="text-center mb-4 fw-bold">I nostri servizi</h2>
                <div class="row justify-content-center">
                    <div class="col-lg-8">
                        <ul class="list-group list-group-flush shadow-sm rounded">
                            <li class="list-group-item py-3"><i class="fas fa-truck-loading me-2 text-primary"></i> <strong>Consegna in partenza</strong>: ritiriamo il tuo plico presso una delle nostre sedi.</li>
                            <li class="list-group-item py-3"><i class="fas fa-shipping-fast me-2 text-primary"></i> <strong>Spedizione veloce</strong>: tracciamento in tempo reale dello stato del plico.</li>
                            <li class="list-group-item py-3"><i class="fas fa-box me-2 text-primary"></i> <strong>Ritiro destinatario</strong>: il destinatario ritira il plico nella sede di arrivo.</li>
                            <li class="list-group-item py-3"><i class="fas fa-envelope me-2 text-primary"></i> <strong>Notifica automatica</strong>: il mittente riceve un'email di conferma al ritiro del plico.</li>
                            <li class="list-group-item py-3"><i class="fas fa-medal me-2 text-primary"></i> <strong>Programma Fedeltà</strong>: accumuli 1 punto per ogni spedizione e ottieni sconti.</li>
                        </ul>
                    </div>
                </div>
            </div>
        </section>

        <!-- Why Choose Us Section -->
        <section class="py-5 bg-light">
            <div class="container">
                <h2 class="text-center mb-4 fw-bold">Perché scegliere FastRoute?</h2>
                <div class="row g-4">
                    <div class="col-md-4">
                        <div class="card h-100 border-0 shadow-sm">
                            <div class="card-body text-center p-4">
                                <i class="fas fa-map-marked-alt text-primary mb-3" style="font-size: 2rem;"></i>
                                <h3 class="card-title h5 fw-bold">Copertura Nazionale</h3>
                                <p class="card-text">Rete capillare di sedi in tutte le regioni.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card h-100 border-0 shadow-sm">
                            <div class="card-body text-center p-4">
                                <i class="fas fa-clock text-primary mb-3" style="font-size: 2rem;"></i>
                                <h3 class="card-title h5 fw-bold">Velocità e Affidabilità</h3>
                                <p class="card-text">Consegne in 24–48h e monitoraggio continuo.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card h-100 border-0 shadow-sm">
                            <div class="card-body text-center p-4">
                                <i class="fas fa-headset text-primary mb-3" style="font-size: 2rem;"></i>
                                <h3 class="card-title h5 fw-bold">Customer Care</h3>
                                <p class="card-text">Assistenza dedicata via email e telefono.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Contact CTA Section -->
        <section class="py-5">
            <div class="container">
                <div class="row justify-content-center text-center">
                    <div class="col-lg-6">
                        <h2 class="mb-3 fw-bold">Hai domande? Contattaci!</h2>
                        <p class="mb-4">Compila il form per richiedere informazioni dettagliate sui nostri servizi.</p>
                        <a class="btn btn-primary px-4 py-2" href="#">
                            <i class="fas fa-paper-plane me-2"></i>Richiedi Informazioni
                        </a>
                    </div>
                </div>
            </div>
        </section>
    </main></main>

<?php include 'base/footer.php'?>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>
<script src="script/script.js"></script>
</body>
</html>