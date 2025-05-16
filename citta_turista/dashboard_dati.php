<?php
session_start();
$citta = include 'citta.php';
if(time() - $_SESSION['tempo'] > 60){
    $_SESSION = array();
    session_destroy();
    echo '<p>Tempo della sessione scaduto</p>';
    echo '<p><a href="index.php">Torna alla pagina precedente</a></p>';
    exit;
} else {
    for ($i = 0; $i < count($citta); $i++) {
        $voti[$i] = $_POST[$citta[$i]] ?? 0;
        if ($voti[$i] < 1 || $voti[$i] > 5) {
            $voti[$i] = 0;
        }
    }

    $dashboard = array_combine($citta, $voti); // associo la citta con il suo voto
    arsort($dashboard); // ordino in ordine decrescente

    function stampaTabella($dashboard) {
        if (empty($dashboard)) {
            echo "<p>Nessun dato disponibile</p>";
            return;
        }

        echo '<table>';
        echo '<tr><th>Città</th><th>Voto</th></tr>';

        foreach ($dashboard as $citta => $voto) {
            echo "<tr><td>$citta</td><td>$voto</td></tr>";
        }

        echo '</table>';
    }

}
?>
<!doctype html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Dashboard Citta'</title>
</head>
<body>
    <?php stampaTabella($dashboard) ?>
</body>
</html>
