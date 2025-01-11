<?php
    session_start();
    require_once '../config/db.php';

    // Verifica che l'utente sia loggato
    if (!isset($_SESSION['user_id'])) 
    {
        header("Location: http://localhost/2024/biblioteca");
        exit();
    }

    $sql = "SELECT * FROM libri WHERE disponibile = 1";
    $result = $conn->query($sql);
?>

<h2>Libri Disponibili</h2>

<table>
    <tr>
        <th>Titolo</th>
        <th>Autore</th>
        <th>Anno</th>
        <th>Richiedi Prestito</th>
    </tr>

    <?php
        while ($row = $result->fetch_assoc())
        {
            $link = "prestito.php?book_id=" . $row['idLibro'];
            echo '<tr>' .
                '<td>' . $row['titolo'] . '</td>' .
                '<td>' . $row['autore'] . '</td>' .
                '<td>' . $row['annoPubblicazione'] . '</td>' .
                '<td><a href = ' . $link . '>Richiedi</a></td></tr>';

        }
    ?>
</table>
<head>
    <link rel="stylesheet" href="../style/style.css">
</head>