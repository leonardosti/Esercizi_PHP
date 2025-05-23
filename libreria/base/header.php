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
    <title><?=$title?></title>
</head>
<body>
<!-- Navbar -->
<nav class="navbar navbar-expand-lg nav-justified bg-dark sticky-lg-top" data-bs-theme="dark">
    <div class="container-fluid d-flex justify-content-between">
        <button class="navbar-toggler me-auto" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav mx-auto">
                <li class="nav-item">
                    <a class="nav-link fs-5 px-4" href="index.php">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link fs-5 px-4" href="catalogo.php">Catalogo</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link fs-5 px-4" href="inserisci.php">Aggiungi</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link fs-5 px-4" href="modifica.php">Modifica</a>
                </li>
            </ul>
        </div>
    </div>
</nav>
<!-- Header -->
<header class="navbar bg-body-tertiary">
    <div class="container-fluid">
        <a class="navbar-brand fs-1 h1" href="index.php">
            <img src="style/images/logo.png" alt="Logo" width="60" height="60" class="d-inline-block me-2 img-fluid">
            Libreria
        </a>
    </div>
</header>


