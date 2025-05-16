<?php
include 'base/database_connection/db_functions.php';
$database = require 'base/database_connection/database_connection.php';
$attributi = [
        'email' => 'email',
        'nuova_password' => 'password',
        'conferma_password' => 'password'
];
session_start();

if($_SERVER['REQUEST_METHOD'] === "POST")
{
    $email = isset($_POST['email']) ? $_POST['email'] : '';
    $nuova_password = isset($_POST['nuova_password']) ? $_POST['nuova_password'] : '';
    $conferma_password = isset($_POST['conferma_password']) ? $_POST['conferma_password'] : '';

    try{
        $query = "SELECT p.email FROM fastroute.personale p WHERE p.email = :email;";
        $stmt = $database->prepare($query);
        $stmt->bindParam(':email', $email, PDO::PARAM_STR);
        $stmt->execute();
        if (!$risultato = $stmt->fetch()){
            echo "<script>alert('Utente non trovato, inserire email valida');</script>";

        }
    }catch(PDOException $e){
        // error message
        echo "<script>alert('" . addslashes($e->getMessage()) . "');</script>";
    }

    // controllo password
    $patternPassword = '/^(?=.*[a-z])    # almeno una minuscola
                         (?=.*[A-Z])     # almeno una maiuscola
                         (?=.*\d)        # almeno un numero
                         (?=.*\W)        # almeno un carattere speciale
                         .{8,}           # minimo 8 caratteri
                         $/x';

    if (!preg_match($patternPassword, $nuova_password)) {
        echo "<script>
                alert('Password non valida. Deve contenere minimo 8 caratteri, '
                    + 'una maiuscola, una minuscola, un numero e un carattere speciale.');
              </script>";
        exit;
    }

    // controllo se le due password corrispondono
    if(!($nuova_password == $conferma_password)){
        echo "<script>alert('Le due password non corrispondono');</script>";
    }
    $nuova_password = password_hash($nuova_password, PASSWORD_DEFAULT);
    try{
        $query = "UPDATE fastroute.personale SET password = :password WHERE email = :email";
        $stmt = $database->prepare($query);
        $stmt->bindParam(':password', $nuova_password, PDO::PARAM_STR);
        $stmt->bindParam(':email', $email, PDO::PARAM_STR);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            echo "<script>alert('Password aggiornata con successo');</script>";
            header('Location: index.php');
        } else {
            echo "<script>alert('Impossibile aggiornare la password');</script>";
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
<!-- Form Log-In -->
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-5 col-md-8">
            <div class="card shadow-sm">
                <div class="card-body p-4">
                    <div class="text-center mb-4">
                        <h2 class="fw-bold text-primary">Cambio password</h2>
                        <p class="text-muted">Cambia la tua password per aggiornare il sistema</p>
                    </div>
                    <form method="POST" action="">
                        <?= form($attributi);?>
                        <button type="submit" class="btn btn-primary w-100 py-2">
                            <i class="fas fa-sign-in-alt me-2"></i>Conferma
                        </button>
                    </form>
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
