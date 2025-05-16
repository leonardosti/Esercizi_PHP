<?php
// logout session
if (isset($_GET['logout'])) {
    $_SESSION = array();
    session_destroy();
    header("Location:index.php");
}

?>
<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ElettroTech - Il tuo negozio di elettronica</title>
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="style/style.css">
</head>
<body>
<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-dark bg-tech sticky-top">
    <div class="container">
        <a class="navbar-brand" href="index.php">ElettroTech</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                    <a class="nav-link" href="index.php">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="dashboard.php">Prodotti</a>
                </li>
                <?php if(isset($_SESSION['ruolo']) && $_SESSION['ruolo'] == 'amministratore'){ ?>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Dropdown
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <li><a class="dropdown-item" href="inserisci.php">Inserisci</a></li>
                            <li><a class="dropdown-item" href="modifica.php">Modifica</a></li>
                            <li><a class="dropdown-item" href="elimina.php">Elimina</a></li>
                        </ul>
                    </li>
                <?php } ?>
            </ul>
            <div class="nav-actions d-flex align-items-center">
                <?php if(isset($_SESSION['user_id'])){ ?>
                    <div class="dropdown">
                        <button class="btn btn-tech dropdown-toggle" type="button"
                                id="userDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="fas fa-user-circle me-2"></i>
                            <?php echo $_SESSION['username'] ?? 'Utente'; ?>
                        </button>
                        <ul class="dropdown-menu dropdown-menu-end shadow-sm border-0" aria-labelledby="userDropdown">
                            <li><hr class="dropdown-divider"></li>
                            <li><a class="dropdown-item" href="?logout=1">
                                    <i class="fas fa-sign-out-alt me-2 text-tech"></i>Logout
                                </a></li>
                        </ul>
                    </div>
                <?php } else { ?>
                    <div class="row">
                        <div class="col-auto">
                            <a href="login.php" class="btn btn-tech m-1">
                                <i class="fas fa-sign-in-alt me-2"></i>Accedi
                            </a>
                        </div>
                        <div class="col-auto">
                            <a href="register.php" class="btn btn-tech m-1">
                                <i class="fas fa-user-plus me-2"></i>Registrati
                            </a>
                        </div>
                    </div>
                <?php } ?>
            </div>
        </div>
    </div>
</nav>
