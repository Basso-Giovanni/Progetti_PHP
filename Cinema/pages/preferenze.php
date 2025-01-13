<?php
    include("../config/db.php");

    $query = "SELECT DISTINCT proiezioni.genere FROM proiezioni";
    $result = $conn->query($query);

    $generi = [];
    while ($row = $result->fetch_assoc()) 
    {
        $generi[] = $row['genere'];
    }

    if ($_SERVER['REQUEST_METHOD'] == 'POST') 
    {
        if (isset($_POST['generi'])) 
        {
            setcookie("preferenze_generi", json_encode($_POST['generi']), time() + (86400 * 30), "/", "", true, true);
        } 
        else 
        {
            setcookie("preferenze_generi", "", time() - 3600, "/", "", true, true);
        }
        header("Refresh:0");
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
    <h1>Scegli i tuoi generi preferiti</h1>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="POST"> <!-- Non va bene, devono essere presi dal DB !-->
        <?php
            if (!empty($generi)) 
            {
                foreach ($generi as $genere) 
                {
                    echo '<label>';
                    echo '<input type="checkbox" name="generi[]" value="' . htmlspecialchars($genere) . '"> ' . htmlspecialchars($genere);
                    echo '</label><br>';
                }
            } 
            else 
            {
                echo "<p>Non ci sono generi disponibili.</p>";
            }
        ?>
        <input type="submit" value="Salva Preferenze">
    </form>
    
    <?php
        if (isset($_COOKIE['preferenze_generi'])) 
        {
            $preferenze = json_decode($_COOKIE['preferenze_generi'], true);
            if (!empty($preferenze)) 
            {
                echo "<h2>I tuoi generi preferiti:</h2><ul>";
                foreach ($preferenze as $genere) 
                {
                    echo "<li>" . htmlspecialchars($genere) . "</li>";
                }
                echo "</ul>";
            } 
            else 
            {
                echo "<p>Non hai ancora selezionato nessun genere.</p>";
            }
        } 
        else 
        {
            echo "<p>Non hai ancora selezionato nessun genere.</p>";
        }
    ?>
    <a href="film.php">Vai alla lista dei film</a>
    <a href="../index.php">Esci</a>
</body>
<?php $conn->close();?>
</html>