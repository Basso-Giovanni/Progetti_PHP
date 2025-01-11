<?php
    session_start();
    require_once '../config/db.php';

    // Verifica che l'utente sia loggato
    if (!isset($_SESSION['user_id'])) 
    {
        header("Location: http://localhost/2024/biblioteca");
        exit();
    }

    $sql = "SELECT * FROM prestiti INNER JOIN libri ON libri.idLibro = prestiti.idLibro WHERE codUtente = '" . $_SESSION['user_id'] . "'";
    $result = $conn->query($sql);
?>

<h1>Ciao, <?php echo $_SESSION['nome']; ?>! Benvenuto nella tua area.</h1>
<h2>Libri presi in prestito</h2>

<table>
    <tr>
        <th>ID</th>
        <th>Titolo</th>
        <th>Autore</th>
        <th>Anno</th>
        <th>Data prestito</th>
        <th>Data scadenza</th>
        <th>Restituisci</th>
    </tr>

    <?php
        while ($row = $result->fetch_assoc())
        {
            // Formatta la data usando DateTime
            $dataPrestito = (new DateTime($row['dataPrestito']))->format('d/m/Y');
            $dataScadenza = (new DateTime($row['dataScadenza']))->format('d/m/Y');
            $link = "restituzione.php?book_id=" . $row['idLibro'];

            // Controlla se la data di scadenza è imminente o passata
            $dataScadenzaOriginale = new DateTime($row['dataScadenza']);
            $oggi = new DateTime();
            $classWarning = $dataScadenzaOriginale <= $oggi ? 'warning' : '';

            echo '<tr class="' . $classWarning . '">' .
                '<td>' . $row['idPrestito'] . '</td>' .
                '<td>' . $row['titolo'] . '</td>' .
                '<td>' . $row['autore'] . '</td>' .
                '<td>' . $row['annoPubblicazione'] . '</td>' .
                '<td>' . $dataPrestito . '</td>' .
                '<td>' . $dataScadenza . '</td>' .
                '<td><a href=' . $link . '>Restituisci</a></td>' .
                '</tr>';

        }
    ?>
</table>
<head>
    <link rel="stylesheet" href="../style/style.css">
</head>
<a href="libri.php">Richiedi un nuovo libro</a>
<br>
<a href="../index.php">Esci</a>
