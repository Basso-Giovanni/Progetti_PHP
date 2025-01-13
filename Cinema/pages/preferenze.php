<?php
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

<head>
    <title>Stelle e pellicole</title>
    <link rel="stylesheet" href="../style/style.css">
</head>
<body>
    <h1>Scegli i tuoi generi preferiti</h1>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="POST"> <!-- Non va bene, devono essere presi dal DB !-->
        <label>
            <input type="checkbox" name="generi[]" value="Azione"> Azione
        </label><br>
        <label>
            <input type="checkbox" name="generi[]" value="Commedia"> Commedia
        </label><br>
        <label>
            <input type="checkbox" name="generi[]" value="Drammatico"> Drammatico
        </label><br>
        <label>
            <input type="checkbox" name="generi[]" value="Fantasy"> Fantasy
        </label><br>
        <label>
            <input type="checkbox" name="generi[]" value="Horror"> Horror
        </label><br>
        <label>
            <input type="checkbox" name="generi[]" value="Thriller"> Thriller
        </label><br>
        <label>
            <input type="checkbox" name="generi[]" value="Romantico"> Romantico
        </label><br>
        <label>
            <input type="checkbox" name="generi[]" value="Fantascienza"> Fantascienza
        </label><br>
        <label>
            <input type="checkbox" name="generi[]" value="Dramma"> Dramma
        </label><br>
        <label>
            <input type="checkbox" name="generi[]" value="Storico"> Storico
        </label><br>
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
