<?php
include 'base/database_connection/db_functions.php';
$database = require 'base/database_connection/database_connection.php';
$attributi = [
        'email' => 'email',
        'password' => 'password',
];
session_start();

if($_SERVER['REQUEST_METHOD'] === "POST")
{
    $email = isset($_POST['email']) ? $_POST['email'] : '';
    $password = isset($_POST['password']) ? $_POST['password'] : '';
    try{
        $query = "SELECT c.id, c.nome, c.cognome, c.email, c.password FROM fastroute.clienti c WHERE c.email = '$email';";
        $stmt = $database->prepare($query);
        $stmt->execute();
        $risultato = $stmt->fetch();
        if($risultato && password_verify($password, $risultato->password)){
            $_SESSION['user_id'] = $risultato->id;
            $_SESSION['username'] = ucfirst($risultato->nome);
            $_SESSION['cognome'] = ucfirst($risultato->cognome);
            $_SESSION['ruolo'] = 'cliente';
            header("Location: dashboard.php");
            exit;
        }
        $query = "SELECT p.id, p.nome, p.email, p.password FROM fastroute.personale p WHERE p.email = '$email';";
        $stmt = $database->prepare($query);
        $stmt->execute();
        $risultato = $stmt->fetch();
        if($risultato && password_verify($password, $risultato->password)){
            $_SESSION['user_id'] = $risultato->id;
            $_SESSION['username'] = ucfirst($risultato->nome);
            $_SESSION['ruolo'] = 'personale';
            header('Location: index.php');
            exit;
        }
        echo "<script>alert('Email o password non validi');</script>";
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
<!-- Form Log-In -->
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-5 col-md-8">
            <div class="card shadow-sm">
                <div class="card-body p-4">
                    <div class="text-center mb-4">
                        <h2 class="fw-bold text-primary">Accedi a FastRoute</h2>
                        <p class="text-muted">Inserisci le tue credenziali per accedere al sistema</p>
                    </div>
                    <form method="POST" action="">
                        <?= form($attributi);?>
                        <div class="mb-4 form-check">
                            <a href="#" class="float text-primary">Password dimenticata?</a>
                        </div>
                        <button type="submit" class="btn btn-primary w-100 py-2">
                            <i class="fas fa-sign-in-alt me-2"></i>Accedi
                        </button>
                    </form>

                    <div class="text-center mt-4">
                        <p class="mb-0">Non hai un account? <a href="signin.php" class="text-primary">Registrati</a></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include 'base/footer.php'?>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>
<script src="script/script.js"></script>
</body>
</html>
