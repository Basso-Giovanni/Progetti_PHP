<?php
include('DB/config.php');

$id_ordinazione = $_GET['id'];

$sql = "UPDATE Ordinazioni SET Stato = 'servito' WHERE IDOrdinazione = '$id_ordinazione'";

if ($conn->query($sql) === TRUE) {
    echo "Stato aggiornato con successo!";
} else {
    echo "Errore: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>
<head>
    <link rel="stylesheet" href="style/styles.css">
</head>
<body>
    <br><br>
    <a href="index.php">Torna alla Home</a>
</body>
