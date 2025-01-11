<?php
    session_start();
    require 'config/db.php';

    if ($_SERVER['REQUEST_METHOD'] == 'POST') 
    {
        // Ottieni i dati dal form
        $email = $_POST['email'];
        $password = $_POST['password'];

        // Recupera l'utente dal database
        $sql = "SELECT * FROM utenti WHERE email='$email'";
        $result = $conn->query($sql);
        
        if ($result->num_rows > 0) 
        {
            // L'utente esiste
            $user = $result->fetch_assoc();
            
            // Verifica la password
            if (password_verify($password, $user['pass'])) 
            {
                // Setta la sessione
                $_SESSION['user_id'] = $user['email'];
                $_SESSION['nome'] = $user['nominativo'];
                $_SESSION['ruolo'] = $user['stato'];

                if ($user['stato'] == 1)
                {
                    header("Location: http://localhost/2024/biblioteca/pages/admin.php");
                }
                else
                {
                    header("Location: http://localhost/2024/biblioteca/pages/home.php");
                }
                exit;
            } 
            else 
            {
                echo "Password errata.";
            }
        } 
        else 
        {
            echo "Email non trovata.";
        }
    }
?>
<head>
    <link rel="stylesheet" href="style/style.css">
</head>
<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="POST">
    <label for="email">Email:</label><br>
    <input type="email" id="email" name="email" required><br>
    
    <label for="password">Password:</label><br>
    <input type="password" id="password" name="password" required><br>
    
    <input type="submit" value="Accedi">
    <a href="pages/registrazione.php">Registrati</a>
</form>
