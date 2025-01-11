<?php
    include('../../config/db.php');

    // Gestione inserimenti
    if ($_SERVER['REQUEST_METHOD'] === 'POST') 
    {
        if (isset($_POST['paziente']) && isset($_POST['medico']) && isset($_POST['data_ora']) && isset($_POST['stato'])) 
        {
            $paziente_id = $_POST['paziente'];
            $medico_id = $_POST['medico'];
            $data_ora = $_POST['data_ora'];
            $stato = $_POST['stato'];

            $query = "INSERT INTO Appuntamenti (paziente, medico, data_ora) VALUES ($paziente_id, $medico_id, '$data_ora')";
            $conn->query($query);
            echo "Appuntamento inserito con successo.";
        }
    }
?>

<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="author" content="Giovanni Basso">
    <link rel="stylesheet" href="../../style/style.css">
    <title>Inserimento Dati</title>
</head>
<body>
    <h1>Inserimento Dati</h1>

    <!-- Form per l'inserimento di appuntamenti -->
    <h2>Inserisci Appuntamento</h2>
    <form action="" method="POST">
        <input type="hidden" name="action" value="appuntamenti">
        <label for="paziente">Paziente:</label>
        <select id="paziente" name="paziente">
            <?php
                // Popola la dropdown con i pazienti
                $pazienti = $conn->query("SELECT id, nome, cognome FROM Pazienti");
                while ($paziente = $pazienti->fetch_assoc()) 
                {
                    echo "<option value='{$paziente['id']}'>{$paziente['nome']} {$paziente['cognome']}</option>";
                }
            ?>
        </select>
        <label for="medico">Medico:</label>
        <select id="medico" name="medico">
            <?php
                // Popola la dropdown con i medici
                $medici = $conn->query("SELECT id, nome, cognome FROM Medici");
                while ($medico = $medici->fetch_assoc()) 
                {
                    echo "<option value='{$medico['id']}'>Dr. {$medico['nome']} {$medico['cognome']}</option>";
                }
            ?>
        </select>
        <label for="data_ora">Data e Ora:</label>
        <input type="datetime-local" id="data_ora" name="data_ora" required>
        <button type="submit">Inserisci</button>
    </form>
    <footer>
        <a href="../inserimento.html">Torna alla pagina di inserimenti</a>
    </footer>
</body>
</html>
