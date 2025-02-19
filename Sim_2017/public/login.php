<?php 
    require_once __DIR__ . "/nav.php";
    require_once __DIR__ . "/../private/database.php";
    
?>

<!DOCTYPE html>
<html lang="it">
    <head>
        <meta charset="utf-8">
        <meta name="author" content="Giovanni Basso">
        <link rel="stylesheet" href="../style/style.css">
    </head>
    <body>
        <h1>Car pooling</h1>
        <h2>Login</h2>
        <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">

        </form>
    </body>
</html>