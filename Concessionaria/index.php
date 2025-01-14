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
                $_SESSION['email'] = $user['email'];
                $_SESSION['nome'] = $user['nome'];

                header("Location: http://localhost/2024/concessionaria/pages/admin.php");
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

    $conn->close();
?>

<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="author" content="Giovanni Basso">
    <title>Motori Eccellenti</title>
    <link rel="stylesheet" href="style/style.css">
</head>
<body>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="POST">
        <label for="email">Email:</label><br>
        <input type="email" id="email" name="email" required><br>
        
        <label for="password">Password:</label><br>
        <input type="password" id="password" name="password" required><br>
        
        <input type="submit" value="Accedi">
        <a href="pages/signin.php">Registrati</a>
    </form>
    <a href="pages/home.php">Entra senza accedere</a>
</body>
</html>