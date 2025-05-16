<?php
include "base/database_connection/db_functions.php";
$database = require 'base/database_connection/database_connection.php';
session_start();
?>

<?php include 'base/header.php'; ?>
    <!-- Hero Section -->
    <section class="hero-section text-center">
        <div class="container">
            <h1 class="display-3 fw-bold mb-4">Tecnologia all'Avanguardia</h1>
            <p class="lead mb-5">Scopri i migliori prodotti di elettronica selezionati per te. Qualità garantita e prezzi competitivi.</p>
        </div>
    </section>

    <!-- Features Section -->
    <section class="container mb-5">
        <h2 class="text-center section-heading">Perché Scegliere ElettroTech</h2>
        <div class="row">
            <div class="col-md-4">
                <div class="card feature-card h-100 text-center p-4">
                    <div class="card-body">
                        <div class="feature-icon">
                            <i class="fas fa-medal"></i>
                        </div>
                        <h3 class="card-title h4">Prodotti Premium</h3>
                        <p class="card-text">Selezioniamo solo prodotti di alta qualità dalle migliori marche sul mercato.</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card feature-card h-100 text-center p-4">
                    <div class="card-body">
                        <div class="feature-icon">
                            <i class="fas fa-shipping-fast"></i>
                        </div>
                        <h3 class="card-title h4">Consegna Rapida</h3>
                        <p class="card-text">Spedizione veloce in tutta Italia. Ricevi il tuo ordine in 24/48 ore lavorative.</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card feature-card h-100 text-center p-4">
                    <div class="card-body">
                        <div class="feature-icon">
                            <i class="fas fa-headset"></i>
                        </div>
                        <h3 class="card-title h4">Assistenza Dedicata</h3>
                        <p class="card-text">Il nostro team di esperti è sempre disponibile per aiutarti nella scelta migliore.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Product Preview -->
    <section class="product-preview bg-light py-5">
        <div class="container">
            <h2 class="text-center section-heading">I Nostri Prodotti in Evidenza</h2>
            <div class="row">
                <div class="col-md-3 mb-4">
                    <div class="card product-card h-100">
                        <div class="card-body">
                            <h5 class="card-title">Smartphone Pro Max</h5>
                            <p class="card-text text-muted">Display OLED, 256GB, Fotocamera 108MP</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 mb-4">
                    <div class="card product-card h-100">
                        <div class="card-body">
                            <h5 class="card-title">Ultrabook Elite</h5>
                            <p class="card-text text-muted">Intel i7, 16GB RAM, SSD 512GB</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 mb-4">
                    <div class="card product-card h-100">
                        <div class="card-body">
                            <h5 class="card-title">Smartwatch Fitness</h5>
                            <p class="card-text text-muted">Cardiofrequenzimetro, GPS, Resistente all'acqua</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 mb-4">
                    <div class="card product-card h-100">
                        <div class="card-body">
                            <h5 class="card-title">Cuffie Wireless Pro</h5>
                            <p class="card-text text-muted">Cancellazione del rumore, 30h di autonomia</p>
                        </div>
                    </div>
                </div>
            </div>
            <?php if(isset($_SESSION['ruolo'])){?>
                <div class="text-center mt-4">
                    <a href="dashboard.php" class="btn btn-tech btn-lg">
                        <i class="fas fa-th-list me-2"></i>Visualizza tutti i prodotti
                    </a>
                </div>
            <?php }?>
        </div>
    </section>
<?php include 'base/footer.php'; ?>