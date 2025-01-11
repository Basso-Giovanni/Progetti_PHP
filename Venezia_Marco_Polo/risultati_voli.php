<?php require 'config.php'; ?>
<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="author" content="Giovanni Basso">
    <title>Risultati Voli</title>
</head>
<body>
    <h1>Risultati della Ricerca</h1>
    <ul>
        <?php
        $origine = $_GET['aeroporto_part'];
        $destinazione = $_GET['aeroporto_arr'];
        $data = $_GET['DataViaggio'];
        
        echo $origine . " ". $destinazione;

        $query = "SELECT * FROM voli WHERE aeroporto_part = '" . $origine . "' AND aeroporto_arr = '" . $destinazione . "' AND DATE(data_partenza) = '" . $data . "';";        
        $result = $conn->query($query);

        if ($result->num_rows > 0)
        {
            while ($row = $result->fetch_assoc())
            {
                echo "<li>" . $row["id"] . " - Aeroporto di partenza: " . $row["aeroporto_part"] . " - Aeroporto di arrivo: " . $row["aeroporto_arr"] . " - Aereo: " . $row["aereo"] . " - Partenza: " . $row["data_partenza"] . " Arrivo: " . $row["data_arrivo"] . "</li>";
            }
        }
        else
        {
            echo "Nessun risultato!";
        }
        ?>
    </ul>
</body>
</html>
