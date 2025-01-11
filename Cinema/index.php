<?php
    include('config/db.php');
    setcookie("user_email", "", time() - 3600, "/", "", true, true);
    setcookie("user_id", "", time() - 3600, "/", "", true, true);
    setcookie("user_nome", "", time() - 3600, "/", "", true, true);
    setcookie("preferenze_generi", "", time() - 3600, "/", "", true, true);

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
                setcookie("user_email", $user['email'], time() + (86400 * 30), "/", "", true, true); // Email
                setcookie("user_id", $user['IDUtente'], time() + (86400 * 30), "/", "", true, true); // ID
                setcookie("user_nome", $user['nominativo'], time() + (86400 * 30), "/", "", true, true); // Nome
                header("Location: http://localhost/2024/Cinema/pages/preferenze.php");
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
    <title>Stelle e pellicole</title>
</head>
<body>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="POST">
        <label for="email">Email:</label><br>
        <input type="email" id="email" name="email" required><br>
        
        <label for="password">Password:</label><br>
        <input type="password" id="password" name="password" required><br>
        
        <input type="submit" value="Accedi">
        <a href="pages/registrazione.php">Registrati</a>
    </form>
</body>