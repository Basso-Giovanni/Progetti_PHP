<?php
    require_once __DIR__ . "/nav.php";
    require_once __DIR__ . "/../private/database.php";
    
    $db = new Database();

    if ($_SEREVR['REQUEST_METHOD'] == "GET")
    {
        $viaggio = $db->getViaggio($_GET['id']);
    }
    
    $db->close();
?>

<!DOCTYPE html>
<html lang="it">
    <head>
        <meta charset="utf-8">
        <meta name="author" content="Giovanni Basso">
        <title>Car pooling</title>
    </head>
    <body>
        <h1>Dettagli viaggio</h1>
        <h3>Partenza <?php echo $viaggio['cittaP'] ?></h3>
        <h3>Destinazione <?php echo $viaggio['cittaD'] ?></h3>
        <h3>Data <?php echo $viaggio['data'] ?></h3>
        <h3>Costo <?php echo $viaggio['costo'] ?></h3>
        <h3>Tempo <?php echo $viaggio['tempo_medio'] ?></h3>
        <h3>Optional <?php echo $viaggio['optional'] ?></h3>
        <a href="user.php?id= <?php echo $viaggio['email'] ?> "><h3>Autista <?php echo $viaggio['email'] ?></h3></a>
        <a href="book.php?idV=" <?php echo $viaggio['idV'] ?>>Prenota</a>
    </body>
</html>