<?php
    include('../config/db.php');

    if (!isset($_COOKIE['user_id'])) 
    {
        header("Location: ../index.php");
    }

    $proiezione_id = $_GET['id'];
    $sql = "SELECT * FROM proiezioni WHERE IDProiezione = $proiezione_id";
    $result = $conn->query($sql);
    $proiezione = $result->fetch_assoc();

    if ($_SERVER["REQUEST_METHOD"] == "POST") 
    {
        $posti = $_POST['posti'];
        
        if ($proiezione['postiDisponibili'] - $posti >= 0)
        {
            $query = "INSERT INTO prenotazioni (IDUtente, IDSpettacolo, postiPrenotati) VALUES ( " . $_COOKIE['user_id'] . ", $proiezione_id, $posti)";
            $result = $conn->query($query);

            $query = "UPDATE proiezioni SET postiDisponibili = postiDisponibili - $posti WHERE IDProiezione = $proiezione_id";
            $result = $conn->query($query);

            echo "Posti prenotati correttamente!";
        }
        else
        {
            echo "I posti selezionati non sono disponibili!";
        }
    }
    else
    {
        echo "<h1>Prenota Posti per la Proiezione: " . $proiezione['titolo'] . "</h1>
            <h3>Posti disponibili: " .  $proiezione['postiDisponibili'] . "</h3>
            <form method='POST' action='" . htmlspecialchars($_SERVER["PHP_SELF"]) . "'>
            <label>Seleziona i posti (max 10):</label><br>
            <input type='number' min=1 max=10 name='posti'><br>
            <input type='submit' value='Prenota'>
            </form>";
    }
?>

<head>
    <title>Stelle e pellicole</title>
    <link rel="stylesheet" href="../style/style.css">
</head>
<body>
    <a href="film.php">Vai alla lista dei film</a>
    <a href="../index.php">Esci</a>
</body>
