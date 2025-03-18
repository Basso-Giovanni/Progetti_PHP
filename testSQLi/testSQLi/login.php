<?php 
    include 'config_pdo.php';

    if($_SERVER["REQUEST_METHOD"] == "POST"){ 
        if(login($_POST['username'], $_POST['password'])) {
            echo "SEI DENTROOOOO<br>";
        } 
        else{ 
            echo "Credenziali errate."; 
        } 
    } 
?>

<!DOCTYPE html>
<html lang="it"> 
<head> 
    <meta charset="UTF-8">
    <title>Login</title>
</head> 
<body> 
    <h2>Login</h2> 
    <form method="POST"> 
        <label for="username">Username:</label> 
        <input type="text" name="username"> <br> 
        <label for="password">Password:</label> 
        <input type="password" name="password" required> <br> 
        <input type="submit" value="Accedi"> 
    </form> 
    <p>Non hai un account? <a href="register.php">Registrati</a></p>
</body> 
</html>