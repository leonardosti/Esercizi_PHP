<?php
session_start();
include 'base/database_connection/db_functions.php';
$database = require 'base/database_connection/database_connection.php';
$attributi = [
    'descrizione' => 'text',
    'costo' => 'number',
    'quantita' => 'number',
    'data_produzione' => 'datetime',
];

if($_SERVER['REQUEST_METHOD'] === 'POST'){
    $dati = [];
    foreach (array_keys($attributi) as $key) {
        $dati[$key] = isset($_POST[$key]) ? trim($_POST[$key]) : '';
    }

    // controllo campi vuoti
    foreach ($dati as $key => $valore) {
        if ($valore === '') {
            echo "<script>alert('Completare tutti i campi della registrazione');</script>";
            exit;
        }
    }

    try{
        $query = "INSERT INTO negozio_elettronica.prodotti (descrizione, costo, quantita, data_produzione) VALUES 
                (:descrizione, :costo, :quantita, :data_produzione)";
        $stmt = $database->prepare($query);
        foreach($dati as $attributo => $valore){
            $stmt->bindValue(':' . $attributo, $valore);
        }
        $stmt->execute();
        echo "<script>
            alert('Registrazione nuovo articolo avvenuta con successo');
            window.location.href = 'dashboard.php';
          </script>";
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
<!-- Form Registrazione -->
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-5 col-md-8">
            <div class="card shadow-sm">
                <div class="card-body p-4">
                    <div class="text-center mb-4">
                        <h2 class="fw-bold text-tech">Registrati un nuovo articolo</h2>
                        <p class="text-muted">Inserisci le informazioni per registrare un nuovo articolo nel sistema</p>
                    </div>
                    <form method="POST" action="">
                        <?= form($attributi);?>
                        <button type="submit" class="btn btn-tech w-100 py-2">
                            <i class="fas fa-sign-in-alt me-2"></i>Registra
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<?php include 'base/footer.php'?>
