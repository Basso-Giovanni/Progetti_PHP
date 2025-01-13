<?php
    include('../config/db.php');

    // Gestione inserimenti
    if ($_SERVER['REQUEST_METHOD'] === 'POST') 
    {
        $action = $_POST['action']; // Determina l'azione specifica (ospedali, medici, pazienti, appuntamenti)

        if ($action === 'ospedali') 
        {
            $nome = $_POST['nome'];
            $indirizzo = $_POST['indirizzo'];
            $contatti = $_POST['contatti'];

            $query = "INSERT INTO Ospedali (nome, indirizzo, contatti) VALUES ($nome, $indirizzo, $contatti)";
            $conn->query($query);
            echo "Ospedale inserito con successo.";
        }

        if ($action === 'medici') 
        {
            $nome = $_POST['nome'];
            $cognome = $_POST['cognome'];
            $specializzazione = $_POST['specializzazione'];
            $ospedale_id = $_POST['ospedale'];

            $query = "INSERT INTO Medici (nome, cognome, specializzazione, ospedale) VALUES ($nome, $cognome, $specializzazione, $ospedale_id)";
            $conn->query($query);
            echo "Medico inserito con successo.";
        }

        if ($action === 'pazienti') 
        {
            $nome = $_POST['nome'];
            $cognome = $_POST['cognome'];
            $indirizzo = $_POST['indirizzo'];
            $contatti = $_POST['contatti'];
            $condizioni = $_POST['condizioni'];

            $stmt = "INSERT INTO Pazienti (nome, cognome, indirizzo, contatti, condizioni) VALUES ($nome, $cognome, $indirizzo, $contatti, $condizioni)";
            $conn->query($query);
            echo "Paziente inserito con successo.";
        }

        if ($action === 'appuntamenti') 
        {
            $paziente_id = $_POST['paziente'];
            $medico_id = $_POST['medico'];
            $data_ora = $_POST['data_ora'];
            $stato = $_POST['stato'];

            $stmt = "INSERT INTO Appuntamenti (paziente, medico, data_ora, stato) VALUES ($paziente_id, $medico_id, $data_ora, $stato)";
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
    <title>Inserimento Dati</title>
</head>
<body>
    <h1>Inserimento Dati</h1>

    <!-- Form per l'inserimento di ospedali -->
    <h2>Inserisci Ospedale</h2>
    <form action="<?php htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="POST">
        <input type="hidden" name="action" value="ospedali">
        <label for="nome">Nome:</label>
        <input type="text" id="nome" name="nome" required>
        <label for="indirizzo">Indirizzo:</label>
        <input type="text" id="indirizzo" name="indirizzo" required>
        <label for="contatti">Contatti:</label>
        <input type="text" id="contatti" name="contatti" required>
        <button type="submit">Inserisci</button>
    </form>

    <!-- Form per l'inserimento di medici -->
    <h2>Inserisci Medico</h2>
    <form action="<?php htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="POST">
        <input type="hidden" name="action" value="medici">
        <label for="nome">Nome:</label>
        <input type="text" id="nome" name="nome" required>
        <label for="cognome">Cognome:</label>
        <input type="text" id="cognome" name="cognome" required>
        <label for="specializzazione">Specializzazione:</label>
        <input type="text" id="specializzazione" name="specializzazione" required>
        <label for="ospedale">Ospedale:</label>
        <select id="ospedale" name="ospedale">
            <?php
                // Popola la dropdown con gli ospedali
                $ospedali = $conn->query("SELECT id, nome FROM Ospedali");
                while ($ospedale = $ospedali->fetch_assoc()) 
                {
                    echo "<option value='{$ospedale['id']}'>{$ospedale['nome']}</option>";
                }
            ?>
        </select>
        <button type="submit">Inserisci</button>
    </form>

    <!-- Form per l'inserimento di pazienti -->
    <h2>Inserisci Paziente</h2>
    <form action="<?php htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="POST">
        <input type="hidden" name="action" value="pazienti">
        <label for="nome">Nome:</label>
        <input type="text" id="nome" name="nome" required>
        <label for="cognome">Cognome:</label>
        <input type="text" id="cognome" name="cognome" required>
        <label for="indirizzo">Indirizzo:</label>
        <input type="text" id="indirizzo" name="indirizzo" required>
        <label for="contatti">Contatti:</label>
        <input type="text" id="contatti" name="contatti" required>
        <label for="condizioni">Condizioni mediche:</label>
        <textarea id="condizioni" name="condizioni" required></textarea>
        <button type="submit">Inserisci</button>
    </form>

    <!-- Form per l'inserimento di appuntamenti -->
    <h2>Inserisci Appuntamento</h2>
    <form action="<?php htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="POST">
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
        <label for="stato">Stato:</label>
        <select id="stato" name="stato">
            <option value="confermato">Confermato</option>
            <option value="cancellato">Cancellato</option>
        </select>
        <button type="submit">Inserisci</button>
    </form>
</body>
<?php $conn->close();?>
</html>
