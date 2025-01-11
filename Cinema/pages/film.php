<?php
    include('../config/db.php');

    if (!isset($_COOKIE['user_id'])) 
    {
        header("Location: ../index.php");
    }

    $preferenze = isset($_COOKIE['preferenze_generi']) ? json_decode($_COOKIE['preferenze_generi'], true) : [];

    $query = "SELECT * FROM proiezioni";
    if ($preferenze) 
    {
        $query .= " WHERE genere IN ('" . implode("','", $preferenze) . "')";
    }
    $result = $conn->query($query);
?>

<head>
    <link rel="stylesheet" href="../style/style.css"> 
    <title>Stelle e pellicole</title>
</head>
<body>
    <h1>Lista dei Film</h1>
    <ul>
        <?php
            while ($film = $result->fetch_assoc())
            {
                if ($film['postiDisponibili'] > 0)
                {
                    echo '<li>' . $film['titolo'] . ' - ' . $film['genere'] . ', ' . $film['orario'] . ' sala: ' . $film['sala'] . ', posti: ' . $film['postiDisponibili'];
                    echo ' - <a href="prenota.php?id=' . $film['IDProiezione'] . '">Prenota Posti</a></li>';
                }
            }
        ?>
    </ul>

    <a href="preferenze.php">Cambia le preferenze</a>
    <a href="../index.php">Esci</a>
</body>