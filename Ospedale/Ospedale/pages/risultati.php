<?php
    include('../config/db.php');

    $ospedale = isset($_GET['ospedale']) ? $_GET['ospedale'] : '';
    $medico = isset($_GET['medico']) ? $_GET['medico'] : '';
    $paziente = isset($_GET['paziente']) ? $_GET['paziente'] : '';
    $appuntamento = isset($_GET['appuntamento']) ? $_GET['appuntamento'] : '';

    $query = "
        SELECT Appuntamenti.*, Pazienti.nome AS P_nome, Pazienti.cognome AS P_cognome, Medici.nome AS M_nome, Medici.cognome AS M_cognome
        FROM Appuntamenti
        INNER JOIN Medici ON Appuntamenti.medico = Medici.ID
        INNER JOIN Pazienti ON Pazienti.ID = Appuntamenti.paziente
        WHERE 1=1
    "; //questo WHERE 1=1 serve solo per poter concatenare usando gli AND

    // Filtriamo in base ai parametri
    if (!empty($ospedale)) 
    {
        $query .= " AND Medici.ospedale IN 
        (SELECT ID 
        FROM Ospedali 
        WHERE nome LIKE '%" . $conn->real_escape_string($ospedale) . "%')";
    }
    if (!empty($medico)) 
    {
        $query .= " AND (Medici.nome LIKE '%" . $conn->real_escape_string($medico) . "%' OR Medici.cognome LIKE '%" . $conn->real_escape_string($medico) . "%')";
    }
    if (!empty($paziente)) 
    {
        $query .= " AND (Pazienti.nome LIKE '%" . $conn->real_escape_string($paziente) . "%' OR Pazienti.cognome LIKE '%" . $conn->real_escape_string($paziente) . "%')";
    }
    if (!empty($appuntamento)) 
    {
        $query .= " AND DATE(Appuntamenti.data_ora) = '" . $conn->real_escape_string($appuntamento) . "'";
    }

    $result = $conn->query($query);

    // Logica per aggiornare lo stato
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['appuntamento_id']) && isset($_POST['stato'])) 
    {
        $appuntamento_id = $_POST['appuntamento_id'];
        $new_stato = $_POST['stato'];

        // Prevenzione da SQL injection
        $appuntamento_id = $conn->real_escape_string($appuntamento_id);
        $new_stato = $conn->real_escape_string($new_stato);

        $update_query = "UPDATE Appuntamenti SET stato = '$new_stato' WHERE ID = '$appuntamento_id'";

        if ($conn->query($update_query) === TRUE) 
        {
            echo "<p>Stato aggiornato con successo!</p>";
        } else 
        {
            echo "<p>Errore durante l'aggiornamento dello stato: " . $conn->error . "</p>";
        }
    }
?>

<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="author" content="Giovanni Basso">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../style/style.css">
    <title>Risultati Ricerca</title>
</head>
<body>
    <h1>Risultati della ricerca</h1>

    <?php 
    if ($result && $result->num_rows > 0): ?>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Paziente</th>
                    <th>Medico</th>
                    <th>Data e Ora</th>
                    <th>Stato</th>
                    <th>Modifica Stato</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = $result->fetch_assoc()): ?>
                    <tr>
                        <td><?= $row['ID'] ?></td>
                        <td><?= $row['P_cognome'] . " " . $row['P_nome'] ?></td>
                        <td>Dr. <?= $row['M_cognome'] . " " . $row['M_nome'] ?></td>
                        <td><?= $row['data_ora'] ?></td>
                        <td><?= $row['stato'] ?></td>
                        <td>
                            <!-- Form per modificare lo stato dell'appuntamento -->
                            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="POST">
                                <input type="hidden" name="appuntamento_id" value="<?= $row['ID'] ?>">
                                <select name="stato">
                                    <option value="in_attesa" <?= $row['stato'] == 'in_attesa' ? 'selected' : '' ?>>In Attesa</option>
                                    <option value="confermato" <?= $row['stato'] == 'confermato' ? 'selected' : '' ?>>Confermato</option>
                                    <option value="cancellato" <?= $row['stato'] == 'cancellato' ? 'selected' : '' ?>>Cancellato</option>
                                </select>
                                <button type="submit">Modifica</button>
                            </form>
                        </td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    <?php else: ?>
        <p>Nessun risultato trovato.</p>
    <?php endif; ?>

    <a href="ricerca.php">Torna alla pagina principale</a>
</body>
</html>
