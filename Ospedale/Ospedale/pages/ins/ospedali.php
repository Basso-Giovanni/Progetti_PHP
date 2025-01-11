<?php
    include('../../config/db.php');

    // Gestione inserimenti
    if ($_SERVER['REQUEST_METHOD'] === 'POST') 
    {
        if (isset($_POST['nome']) && isset($_POST['indirizzo']) && isset($_POST['contatti'])) 
        {
            $nome = $_POST['nome'];
            $indirizzo = $_POST['indirizzo'];
            $contatti = $_POST['contatti'];

            $query = "INSERT INTO Ospedali (nome, indirizzo, contatti) VALUES ('$nome', '$indirizzo', '$contatti')";
            $conn->query($query);
            echo "Ospedale inserito con successo.";
        }
    }
?>

<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="../../style/style.css">
    <meta name="author" content="Giovanni Basso">
    <title>Inserimento Dati</title>
</head>
<body>
    <h1>Inserimento Dati</h1>

    <!-- Form per l'inserimento di ospedali -->
    <h2>Inserisci Ospedale</h2>
    <form action="" method="POST">
        <input type="hidden" name="action" value="ospedali">
        <label for="nome">Nome:</label>
        <input type="text" id="nome" name="nome" required>
        <label for="indirizzo">Indirizzo:</label>
        <input type="text" id="indirizzo" name="indirizzo" required>
        <label for="contatti">Contatti:</label>
        <input type="text" id="contatti" name="contatti" required>
        <button type="submit">Inserisci</button>
    </form>
    <footer>
        <a href="../inserimento.html">Torna alla pagina di inserimenti</a>
    </footer>
</body>
</html>
