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
    $sql = "SELECT * FROM libri WHERE idLibro = '$book_id' AND disponibile = 0";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) 
    {
        $book = $result->fetch_assoc();
        
        $sql = "UPDATE libri SET disponibile = 1 WHERE idLibro = '$book_id'";
        $conn->query($sql);
        
        $sql = "DELETE FROM prestiti WHERE idLibro = '$book_id'";
        $conn->query($sql);
        
        echo "Il libro è stato restituito!";
    } 
    else 
    {
        echo "Errore nella restituzione del libro!";
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