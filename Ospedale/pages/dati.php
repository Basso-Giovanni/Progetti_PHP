<?php
    include('../config/db.php');

    // Query di SELECT
    $sql_S_ALL_Osp = "SELECT * FROM Ospedali";
    $sql_S_ALL_Med = "SELECT Medici.*, Ospedali.nome AS osp_nome FROM Medici INNER JOIN Ospedali ON Medici.ospedale = Ospedali.ID";
    $sql_S_ALL_Paz = "SELECT * FROM Pazienti";
    $sql_S_ALL_App = "SELECT Appuntamenti.*, Pazienti.nome AS P_nome, Pazienti.cognome AS P_cognome, Medici.nome AS M_nome, Medici.cognome AS M_cognome, Appuntamenti.stato FROM Appuntamenti INNER JOIN Medici ON Appuntamenti.medico = Medici.ID INNER JOIN Pazienti ON Pazienti.ID = Appuntamenti.paziente";

    // Esecuzione delle query
    $ospedali = $conn->query($sql_S_ALL_Osp);
    $medici = $conn->query($sql_S_ALL_Med);
    $pazienti = $conn->query($sql_S_ALL_Paz);
    $appuntamenti = $conn->query($sql_S_ALL_App);

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
        } 
        else 
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
        <title>SIGO</title>
        <link rel="stylesheet" href="../style/style.css">
    </head>
    <body>
        <h1>SIGO</h1>

        <!-- Sezione Ospedali -->
        <h2>Ospedali</h2>
        <table>
            <thead>
                <tr>
                    <th>Nome</th>
                    <th>Indirizzo</th>
                    <th>Contatti</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    while ($row = $ospedali->fetch_assoc()) 
                    {
                        echo "<tr>
                                <td>" . $row['nome'] . "</td>
                                <td>" . $row['indirizzo'] . "</td>
                                <td>" . $row['contatti'] . "</td>
                            </tr>";
                    }
                ?>
            </tbody>
        </table>

        <!-- Sezione Medici -->
        <h2>Medici</h2>
        <table>
            <thead>
                <tr>
                    <th>Nome</th>
                    <th>Cognome</th>
                    <th>Specializzazione</th>
                    <th>Ospedale</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    while ($row = $medici->fetch_assoc()) {
                        echo "<tr>
                                <td>" . $row['nome'] . "</td>
                                <td>" . $row['cognome'] . "</td>
                                <td>" . $row['specializzazione'] . "</td>
                                <td>" . $row['osp_nome'] . "</td>
                            </tr>";
                    }
                ?>
            </tbody>
        </table>

        <!-- Sezione Pazienti -->
        <h2>Pazienti</h2>
        <table>
            <thead>
                <tr>
                    <th>Nome</th>
                    <th>Cognome</th>
                    <th>Indirizzo</th>
                    <th>Contatti</th>
                    <th>Condizioni</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    while ($row = $pazienti->fetch_assoc()) {
                        echo "<tr>
                                <td>" . $row['nome'] . "</td>
                                <td>" . $row['cognome'] . "</td>
                                <td>" . $row['indirizzo'] . "</td>
                                <td>" . $row['contatti'] . "</td>
                                <td>" . $row['condizioni'] . "</td>
                            </tr>";
                    }
                ?>
            </tbody>
        </table>

        <!-- Sezione Appuntamenti -->
        <h2>Appuntamenti</h2>
        <table>
            <thead>
                <tr>
                    <th>Paziente</th>
                    <th>Medico</th>
                    <th>Data e Ora</th>
                    <th>Stato</th>
                    <th>Modifica Stato</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    while ($row = $appuntamenti->fetch_assoc()) {
                        echo "<tr>
                                <td>" . $row['P_cognome'] . " " . $row['P_nome'] . "</td>
                                <td>Dr. " . $row['M_cognome'] . " " . $row['M_nome'] . "</td>
                                <td>" . $row['data_ora'] . "</td>
                                <td>" . $row['stato'] . "</td>
                                <td>
                                    <form action='" . htmlspecialchars($_SERVER["PHP_SELF"]) . "' method='POST'>
                                        <input type='hidden' name='appuntamento_id' value='" . $row['ID'] . "'>
                                        <select name='stato'>
                                            <option value='in_attesa' " . ($row['stato'] == 'in_attesa' ? 'selected' : '') . ">In Attesa</option>
                                            <option value='confermato' " . ($row['stato'] == 'confermato' ? 'selected' : '') . ">Confermato</option>
                                            <option value='cancellato' " . ($row['stato'] == 'cancellato' ? 'selected' : '') . ">Cancellato</option>
                                        </select>
                                        <button type='submit'>Aggiorna</button>
                                    </form>
                                </td>
                            </tr>";
                    }
                ?>
            </tbody>
        </table>
    </body>
    <?php $conn->close(); ?>
</html>