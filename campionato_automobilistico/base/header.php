<?php
/**@var $title**/
?>
<!doctype html>
<html lang="it">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="bootstrap-5.3.3-dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="style/style.css">
    <title><?="Campionato - ".$title?></title>
</head>
<body>
<!-- Navbar -->
<nav class="navbar navbar-expand-lg nav-justified sticky-lg-top">
    <div class="container-fluid d-flex justify-content-between">
        <button class="navbar-toggler me-auto" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav mx-auto">
                <li class="nav-item">
                    <a class="nav-link text-white fs-5 px-4" href="index.php">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white fs-5 px-4" href="classifiche.php">Classifiche</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white fs-5 px-4" href="inserimento.php">Inserimento</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white fs-5 px-4" href="statistiche.php">Statistiche</a>
                </li>
            </ul>
        </div>
    </div>
</nav>
<header class="container-fluid p-5 shadow-lg">
    <h1 class="text-center display-4 fw-bold">Campionato automobilistico</h1>
</header>
