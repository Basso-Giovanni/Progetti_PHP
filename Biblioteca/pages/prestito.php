<?php
    session_start();
    require_once '../config/db.php';

    // Verifica che l'utente sia loggato
    if (!isset($_SESSION['user_id'])) 
    {
        header("Location: http://localhost/2024/biblioteca");
        exit();
    }

    $book_id = $_GET['book_id'];
    $user_id = $_SESSION['user_id'];

    // Ottieni i dettagli del libro
    $sql = "SELECT * FROM libri WHERE idLibro = '$book_id' AND disponibile = 1";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) 
    {
        $book = $result->fetch_assoc();
        
        // Aggiorna lo stato del libro a 'non disponibile'
        $sql = "UPDATE libri SET disponibile = 0 WHERE idLibro = '$book_id'";
        $conn->query($sql);
        
        // Aggiungi il prestito al database
        $data_prestito = date('Y-m-d');
        $data_scadenza = date('Y-m-d', strtotime('+30 days')); // Prestito di 30 giorni
        $sql = "INSERT INTO prestiti (codUtente, idLibro, dataPrestito, dataScadenza) VALUES ('$user_id', '$book_id', '$data_prestito', '$data_scadenza')";
        $conn->query($sql);
        
        echo "Il libro è stato preso in prestito. Data di scadenza: " . $data_scadenza;
    } 
    else 
    {
        echo "Il libro non è disponibile per il prestito.";
    }

    $conn->close();
?>

<!DOCTYPE html>
<html lang="it">
<head>
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="author" content="Giovanni Basso">
    <link rel="stylesheet" href="../style/style.css"> 
    <title>Biblioteca</title>
</head>
<body>
    <br>
    <a href="home.php">Torna alla homepage</a>
</body>
</html>