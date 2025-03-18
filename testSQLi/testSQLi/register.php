<?php 
    include 'config_pdo.php';

    if($_SERVER["REQUEST_METHOD"] == "POST"){ 
        if(register($_POST['username'], $_POST['password'])){
            echo "Registrazione avvenuta con successo. <a href='login.php'>Accedi</a>";
        }
        else{
            echo "Errore nella registrazione.";
        }
    }

?>

<!DOCTYPE html>
<html lang="it"> 
<head> 
    <meta charset="UTF-8">
    <title>Registrazione</title>
</head> 
<body> 
    <h2>Registrazione</h2> 
    <form method="POST"> 
        <label for="username">Username:</label> 
        <input type="text" name="username" required> <br> 
        <label for="password">Password:</label> 
        <input type="password" name="password" required> <br> 
        <input type="submit" value="Registrati"> 
    </form> 
</body> 
</html>