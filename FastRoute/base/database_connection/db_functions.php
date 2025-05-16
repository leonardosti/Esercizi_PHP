<?php
function StampaSpedizioni($database){
    try {
        $sql = "SELECT 
                    p.id AS codice_plico, 
                    mittente.nome AS nome_mittente, 
                    mittente.cognome AS cognome_mittente, 
                    destinatario.nome AS nome_destinatario, 
                    destinatario.cognome AS cognome_destinatario, 
                    p.stato, 
                    p.consegna, 
                    p.spedizione, 
                    p.ritiro 
                FROM fastroute.plichi p
                JOIN fastroute.clienti mittente ON p.mittente = mittente.id
                JOIN fastroute.clienti destinatario ON p.destinatario = destinatario.id
                ORDER BY p.ritiro IS NOT NULL, p.ritiro DESC";

        $stmt = $database->prepare($sql);
        $stmt->execute();
        $spedizioni = $stmt->fetchAll(PDO::FETCH_ASSOC);
        if (count($spedizioni) > 0) {
            foreach ($spedizioni as $spedizione) {
                echo "<tr>
                        <td><strong>{$spedizione['codice_plico']}</strong></td>
                        <td>{$spedizione['nome_mittente']} {$spedizione['cognome_mittente']}</td>
                        <td>{$spedizione['nome_destinatario']} {$spedizione['cognome_destinatario']}</td>
                        <td>{$spedizione['stato']}</td>
                        <td>{$spedizione['consegna']}</td>
                        <td>{$spedizione['spedizione']}</td>
                        <td>{$spedizione['ritiro']}</td>
                      </tr>";
            }
        } else {
            echo "<h3 class='text-primary text-center my-5'>Nessuna spedizione trovata.</h3>";
        }
    } catch (PDOException $e) {
        echo "Errore di connessione: " . $e->getMessage();
    }
}

function StampaSpedizioniCliente($database) {
    $nome = $_SESSION['username'];
    $cognome = $_SESSION['cognome'];
    try {
        if (!empty($_GET['cerca'])) {

            $plico = $_GET['cerca'];
        }

        $sql = "
            SELECT 
                p.id AS codice_plico, 
                mittente.nome AS nome_mittente, 
                mittente.cognome AS cognome_mittente, 
                destinatario.nome AS nome_destinatario, 
                destinatario.cognome AS cognome_destinatario, 
                p.stato, 
                p.consegna, 
                p.spedizione, 
                p.ritiro 
            FROM fastroute.plichi p
            JOIN fastroute.clienti mittente 
              ON p.mittente = mittente.id
            JOIN fastroute.clienti destinatario 
              ON p.destinatario = destinatario.id
            WHERE 
              (mittente.nome = :nome AND mittente.cognome = :cognome)
              OR 
              (destinatario.nome = :nome AND destinatario.cognome = :cognome)
              ORDER BY p.ritiro IS NOT NULL, p.ritiro DESC";



        $stmt = $database->prepare($sql);
        $stmt->bindParam(':nome',    $nome);
        $stmt->bindParam(':cognome', $cognome);
        $stmt->execute();

        $spedizioni = $stmt->fetchAll(PDO::FETCH_ASSOC);

        if (!empty($spedizioni)) {
            foreach ($spedizioni as $s) {
                echo "<tr>
                        <td><strong>{$s['codice_plico']}</strong></td>
                        <td>{$s['nome_mittente']} {$s['cognome_mittente']}</td>
                        <td>{$s['nome_destinatario']} {$s['cognome_destinatario']}</td>
                        <td>{$s['stato']}</td>
                        <td>{$s['consegna']}</td>
                        <td>{$s['spedizione']}</td>
                        <td>{$s['ritiro']}</td>
                      </tr>";
            }
        } else {
            echo "<h3 class='text-primary text-center my-5'>Nessuna spedizione trovata.</h3>";
        }
    } catch (PDOException $e) {
        echo "Errore di connessione: " . htmlspecialchars($e->getMessage());
    }
}

function StampaSpedizioniFiltrate($database, $data) {
    try{
        $query = "SELECT 
                    p.id AS codice_plico, 
                    mittente.nome AS nome_mittente, 
                    mittente.cognome AS cognome_mittente, 
                    destinatario.nome AS nome_destinatario, 
                    destinatario.cognome AS cognome_destinatario, 
                    p.stato, 
                    p.consegna, 
                    p.spedizione, 
                    p.ritiro 
                FROM fastroute.plichi p
                JOIN fastroute.clienti mittente ON p.mittente = mittente.id
                JOIN fastroute.clienti destinatario ON p.destinatario = destinatario.id
                WHERE p.ritiro >= :data
                ORDER BY p.ritiro IS NOT NULL, p.ritiro DESC";
        $stmt = $database->prepare($query);
        $stmt->bindParam(':data', $data);
        $stmt->execute();
        $spedizioni = $stmt->fetchAll(PDO::FETCH_ASSOC);
        if (count($spedizioni) > 0) {
            foreach ($spedizioni as $spedizione) {
                echo "<tr>
                        <td><strong>{$spedizione['codice_plico']}</strong></td>
                        <td>{$spedizione['nome_mittente']} {$spedizione['cognome_mittente']}</td>
                        <td>{$spedizione['nome_destinatario']} {$spedizione['cognome_destinatario']}</td>
                        <td>{$spedizione['stato']}</td>
                        <td>{$spedizione['consegna']}</td>
                        <td>{$spedizione['spedizione']}</td>
                        <td>{$spedizione['ritiro']}</td>
                      </tr>";
            }
        } else {
            echo "<h3 class='text-primary text-center my-5'>Nessuna spedizione trovata.</h3>";
        }
    }catch(PDOException $e){
        // error message
        echo "<script>alert('" . addslashes($e->getMessage()) . "');</script>";
    }
}

function StampaSpedizioniFiltrateClienti($database, $data) {
    $nome = $_SESSION['username'];
    $cognome = $_SESSION['cognome'];

    try{
        $query = "SELECT 
                    p.id AS codice_plico, 
                    mittente.nome AS nome_mittente, 
                    mittente.cognome AS cognome_mittente, 
                    destinatario.nome AS nome_destinatario, 
                    destinatario.cognome AS cognome_destinatario, 
                    p.stato, 
                    p.consegna, 
                    p.spedizione, 
                    p.ritiro 
                FROM fastroute.plichi p
                JOIN fastroute.clienti mittente ON p.mittente = mittente.id
                JOIN fastroute.clienti destinatario ON p.destinatario = destinatario.id
                WHERE p.ritiro >= :data
                AND (
                  (mittente.nome    = :nome AND mittente.cognome    = :cognome)
                  OR
                  (destinatario.nome = :nome AND destinatario.cognome = :cognome)
                )
                ORDER BY p.ritiro IS NOT NULL, p.ritiro DESC";
        $stmt = $database->prepare($query);
        $stmt->bindParam(':data', $data);
        $stmt->bindParam(':nome',    $nome);
        $stmt->bindParam(':cognome', $cognome);
        $stmt->execute();
        $spedizioni = $stmt->fetchAll(PDO::FETCH_ASSOC);
        if (count($spedizioni) > 0) {
            foreach ($spedizioni as $spedizione) {
                echo "<tr>
                        <td><strong>{$spedizione['codice_plico']}</strong></td>
                        <td>{$spedizione['nome_mittente']} {$spedizione['cognome_mittente']}</td>
                        <td>{$spedizione['nome_destinatario']} {$spedizione['cognome_destinatario']}</td>
                        <td>{$spedizione['stato']}</td>
                        <td>{$spedizione['consegna']}</td>
                        <td>{$spedizione['spedizione']}</td>
                        <td>{$spedizione['ritiro']}</td>
                      </tr>";
            }
        } else {
            echo "<h3 class='text-primary text-center my-5'>Nessuna spedizione trovata.</h3>";
        }
    }catch(PDOException $e){
        // error message
        echo "<script>alert('" . addslashes($e->getMessage()) . "');</script>";
    }
}


function form($attributi){
    foreach ($attributi as $attributo => $tipo) {
        echo '<div class="mb-3">
                    <label for="'.$attributo.'" class="form-label fw-semibold">'.ucfirst($attributo).'</label>
                    <input type="'.$tipo.'" class="form-control" id="'.$attributo.'" name="'.$attributo.'" placeholder="'.($attributo === 'telefono' ? '1234567890' : 'Inserisci '.$attributo).'" 
                    '.($attributo === 'telefono' ? ' pattern="[0-9]{10}"' : '').' required>
                </div>';
    }
}

function StampaClienti($database){
    try {
        $query = "SELECT id, nome FROM fastroute.clienti";
        $stmt = $database->prepare($query);
        $stmt->execute();

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            echo "<option value='{$row['id']}'># {$row['id']} - {$row['nome']}</option>";
        }
    } catch (PDOException $e) {
        echo "Errore di connessione: " . $e->getMessage();
    }
}
function StampaSedi($database){
    try {
        $query = "SELECT id, nome, citta FROM fastroute.sedi";
        $stmt = $database->prepare($query);
        $stmt->execute();

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            echo "<option value='{$row['id']}'># {$row['id']} - {$row['nome']} - {$row['citta']}</option>";
        }
    } catch (PDOException $e) {
        echo "Errore di connessione: " . $e->getMessage();
    }
}

function StampaPlichi($database, $operazione){
    try {
        if($operazione == 'spedizione'){
            $query = "SELECT id FROM fastroute.plichi p where p.spedizione IS NULL and p.ritiro IS NULL";
            $stmt = $database->prepare($query);
        }else if($operazione == 'ritiro'){
            $query = "SELECT id FROM fastroute.plichi p where p.ritiro IS NULL";
            $stmt = $database->prepare($query);
        }else{
            $query = "SELECT id FROM fastroute.plichi";
            $stmt = $database->prepare($query);
        }
        $stmt->execute();

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            echo "<option value='{$row['id']}'># {$row['id']}</option>";
        }
    } catch (PDOException $e) {
        echo "Errore di connessione: " . $e->getMessage();
    }
}
