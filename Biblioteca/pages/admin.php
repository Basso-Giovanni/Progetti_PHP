<?php
    session_start();
    require_once '../config/db.php';

    // Verifica che l'utente sia Admin
    if ($_SESSION['ruolo'] != '1') 
    {
        echo "Accesso non autorizzato.";
        exit();
    }

    if ($_SERVER['REQUEST_METHOD'] == 'POST') 
    {
        // Ottieni i dati dal form
        $titolo = $_POST['titolo'];
        $autore = $_POST['autore'];
        $anno = $_POST['anno'];
        $genere = $_POST['genere'];

        // Aggiungi il libro al database
        $sql = 'INSERT INTO libri (titolo, autore, annoPubblicazione, genere, disponibile) VALUES ("$titolo", "$autore", "$anno", "$genere", 1)';
        
        if ($conn->query($sql) === TRUE) 
        {
            echo "Libro aggiunto con successo!";
        } 
        else 
        {
            echo "Errore: " . $conn->error;
        }
    }
?>
<head>
    <link rel="stylesheet" href="../style/style.css">
</head>
<h1>Aggiunta di un nuovo libro</h1>
<form action="admin.php" method="POST">
    <label for="titolo">Titolo:</label><br>
    <input type="text" id="titolo" name="titolo" required><br>
    
    <label for="autore">Autore:</label><br>
    <input type="text" id="autore" name="autore" required><br>
    
    <label for="anno">Anno di Pubblicazione:</label><br>
    <input type="number" id="anno" name="anno" required><br>
    
    <label for="genere">Genere:</label><br>
    <input type="text" id="genere" name="genere" required><br>
    
    <input type="submit" value="Aggiungi Libro">
</form>
<br>
<a href="../index.php">Esci</a>