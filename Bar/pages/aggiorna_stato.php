<?php
    include('../DB/config.php');

    $id_ordinazione = $_GET['id'];

    $sql = "UPDATE Ordinazioni SET Stato = 'servito' WHERE IDOrdinazione = '$id_ordinazione'";

    if ($conn->query($sql) === TRUE) 
    {
        echo "Stato aggiornato con successo!";
    } 
    else 
    {
        echo "Errore: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
?>

<!DOCTYPE html>
<html lang="it">
    <head>
        <meta charset="UTF-8">
        <meta name="author" content="Giovanni Basso">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="../style/styles.css">
        <title>Gestore Ordinazioni</title>  
    </head>
    <body>
        <br><br>
        <a href="../index.html">Torna alla Home</a>
    </body>
</html>