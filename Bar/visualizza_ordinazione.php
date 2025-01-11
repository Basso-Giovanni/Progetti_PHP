<?php include('DB/config.php');

$sql = "SELECT Ordinazioni.*, Prodotti.Nome AS ProdottoNome, Camerieri.Nome AS CameriereNome
        FROM Ordinazioni
        INNER JOIN Prodotti ON Ordinazioni.IDProdotto = Prodotti.IDProdotto
        INNER JOIN Camerieri ON Ordinazioni.IDCameriere = Camerieri.IDCameriere";
$result = $conn->query($sql);

if (isset($_GET['stato'])) 
{
    $stato = $_GET['stato'];
    $sql .= " WHERE Stato = '$stato'";
    $result = $conn->query($sql);
}

echo "<table>";
echo "<tr><th>Prodotto</th><th>Cameriere</th><th>Quantità</th><th>Stato</th><th>Data/Ora</th><th>Azione</th></tr>";
while ($row = $result->fetch_assoc()) 
{
    echo "<tr>";
    echo "<td>" . $row['ProdottoNome'] . "</td>";
    echo "<td>" . $row['CameriereNome'] . "</td>";
    echo "<td>" . $row['Quantità'] . "</td>";
    echo "<td>" . $row['Stato'] . "</td>";
    echo "<td>" . $row['DataOra'] . "</td>";
    if ($row['Stato'] == 'servito') 
    {
        echo "<td>Stato Servito</td>"; 
    } 
    else 
    {
        echo "<td><a href='aggiorna_stato.php?id=" . $row['IDOrdinazione'] . "'>Aggiorna Stato</a></td>";
    }
    echo "</tr>";
}
echo "</table>";

$conn->close();
?>
<head>
    <link rel="stylesheet" href="style/styles.css">
</head>
<body>
<br><br>
<a href="index.php">Torna alla Home</a>
</body>
