<?php
    $host = "localhost";
    $dbname = "bar";
    $username = "root";
    $password = "";

    $conn = new mysqli($host, $username, $password, $dbname);
    
    if ($conn->connect_error)
        die("Connessione fallita: " . $conn->connect_error);
?>