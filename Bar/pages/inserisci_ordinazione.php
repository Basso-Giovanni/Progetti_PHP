<?php
    include('../DB/config.php');

    if ($_SERVER['REQUEST_METHOD'] == 'POST') 
    {
        $prodotto_id = $_POST['prodotto'];
        $cameriere_id = $_POST['cameriere'];
        $quantita = $_POST['quantita'];
        $stato = "in attesa"; 

        $data_ora = date("Y-m-d H:i:s");

        $sql = "INSERT INTO Ordinazioni (IDProdotto, IDCameriere, Quantità, Stato, DataOra)
                VALUES ('$prodotto_id', '$cameriere_id', '$quantita', '$stato', '$data_ora')";

        if ($conn->query($sql) === TRUE)
            echo "Ordinazione inserita con successo!";
        else
            echo "Errore: " . $sql . "<br>" . $conn->error;
    }

    $prodotti = $conn->query("SELECT * FROM Prodotti");
    $camerieri = $conn->query("SELECT * FROM Camerieri");
?>

<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="author" content="Giovanni Basso">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../style/styles.css">
    <title>Inserisci Ordinazione</title>
</head>
<body>
    <h1>Inserisci Ordinazione</h1>

    <!-- Form per inserire una nuova ordinazione -->
    <form action="<?php htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="POST">
        <label for="prodotto">Prodotto:</label>
        <select name="prodotto" id="prodotto" required>

            <?php
                while ($row = $prodotti->fetch_assoc())
                {
                    echo "<option value='" . $row['IDProdotto'] . "'>" . $row['Nome'] . " - €" . $row['Prezzo'] . "</option>";
                }
            ?>
        </select>
        <br>

        <label for="cameriere">Cameriere:</label>
        <select name="cameriere" id="cameriere" required>

            <?php
                while ($row = $camerieri->fetch_assoc())
                {
                    echo "<option value='" . $row['IDCameriere'] . "'>" . $row['Nome'] . "</option>";
                }
            ?>
        </select>
        <br>

        <label for="quantita">Quantità:</label>
        <input type="number" name="quantita" id="quantita" min="1" value="1" required>
        <br>

        <button type="submit">Inserisci Ordinazione</button>
    </form>

    <br>
    <a href="../index.html">Torna alla Home</a>
</body>
</html>

<?php $conn->close(); ?>
