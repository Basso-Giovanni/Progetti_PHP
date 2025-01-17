<?php
    require 'db.php';
    session_start();

    if (!isset($_SESSION['email'])) 
    {
        header("Location: http://localhost/2024/concessionaria");
        exit();
    }

    if (isset($_GET['q']))
    {
        $id = $_GET['q'];

        $sql = 'DELETE FROM automobili WHERE id = ' . $id;

        if ($conn->query($sql))
        {
            echo "Auto cancellata correttamente! <a href='../pages/admin.php'>Torna alla home</a>";
        }
        else
        {
            echo "Errore nella cancellazione dell'auto! <a href='../pages/admin.php'>Torna alla home</a>";
        }
    }

    $conn->close();
?>