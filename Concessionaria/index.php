<?php
    session_start();
    require 'config/db.php';
    session_unset();

    if ($_SERVER['REQUEST_METHOD'] == 'POST') 
    {
        $email = $_POST['email'];
        $password = $_POST['password'];

        $sql = "SELECT * FROM utenti WHERE email='$email'";
        $result = $conn->query($sql);
        
        if ($result->num_rows > 0) 
        {
            $user = $result->fetch_assoc();
            
            if (password_verify($password, $user['pass'])) 
            {
                $_SESSION['email'] = $user['email'];

                session_regenerate_id();
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
    <a href="pages/home.html">Entra senza accedere</a>
</body>
</html>