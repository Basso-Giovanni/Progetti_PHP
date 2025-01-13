<?php
    include('../config/db.php');

    if ($_SERVER["REQUEST_METHOD"] == "POST") 
    {
        $name = $_POST['name'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);
        
        $sql = "INSERT INTO utenti (nome, email, pass) VALUES ('$name', '$email', '$hashed_password')";
        if ($conn->query($sql) === TRUE) 
        {
            echo "Registrazione avvenuta con successo! <a href='../index.php'>Accedi</a>";
        } 
        else 
        {
            echo "Errore: " . $sql . "<br>" . $conn->error;
        }
    }
?>
<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="author" content="Giovanni Basso">
    <link rel="stylesheet" href="../style/style.css"> 
    <title>Cinema</title>
</head>
<body>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="POST">
        Nome: <input type="text" name="name" required><br>
        Email: <input type="email" name="email" required><br>
        Password: <input type="password" name="password" required><br>
        <input type="submit" value="Registrati">
    </form>
</body>
</html>