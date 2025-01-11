<?php
    include('../../config/db.php');

    // Gestione inserimenti
    if ($_SERVER['REQUEST_METHOD'] === 'POST') 
    {
        if (isset($_POST['nome']) && isset($_POST['cognome']) && isset($_POST['indirizzo']) && isset($_POST['contatti']) && isset($_POST['condizioni'])) 
        {
            $nome = $_POST['nome'];
            $cognome = $_POST['cognome'];
            $indirizzo = $_POST['indirizzo'];
            $contatti = $_POST['contatti'];
            $condizioni = $_POST['condizioni'];

            $query = "INSERT INTO Pazienti (nome, cognome, indirizzo, contatti, condizioni) VALUES ('$nome', '$cognome', '$indirizzo', '$contatti', '$condizioni')";
            $conn->query($query);
            echo "Paziente inserito con successo.";

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

    <!-- Form per l'inserimento di pazienti -->
    <h2>Inserisci Paziente</h2>
    <form action="" method="POST">
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
    <footer>
        <a href="../inserimento.html">Torna alla pagina di inserimenti</a>
    </footer>
</body>
</html>
