<?php
include "base/database_connection/db_functions.php";
$database = require 'base/database_connection/database_connection.php';
session_start();
?>

<?php include 'base/header.php'; ?>

<!-- Content Area -->
<div class="content-area m-4 p-4">
    <div class="m-4">
        <div class="col-md-12">
            <div class="user-welcome mb-4">
                <div class="d-flex justify-content-between">
                    <div>
                        <h3 class="mb-1">Benvenuto nella Dashboard</h3>
                        <p class="mb-0">Ecco un riassunto dei dati del negozio</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="m-4">
        <div class="col-md-12">
            <div class="card dashboard-card">
                <div class="card-header bg-white d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Catalogo Prodotti</h5>
                    <?php if(isset($_SESSION['ruolo']) && $_SESSION['ruolo'] == 'amministratore'){?>
                    <div>
                        <a class="btn btn-tech me-2">
                            <i class="fas fa-plus me-1"></i>Aggiungi Prodotto
                        </a>
                    </div>
                    <?php }?>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-hover product-table mb-0">
                            <thead>
                            <tr>
                                <th>Codice</th>
                                <th>Prodotto</th>
                                <th>Prezzo</th>
                                <th>Quantità</th>
                                <th>Data Produzione</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php StampaArticoli($database); ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php include 'base/footer.php'; ?>

