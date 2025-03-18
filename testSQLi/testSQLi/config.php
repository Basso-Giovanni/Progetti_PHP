<?php
    session_start();

    $conn = new mysqli('localhost', 'root', '', 'login');

    if($conn->connect_error){
        die("Connessione fallita: " . $conn->connect_error);
    }

    function register($conn, $username, $password){
        $username = htmlspecialchars($username);
        $password = password_hash(htmlspecialchars($password), PASSWORD_BCRYPT);

        $query = $conn->prepare("INSERT INTO utenti (email, password) VALUES (?, ?)");
        $query->bind_param('ss', $username, $password);

        return $query->execute();
    }

    function login($conn, $username, $password){
        $username = htmlspecialchars($username);
        
        $query = $conn->prepare("SELECT * FROM utenti WHERE email = ?");
        $query->bind_param('s', $username);
        $query->execute();
        $result = $query->get_result();
        
        if($result->num_rows > 0){
            $row = $result->fetch_assoc();

            if(password_verify($password, $row['password'])){
                $_SESSION['activeUser'] = $row['email'];
                return true;
            }
        }
        
        return false;
    }
?>