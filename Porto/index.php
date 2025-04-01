<?php
$pdo = new PDO("mysql:host=localhost;dbname=porto;charset=utf8mb4", "root", "");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $azione = $_POST["azione"];
    
    switch ($azione) {
        case "arrivo_nave":
            $stmt = $pdo->prepare("CALL ArrivoNave(?, ?, ?)");
            $stmt->execute([$_POST["nome_nave"], $_POST["data_arrivo"], $_POST["data_partenza_prevista"]]);
            echo "Nave registrata con successo!";
            break;
        
        case "carico_scarico":
            $stmt = $pdo->prepare("CALL OperazioneCaricoScarico(?, ?, ?, ?)");
            $stmt->execute([$_POST["nome_nave"], $_POST["nome_prodotto"], $_POST["tipo_operazione"], $_POST["quantita"]]);
            echo "Operazione registrata con successo!";
            break;
        
        case "partenza_nave":
            $stmt = $pdo->prepare("CALL PartenzaNave(?, ?)");
            $stmt->execute([$_POST["nome_nave"], $_POST["data_partenza_effettiva"]]);
            echo "Partenza registrata con successo!";
            break;
    }
}
function mostraTabella($pdo, $tabella) {
    $stmt = $pdo->query("SELECT * FROM $tabella");
    $righe = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    echo "<h2>Tabella: $tabella</h2>";
    echo "<table border='1'><tr>";
    
    if (!empty($righe)) {
        foreach (array_keys($righe[0]) as $colonna) {
            echo "<th>$colonna</th>";
        }
        echo "</tr>";
        
        foreach ($righe as $riga) {
            echo "<tr>";
            foreach ($riga as $valore) {
                echo "<td>$valore</td>";
            }
            echo "</tr>";
        }
    } else {
        echo "<tr><td colspan='100%'>Nessun dato presente</td></tr>";
    }
    
    echo "</table>";
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Gestione Porto - Mare Nostrum</title>
</head>
<body>
    <h1>Gestione Porto "Mare Nostrum"</h1>
    
    <h2>Registrazione Arrivo Nave</h2>
    <form method="post">
        <input type="hidden" name="azione" value="arrivo_nave">
        Nome Nave: <input type="text" name="nome_nave" required><br>
        Data Arrivo: <input type="datetime-local" name="data_arrivo" required><br>
        Data Partenza Prevista: <input type="datetime-local" name="data_partenza_prevista" required><br>
        <button type="submit">Registra Arrivo</button>
    </form>
    
    <h2>Registrazione Operazione Carico/Scarico</h2>
    <form method="post">
        <input type="hidden" name="azione" value="carico_scarico">
        Nome Nave: <input type="text" name="nome_nave" required><br>
        Nome Prodotto: <input type="text" name="nome_prodotto" required><br>
        Tipo Operazione: 
        <select name="tipo_operazione">
            <option value="carico">Carico</option>
            <option value="scarico">Scarico</option>
        </select><br>
        Quantità: <input type="number" name="quantita" required><br>
        <button type="submit">Registra Operazione</button>
    </form>
    
    <h2>Registrazione Partenza Nave</h2>
    <form method="post">
        <input type="hidden" name="azione" value="partenza_nave">
        Nome Nave: <input type="text" name="nome_nave" required><br>
        Data Partenza Effettiva: <input type="datetime-local" name="data_partenza_effettiva" required><br>
        <button type="submit">Registra Partenza</button>
    </form>
    <h2>Visualizza Tabelle</h2>
    <form method="get">
        <select name="tabella">
            <option value="Navi">Navi</option>
            <option value="Prodotti">Prodotti</option>
            <option value="OperazioniCaricoScarico">Operazioni Carico/Scarico</option>
        </select>
        <button type="submit">Mostra</button>
    </form>
    
    <?php
    if (isset($_GET["tabella"])) {
        mostraTabella($pdo, $_GET["tabella"]);
    }
    ?>
</body>
</html>
