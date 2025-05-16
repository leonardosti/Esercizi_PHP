<?php
if(session_status() == PHP_SESSION_NONE){
    session_set_cookie_params([
        'lifetime' => 60,
        'path'     => '/',
        'domain'   => '',
        'secure'   => false,
        'httponly' => false,
    ]);
    session_start();
}

if (!isset($_SESSION['tempo'])) {
    $_SESSION['tempo'] = time(); // impostata la variabile tempo
}

$citta = include 'citta.php';


?>
<!doctype html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Citta' Turista</title>
</head>
<body>
<form action="dashboard_dati.php" method="post">
    <?php foreach($citta as $key => $nome) {?>
    <label for="<?= $nome?>">Inserisci voto per <?= $nome?></label><br>
    <input type="number" name="<?= $nome?>" id="<?= $nome?>" placeholder="<?= ucfirst($nome)?>" min="1" max="5"><br><br>
    <?php } ?>
    <button type="submit">Invia voti</button>
</form>
</body>
</html>
