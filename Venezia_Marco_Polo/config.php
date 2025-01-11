<?php
    $host = "localhost";
    $dbname = "venezia_marco_polo";
    $username = "root";
    $password = "";

    $conn = new mysqli($host, $username, $password, $dbname);
    
    if ($conn->connect_error)
        die("Connessione fallita: " . $conn->connect_error);
    else echo "Connessione eseguita!"
?>