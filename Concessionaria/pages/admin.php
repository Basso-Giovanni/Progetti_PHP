<?php
    session_start();
    require '../config/db.php';
    
    if (!isset($_SESSION['email'])) 
    {
        header("Location: http://localhost/2024/concessionaria");
        exit();
    }

    if ($_SERVER['REQUEST_METHOD'] == 'POST') 
    {
        $marca = $_POST['addMarca'];
        $modello = $_POST['addModello'];
        $anno = $_POST['addAnno'];
        $prezzo = $_POST['addPrezzo'];
        $colore = $_POST['addColore'];
        $km = $_POST['addKM'];
        $stato = 0;
        if ($km == '0')
        {
            $stato = 1;
        }
        
        $sql = 'INSERT INTO automobili (marca, modello, annoProduzione, prezzo, chilometraggio, colore, stato) VALUES ("' . $marca . '", "' . $modello . '", ' . $anno . ', ' . $prezzo . ', ' . $km . ', "' . $colore . '", "' . $stato . '")';
        
        if ($conn->query($sql) === TRUE) 
        {
            echo "Automobile registrata con successo!";
        } 
        else 
        {
            echo "Errore: " . $sql . "<br>" . $conn->error;
        }
    }
    $conn->close();
    require '../config/download.php'; //per aggiornare il file xml
?>

<!DOCTYPE html>
<html lang="it">
<head>
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="author" content="Giovanni Basso">
    <title>Motori Eccellenti</title>
    <link rel="stylesheet" href="../style/style.css">
</head>
<body>
    <h1>Aggiunta Automobili</h1>
    <form id="addForm" method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
        <div class="form-group">
            <label for="addMarca">Marca:</label>
            <input type="text" id="addMarca" name="addMarca">
        </div>
        <div class="form-group">
            <label for="addModello">Modello:</label>
            <input type="text" id="addModello" name="addModello">
        </div>
        <div class="form-group">
            <label for="addAnno">Anno di produzione:</label>
            <input type="number" id="addAnno" name="addAnno" min="1900" max="2025">
        </div>
        <div class="form-group">
            <label for="addPrezzo">Fascia di prezzo:</label>
            <input type="number" id="addPrezzo" name="addPrezzo" step="1000">
        </div>
        <div class="form-group">
            <label for="addColore">Colore:</label>
            <input type="text" id="addColore" name="addColore">
        </div>
        <div class="form-group">
            <label for="addKM">Chilometraggio (mettere 0 per indicare che il mezzo è nuovo):</label>
            <input type="number" id="addKM" name="addKM" step="1000">
        </div>
        <input type="submit" name="submit" value="Aggiungi">
    </form>

    <h1>Ricerca Automobili</h1>
    <form id="searchForm">
        <div class="form-group">
            <label for="marca">Marca:</label>
            <input type="text" id="marca" name="marca" onkeyup="Search()">
        </div>
        <div class="form-group">
            <label for="modello">Modello:</label>
            <input type="text" id="modello" name="modello" onkeyup="Search()">
        </div>
        <div class="form-group">
            <label for="annoDa">Anno di produzione (da):</label>
            <input type="number" id="annoDa" name="annoDa" min="1900" max="2025" onkeyup="Search()">
        </div>
        <div class="form-group">
            <label for="annoA">Anno di produzione (a):</label>
            <input type="number" id="annoA" name="annoA" min="1900" max="2025" onkeyup="Search()">
        </div>
        <div class="form-group">
            <label for="prezzoMin">Fascia di prezzo (min):</label>
            <input type="number" id="prezzoMin" name="prezzoMin" step="1000" onkeyup="Search()">
        </div>
        <div class="form-group">
            <label for="prezzoMax">Fascia di prezzo (max):</label>
            <input type="number" id="prezzoMax" name="prezzoMax" step="1000" onkeyup="Search()">
        </div>
    </form>

    <h2>Risultati della ricerca</h2>
    <div id="results">
    </div>
    <br>
    <a href="../index.php">Esci</a>
    <script src="../script/ricerca.js"></script>
    <script>
        document.addEventListener("DOMContentLoaded", function() { Search(); });
    </script>
</body>
</html>