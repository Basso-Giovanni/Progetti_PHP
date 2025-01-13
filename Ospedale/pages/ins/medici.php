<?php
    include('../../config/db.php');

    // Gestione inserimenti
    if ($_SERVER['REQUEST_METHOD'] === 'POST') 
    {
        if (isset($_POST['nome']) && isset($_POST['cognome']) && isset($_POST['specializzazione']) && isset($_POST['ospedale'])) 
        {
            $nome = $_POST['nome'];
            $cognome = $_POST['cognome'];
            $specializzazione = $_POST['specializzazione'];
            $ospedale_id = $_POST['ospedale'];

            $query = "INSERT INTO Medici (nome, cognome, specializzazione, ospedale) VALUES ('$nome', '$cognome', '$specializzazione', $ospedale_id)";
            $conn->query($query);
            echo "Medico inserito con successo.";
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
    <footer>
        <a href="../inserimento.html">Torna alla pagina di inserimenti</a>
    </footer>
</body>
<?php $conn->close();?>
</html>
