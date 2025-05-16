<?php
include 'base/database_connection/db_functions.php';
$database = require 'base/database_connection/database_connection.php';
$attributi = [
    'username' => 'text',
    'email' => 'text',
    'password_hash' => 'password',
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

    $dati['password_hash'] = password_hash($dati['password'], PASSWORD_DEFAULT);

    try{
        $query = "INSERT INTO negozio_elettronica.utenti (username, email, password_hash, ruolo) VALUES 
                (:username, :email, :password_hash, :ruolo)";
        $stmt = $database->prepare($query);
        foreach($dati as $attributo => $valore){
            $stmt->bindValue(':' . $attributo, $valore);
        }
        $stmt->bindValue(':ruolo', 'utente');
        $stmt->execute();
        echo "<script>
            alert('Registrazione avvenuta con successo');
            window.location.href = 'login.php';
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
                        <h2 class="fw-bold text-tech">Registrati a ElettroTech</h2>
                        <p class="text-muted">Inserisci le tue informazioni per registrarti al sistema</p>
                    </div>
                    <form method="POST" action="">
                        <?= form($attributi);?>
                        <button type="submit" class="btn btn-tech w-100 py-2">
                            <i class="fas fa-sign-in-alt me-2"></i>Registrati
                        </button>
                    </form>

                    <div class="text-center mt-4">
                        <p class="mb-0">Hai gia' un account? <a href="login.php" class="text-tech">Accedi</a></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php include 'base/footer.php'?>
