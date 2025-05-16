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
}else if($_SESSION["ruolo"] != "amministratore"){
    echo "<script>
            alert('Spiacenti ma non puoi accedere a questa pagina');
            window.location.href = 'index.php';
          </script>";
    exit;
}

if($_SERVER['REQUEST_METHOD'] === "POST")
{
    $id = $_POST['prodotto'] ?? '';
    $costo = $_POST['costo'] ?? '';

    try{
        $query = "UPDATE negozio_elettronica.prodotti p set p.costo = :costo where p.codice = :id";
        $stmt = $database->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->bindParam(':costo', $costo);
        $stmt->execute();
        if($stmt->rowCount() > 0){
            echo "<script>alert('Operazione terminata con successo!')</script>";
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
    <!-- Registrazione spedizione -->
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-lg-8 col-md-10">
                <div class="card shadow-sm border-0 rounded-3">
                    <div class="card-header bg-white border-bottom-0 pt-4 pb-0">
                        <h2 class="card-title fw-bold text-tech">
                            <i class="fas fa-box-open me-2"></i>Modifica Prodotto
                        </h2>
                        <p class="text-muted">Inserisci dettagli prodotto</p>
                    </div>
                    <div class="card-body p-4">
                        <form method="POST" class="needs-validation" novalidate>
                            <!-- Plico -->
                            <div class="col-md-6">
                                <div class="form-floating mb-4">
                                    <select class="form-select" id="prodotto" name="prodotto" required>
                                        <option value="" selected disabled>Seleziona un prodotto</option>
                                        <?= StampaIdProdotti($database) ?>
                                    </select>
                                    <div class="mb-3">
                                        <label for="costo" class="form-label fw-semibold">Inserisci costo</label>
                                        <input type="number" class="form-control" id="costo" name="costo" placeholder="costo" required>
                                    </div>
                                    <label for="prodotto">Prodotto</label>
                                    <div class="invalid-feedback">
                                        Seleziona un prodotto valido.
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 mt-4">
                                <button type="submit" class="btn btn-tech px-4 py-2">
                                    <i class="fas fa-paper-plane me-2"></i>Registra modifica
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php include 'base/footer.php' ?>

