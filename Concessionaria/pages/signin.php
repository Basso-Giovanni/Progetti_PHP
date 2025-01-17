<?php
    session_start();
    require_once '../config/db.php';

    if ($_SERVER['REQUEST_METHOD'] == 'POST') 
    {
        $nome = $_POST['nome'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        
        $password_hash = password_hash($password, PASSWORD_DEFAULT);

        $sql = 'INSERT INTO utenti (nome, email, pass) VALUES ("' . $nome . '", "' . $email . '", "' . $password_hash . '")';
        
        if ($conn->query($sql) === TRUE) 
        {
            echo "Registrazione avvenuta con successo! <a href='../index.php'>Accedi</a>";
        } 
        else 
        {
            echo "Errore: " . $sql . "<br>" . $conn->error;
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
    <link rel="stylesheet" href="../style/style.css"> 
    <title>Motori Eccellenti</title>
</head>
<body>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="POST">
        <label for="nome">Nome:</label><br>
        <input type="text" id="nome" name="nome" required><br>
        
        <label for="email">Email:</label><br>
        <input type="email" id="email" name="email" required><br>
        
        <label for="password">Password:</label><br>
        <input type="password" id="password" name="password" required><br>
        
        <input type="submit" value="Registrati">
    </form>
    <a href="../index.php">Torna al login</a>
</body>
</html>