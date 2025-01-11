<?php
require 'config.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST')
{
    if (isset($_POST['inserisci_aeroporto']))
    {
        $codice = $_POST['Codice'];
        $nome = $_POST['Nome'];
        $citta = $_POST['Citta'];
        $nazione = $_POST['Nazione'];

        if (!empty($codice) && !empty($nome) && !empty($citta) && !empty($nazione)) 
        {
            $query = "INSERT INTO aeroporti (id, nome, citta, nazione) VALUES ('" . $codice . "', '" . $nome . "', '" . $citta . "', '" . $nazione . "')";
            $result = $conn->query($query);
            echo $result ? "Aeroporto registrato con successo!" : "Errore: " . $conn->error;
        } 
        else 
            echo "Per favore, riempi tutti i campi.";
    }

    if (isset($_POST['inserisci_aereo'])) 
    {
        $modello = $_POST['Modello'];
        $capienza = $_POST['Capienza'];

        if (!empty($capienza) && !empty($modello)) 
        {
            $query = "INSERT INTO aerei (modello, capacita) VALUES ('" . $modello . "', " . $capienza . ")";
            $result = $conn->query($query);
            echo $result ? "Aereo registrato con successo!" : "Errore: " . $conn->error;
        } 
        else
            echo "Per favore, riempi tutti i campi.";
    }

    if (isset($_POST['inserisci_volo'])) 
    {
        $origine = $_POST['aeroporto_part'];
        $destinazione = $_POST['aeroporto_arr'];
        $orarioPartenza = $_POST['OrarioPartenza'];
        $orarioArrivo = $_POST['OrarioArrivo'];
        $aereo = $_POST['Aereo'];

        if (!empty($origine) && !empty($destinazione) && !empty($orarioPartenza) && !empty($orarioArrivo)) 
        {
            $orarioPartenzaSQL = date('Y-m-d H:i:s', strtotime($orarioPartenza));
            $orarioArrivoSQL = date('Y-m-d H:i:s', strtotime($orarioArrivo));

            $query = "INSERT INTO voli (aeroporto_part, aeroporto_arr, aereo, data_partenza, data_arrivo) 
                                    VALUES ('" . $origine . "', '" . $destinazione . "', " . $aereo . ", '" . $orarioPartenzaSQL . "', '" . $orarioArrivoSQL . "')";
            $result = $conn->query($query);
            echo $result ? "Volo registrato con successo!" : "Errore: " . $conn->error;
        } 
        else
            echo "Per favore, riempi tutti i campi.";
    }
}?>

<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="author" content="Giovanni Basso">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrazione Aeroporti, Aerei e Voli</title>
</head>
<body>
    <h1>Gestione Aeroporti, Aerei e Voli</h1>

    <!-- Form per registrare un aeroporto -->
    <h2>Registra Aeroporto</h2>
    <form method="POST" action="registrazione.php">
        <label for="Codice">Codice Aeroporto:</label>
        <input type="text" name="Codice" id="Codice" required>
        <br>
        <label for="Nome">Nome Aeroporto:</label>
        <input type="text" name="Nome" id="Nome" required>
        <br>
        <label for="Citta">Città Aeroporto:</label>
        <input type="text" name="Citta" id="Citta" required>
        <br>
        <label for="Nazione">Nazione Aeroporto:</label>
        <input type="text" name="Nazione" id="Nazione" required>
        <br>
        <button type="submit" name="inserisci_aeroporto">Registra Aeroporto</button>
    </form>

    <!-- Form per registrare un aereo -->
    <h2>Registra Aereo</h2>
    <form method="POST" action="registrazione.php">
        <label for="Modello">Modello Aereo:</label>
        <input type="text" name="Modello" id="Modello" required>
        <br>
        <label for="Capienza">Capienza Aereo:</label>
        <input type="text" name="Capienza" id="Capienza" required>
        <br>
        <button type="submit" name="inserisci_aereo">Registra Aereo</button>
    </form>

    <!-- Form per registrare un volo -->
    <h2>Registra Volo</h2>
    <form method="POST" action="registrazione.php">
        <label for="aeroporto_part">Codice Aeroporto di Origine:</label>
        <input type="text" name="aeroporto_part" id="aeroporto_part" required>
        <br>
        <label for="aeroporto_arr">Codice Aeroporto di Destinazione:</label>
        <input type="text" name="aeroporto_arr" id="aeroporto_arr" required>
        <br>
        <label for="OrarioPartenza">Orario Partenza:</label>
        <input type="datetime-local" name="OrarioPartenza" id="OrarioPartenza" required>
        <br>
        <label for="OrarioArrivo">Orario Arrivo:</label>
        <input type="datetime-local" name="OrarioArrivo" id="OrarioArrivo" required>
        <br>
        <label for="Aereo">Aereo:</label>
        <input type="text" name="Aereo" id="Aereo" required>
        <br>
        <button type="submit" name="inserisci_volo">Registra Volo</button>
    </form>
</body>
</html>
