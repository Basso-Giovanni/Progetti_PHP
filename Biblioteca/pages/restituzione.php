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
?>
<head>
    <link rel="stylesheet" href="../style/style.css">
</head>
<br>
<a href="home.php">Torna alla homepage</a>