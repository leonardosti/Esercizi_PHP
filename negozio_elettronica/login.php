<?php
session_start();
include 'base/database_connection/db_functions.php';
$database = require 'base/database_connection/database_connection.php';
$attributi = [
    'username' => 'text',
    'password_hash' => 'password',
];

if($_SERVER['REQUEST_METHOD'] === "POST")
{
    $username = isset($_POST['username']) ? $_POST['username'] : '';
    $password = isset($_POST['password_hash']) ? $_POST['password_hash'] : '';
    try{
        $query = "SELECT u.id, u.username, u.password_hash, u.ruolo FROM negozio_elettronica.utenti u WHERE u.username = :username;";
        $stmt = $database->prepare($query);
        $stmt->bindValue(':username', $username);
        $stmt->execute();
        $risultato = $stmt->fetch(PDO::FETCH_OBJ);
        if($risultato && password_verify($password, $risultato->password_hash)){
            $_SESSION['user_id'] = $risultato->id;
            $_SESSION['username'] = $risultato->username;
            $_SESSION['ruolo'] = $risultato->ruolo;
            header('Location: index.php');
            exit;
        } else{
            echo "<script>alert('Email o password non validi');</script>";
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
<!-- Form Registrazione -->
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-5 col-md-8">
            <div class="card shadow-sm">
                <div class="card-body p-4">
                    <div class="text-center mb-4">
                        <h2 class="fw-bold text-tech">Accedi a ElettroTech</h2>
                        <p class="text-muted">Inserisci le tue informazioni per accedere al sistema</p>
                    </div>
                    <form method="POST" action="">
                        <?= form($attributi);?>
                        <button type="submit" class="btn btn-tech w-100 py-2">
                            <i class="fas fa-sign-in-alt me-2"></i>Accedi
                        </button>
                    </form>
                    <div class="text-center mt-4">
                        <p class="mb-0">Non hai un account? <a href="register.php" class="text-tech">Registrati</a></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php include 'base/footer.php'?>