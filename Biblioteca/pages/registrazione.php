<?php
    session_start();
    require_once '../config/db.php';

    if ($_SERVER['REQUEST_METHOD'] == 'POST') 
    {
        // Prendi i dati dal form
        $nome = $_POST['nome'];
        $cognome = $_POST['cognome'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        
        // Hashing della password
        $password_hash = password_hash($password, PASSWORD_DEFAULT);

        // Inserisci nel database
        $sql = "INSERT INTO utenti (nominativo, email, pass) VALUES ('$nome $cognome', '$email', '$password_hash')";
        
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
<head>
    <link rel="stylesheet" href="../style/style.css">
</head>
<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="POST">
    <label for="nome">Nome:</label><br>
    <input type="text" id="nome" name="nome" required><br>
    
    <label for="cognome">Cognome:</label><br>
    <input type="text" id="cognome" name="cognome" required><br>
    
    <label for="email">Email:</label><br>
    <input type="email" id="email" name="email" required><br>
    
    <label for="password">Password:</label><br>
    <input type="password" id="password" name="password" required><br>
    
    <input type="submit" value="Registrati">
</form>
