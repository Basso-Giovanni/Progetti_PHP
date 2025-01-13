<?php require '../config/db.php'; ?>
<!DOCTYPE html>
<html lang="it">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="author" content="Giovanni Basso">
        <title>Elenco Dati</title>
    </head>
    <body>
        <h1>Informazioni</h1>
        <h2>Aeroporti</h2>
        <ul>
            <?php
                $query = "SELECT * FROM aeroporti";
                $result = $conn->query($query);

                if ($result->num_rows > 0)
                {
                    while ($row = $result->fetch_assoc())
                    {
                        echo "<li>" . $row["id"] . " - " . $row["nome"] . ", " . $row["citta"] . " " . $row["nazione"] . "</li>";
                    }
                }
                else
                {
                    echo "Nessun risultato!";
                }
            ?>
        </ul>

        <h2>Aerei</h2>
        <ul>
            <?php
                $query = "SELECT * FROM aerei";
                $result = $conn->query($query);

                if ($result->num_rows > 0)
                {
                    while ($row = $result->fetch_assoc())
                    {
                        echo "<li>" . $row["id"] . " - " . $row["modello"] . ", capacità: " . $row["capacita"] . "</li>";
                    }
                }
                else
                {
                    echo "Nessun risultato!";
                }
            ?>
        </ul>

        <h2>Voli</h2>
        <ul>
            <?php
                $query = "SELECT * FROM voli";
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
        <?php $conn->close(); ?>
    </body>
</html>