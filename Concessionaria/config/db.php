<?php
    $host = "localhost";
    $dbname = "concessionaria";
    $username = "root";
    $password = "";

    $conn = new mysqli($host, $username, $password, $dbname);
    
    if ($conn->connect_error)
        die("Connessione fallita: " . $conn->connect_error);
?>