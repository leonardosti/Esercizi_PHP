<?php
function StampaArticoli($database){
    try {
        $sql = "SELECT * FROM negozio_elettronica.prodotti p WHERE p.quantita > 0 ";

        $stmt = $database->prepare($sql);
        $stmt->execute();
        $articoli = $stmt->fetchAll(PDO::FETCH_ASSOC);
        if (count($articoli) > 0) {
            foreach ($articoli as $articolo) {
                echo "<tr>
                        <td><strong># {$articolo['codice']}</strong></td>
                        <td>{$articolo['descrizione']}</td>
                        <td>{$articolo['costo']}</td>
                        <td>{$articolo['quantita']}</td>
                        <td>{$articolo['data_produzione']}</td>
                      </tr>";
            }
        } else {
            echo "<h3 class='text-primary text-center my-5'>Nessun articolo trovato.</h3>";
        }
    } catch (PDOException $e) {
        echo "Errore di connessione: " . $e->getMessage();
    }
}

function form($attributi){
    foreach ($attributi as $attributo => $tipo) {
        echo '<div class="mb-3">
                    <label for="'.$attributo.'" class="form-label fw-semibold">'.ucfirst($attributo).'</label>
                    <input type="'.$tipo.'" class="form-control" id="'.$attributo.'" name="'.$attributo.'" placeholder="'.$attributo.'" required>
                </div>';
    }
}

function StampaIdProdotti($database){
    try {
        $query = "SELECT p.codice FROM negozio_elettronica.prodotti p ";
        $stmt = $database->prepare($query);
        $stmt->execute();

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            echo "<option value='{$row['codice']}'># {$row['codice']}</option>";
        }
    } catch (PDOException $e) {
        echo "Errore di connessione: " . $e->getMessage();
    }
}