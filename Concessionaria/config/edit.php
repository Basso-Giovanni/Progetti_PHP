<?php
    require 'db.php';
    session_start();

    if (!isset($_SESSION['email'])) 
    {
        header("Location: http://localhost/2024/concessionaria");
        exit();
    }

    if (isset($_GET['q']))
    {
        $id = $_GET['q'];

        $sql = 'SELECT * FROM automobili WHERE id = ' . $id;
        $result = $conn->query($sql);
    }

    if ($_SERVER['REQUEST_METHOD'] == 'POST') 
    {
        $idAuto = $_POST['idAuto'];
        $sql = 'UPDATE automobili SET id = ' . $idAuto;
        if (!empty($_POST['editMarca']))
        {
            $marca = $_POST['editMarca'];
            $sql .= ', marca = "' . $marca . '"';
        }
        if (!empty($_POST['editModello']))
        {
            $modello = $_POST['editModello'];
            $sql .= ', modello = "' . $modello . '"';
        }
        if (!empty($_POST['editAnno']))
        {
            $anno = $_POST['editAnno'];
            $sql .= ', annoProduzione = ' . $anno;
        }
        if (!empty($_POST['editPrezzo']))
        {
            $prezzo = $_POST['editPrezzo'];
            $sql .= ', prezzo = ' . $prezzo;
        }
        if (!empty($_POST['editColore']))
        {
            $colore = $_POST['editColore'];
            $sql .= ', colore = "' . $colore . '"';
        }
        if (!empty($_POST['editKM']) || $_POST['editKM'] == 0)
        {
            $km = $_POST['editKM'];
            $sql .= ', chilometraggio = ' . $km;
            if ($km == 0)
            {
                $sql .= ', stato = 1';
            }
            else
            {
                $sql .= ', stato = 0';
            }
        }

        $sql .= ' WHERE id = ' . $idAuto;

        if ($conn->query($sql))
        {
            echo "Auto aggiornata con successo. <a href='../pages/admin.php'>Torna alla home</a>";
        }
        else
        {
            echo "Errore nell'aggiornamento dell'auto";
        }
    }
    else
    {
        echo '<h1>Modifica</h1>';
        if ($row = $result->fetch_assoc())
        {
            echo '<table>
                <tr>
                    <th>Marca</th>
                    <th>Modello</th>
                    <th>Anno di produzione</th>
                    <th>Prezzo</th>
                    <th>Colore</th>
                    <th>Chilometraggio</th>
                </tr>
                <tr>
                    <td>' . $row['marca'] . '</td>
                    <td>' . $row['modello'] . '</td>
                    <td>' . $row['annoProduzione'] . '</td>
                    <td>' . $row['prezzo'] . '</td>
                    <td>' . $row['colore'] . '</td>
                    <td>' . $row['chilometraggio'] . '</td>
                </tr>';
        }

        echo '<h1>Modifica Automobili</h1>
            <form id="editForm" method="POST" action="' . htmlspecialchars($_SERVER["PHP_SELF"]) . '">
                <div class="form-group">
                    <label for="editMarca">Marca:</label>
                    <input type="text" id="editMarca" name="editMarca">
                </div>
                <div class="form-group">
                    <label for="editModello">Modello:</label>
                    <input type="text" id="editModello" name="editModello">
                </div>
                <div class="form-group">
                    <label for="editAnno">Anno di produzione:</label>
                    <input type="number" id="editAnno" name="editAnno" min="1900" max="2025">
                </div>
                <div class="form-group">
                    <label for="editPrezzo">Fascia di prezzo:</label>
                    <input type="number" id="editPrezzo" name="editPrezzo" step="1000">
                </div>
                <div class="form-group">
                    <label for="editColore">Colore:</label>
                    <input type="text" id="editColore" name="editColore">
                </div>
                <div class="form-group">
                    <label for="editKM">Chilometraggio (mettere 0 per indicare che il mezzo è nuovo):</label>
                    <input type="number" id="editKM" name="editKM" step="1000">
                </div>
                <input type="hidden" name="idAuto" value="' . $id . '">
                <input type="submit" name="submit" value="Aggiorna">
            </form>
            <br><a href="../pages/home.html">Torna alla home</a>';
    }
    
    $conn->close();
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
</html>