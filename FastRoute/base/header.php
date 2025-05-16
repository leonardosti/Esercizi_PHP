<?php
// logout session
if (isset($_GET['logout'])) {
    $_SESSION = array();
    session_destroy();
    header("Location:index.php");
}

?>
<nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm">
    <div class="container">
        <a class="navbar-brand d-flex align-items-center" href="index.php">
            <i class="fa fa-truck-fast me-2"></i>
            <span class="brand-text fw-bold text-primary">FastRoute</span>
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mainNavigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="mainNavigation">
            <ul class="navbar-nav mx-auto">
                <li class="nav-item">
                    <a class="nav-link" href="index.php">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="dashboard.php">Spedizioni</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="stato_plico.php">Verifica Stato Plico</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="ricerca_giorni.php">Consegne Ultimi N Giorni</a>
                </li>
                <?php if(isset($_SESSION['ruolo']) && $_SESSION['ruolo'] == 'personale'){ ?>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Dropdown<i class="fas fa-caret-down ms-1"></i>
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <li><a class="dropdown-item" href="consegna.php">Consegna</a></li>
                        <li><a class="dropdown-item" href="spedizione.php">Spedizione</a></li>
                        <li><a class="dropdown-item" href="ritiro.php">Ritiro</a></li>
                    </ul>
                </li>
                <?php } ?>
            </ul>
            <div class="nav-actions d-flex align-items-center">
                <?php if(isset($_SESSION['user_id'])){ ?>
                    <div class="dropdown">
                        <button class="btn btn-outline-primary dropdown-toggle" type="button"
                                id="userDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="fas fa-user-circle me-2"></i>
                            <?php echo $_SESSION['username'] ?? 'Utente'; ?>
                        </button>
                        <ul class="dropdown-menu dropdown-menu-end shadow-sm border-0" aria-labelledby="userDropdown">
                            <?php if($_SESSION['ruolo'] == 'personale'){ ?>
                            <li><a class="dropdown-item" href="cambia_password.php">
                                    <i class="fas fa-key me-2 text-primary"></i>Cambia Password
                                </a></li>
                            <?php } ?>
                            <li><hr class="dropdown-divider"></li>
                            <li><a class="dropdown-item" href="?logout=1">
                                    <i class="fas fa-sign-out-alt me-2 text-primary"></i>Logout
                                </a></li>
                        </ul>
                    </div>
                <?php } else { ?>
                    <div class="row">
                        <div class="col-auto">
                            <a href="login.php" class="btn btn-outline-primary">
                                <i class="fas fa-sign-in-alt me-2"></i>Log-In
                            </a>
                        </div>
                        <div class="col-auto">
                            <a href="signin.php" class="btn btn-primary">
                                <i class="fas fa-user-plus me-2"></i>Sign-In
                            </a>
                        </div>
                    </div>
                <?php } ?>
            </div>
        </div>
    </div>
</nav>
