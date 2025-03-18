<?php
    session_start();

    
    function register($username, $password)
    {
        try {
            $pdo = new PDO("mysql:host=localhost;dbname=login;charset=utf8mb4", "root", "");
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
            $username = htmlspecialchars($username);
            $password = password_hash(htmlspecialchars($password), PASSWORD_DEFAULT);
    
            $stmt = $pdo->prepare("CALL InserisciUtente(?, ?)");
            $stmt->execute([$username, $password]);
    
            return true;
        } 
        catch (PDOException $e) {
            echo "Errore: " . $e->getMessage();
            return false;
        }
    }
    
    function login($username, $password) {
        try {
            $pdo = new PDO("mysql:host=localhost;dbname=login;charset=utf8mb4", "root", "");
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
            // Prepariamo la stored procedure
            $stmt = $pdo->prepare("CALL SelectUtente(?)");
            $stmt->execute([$username]);
    
            // Otteniamo il risultato
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
    
            if ($row && password_verify($password, $row['password'])) {
                $_SESSION['activeUser'] = $row['email'];
                return true;
            }
    
            return false;
        } 
        catch (PDOException $e) {
            echo "Errore: " . $e->getMessage();
        }
    }
?>