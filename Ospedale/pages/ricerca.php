<?php
    include('../config/db.php');

    // Query di SELECT
    $sql_S_ALL_Osp = "SELECT * FROM Ospedali";
    $sql_S_ALL_Med = "SELECT Medici.*, Ospedali.nome AS osp_nome FROM Medici INNER JOIN Ospedali ON Medici.ospedale = Ospedali.ID";
    $sql_S_ALL_Paz = "SELECT * FROM Pazienti";
    $sql_S_ALL_App = "SELECT Appuntamenti.*, Pazienti.nome AS P_nome, Pazienti.cognome AS P_cognome, Medici.nome AS M_nome, Medici.cognome AS M_cognome FROM Appuntamenti INNER JOIN Medici ON Appuntamenti.medico = Medici.ID INNER JOIN Pazienti ON Pazienti.ID = Appuntamenti.paziente";

    // Esecuzione query
    $ospedali = $conn->query($sql_S_ALL_Osp);
    $medici = $conn->query($sql_S_ALL_Med);
    $pazienti = $conn->query($sql_S_ALL_Paz);
    $appuntamenti = $conn->query($sql_S_ALL_App);
?>

<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="author" content="Giovanni Basso">
    <title>SIGO</title>
    <link rel="stylesheet" href="../style/style.css">
</head>
<body>
    <h1>SIGO</h1>
    <h2>Cerca Dati</h2>

    <form action="risultati.php" method="GET">
        <div>
            <label for="searchOspedale">Ospedale:</label>
            <input type="text" id="searchOspedale" name="ospedale">
        </div>
        <div>
            <label for="searchMedico">Medico (solo cognome):</label>
            <input type="text" id="searchMedico" name="medico">
        </div>
        <div>
            <label for="searchPaziente">Paziente (solo cognome):</label>
            <input type="text" id="searchPaziente" name="paziente">
        </div>
        <div>
            <label for="searchAppuntamento">Data Appuntamento:</label>
            <input type="date" id="searchAppuntamento" name="appuntamento">
        </div>
        <button type="submit">Cerca</button>
    </form>

    <footer>
        <a href="../index.html">Torna alla pagina principale</a>
    </footer>
</body>
</html>
