<?php 
    require_once __DIR__ . "/nav.php";
    require_once __DIR__ . "/../private/database.php";

    $db = new Database();
    
    if ($_SERVER['REQUEST_METHOD'] == "post")
    {
        if (isset($_POST['addSosta']))
        {
            $_SESSION['soste'] .= $_POST['soste'] . ",";
        }
        elseif (isset($_POST['viaggio']))
        {
            $db->insertViaggio($_POST['partenza'], $_POST['arrivo'], $_POST['data'], $_POST['costo'], $_POST['tempo'], $_POST['opt'], $_SESSION['soste']);
            echo "Viaggio registrato correttamente";
            $_SESSION['soste'] = "";
        }
    }
    
    $viaggi = $db->getViaggiAutista($_SESSION['email']);
    $fb = $db->getFeedback($_SESSION['email'], "passeggero");


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
        <h1>Area personale: profilo autista</h1>
        <h2>Viaggi organizzati</h2>
        <table>
            <tr>
                <th>Partenza</th>
                <th>Destinazione</th>
                <th>Data</th>
            </tr>
            <?php
                foreach ($viaggi as $v)
                {
                    echo "<a href='manageTrip.php?id=" . $v['idV'] . "'><tr>
                        <td>" . $v['cittaP'] . "</td>
                        <td>" . $v['cittaD'] . "</td>
                        <td>" . $v['data'] . "</td>
                        </tr></a>";
                } 
            ?>
        </table>
        <h2>Aggiungi viaggio</h2>
        <form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">
            <label for="partenza">Partenza</label>
            <input type="text" id="partenza" name="partenza" required><br>
            <label for="arrivo">Arrivo</label>
            <input type="text" id="arrivo" name="arrivo" required><br>
            <label for="data">Data</label>
            <input type="date" id="data" name="data" required><br>
            <label for="costo">Costo</label>
            <input type="number" id="costo" name="costo" min="0" required><br>
            <label for="tempo">Tempo medio</label>
            <input type="number" id="tempo" name="tempo" required><br>
            <label for="opt">Optional</label>
            <select id="opt">
                <option id="opt_no">Nessun optional</option>
                <option id="opt_animali">Animali consentiti</option>
                <option id="opt_bagagli">Bagagli consentiti</option>
                <option id="opt_si">Animali e bagagli consentiti</option>
            </select>
            <form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">
                <label for="soste">Soste</label>
                <input type="text" id="soste" name="soste" required>
                <input type="submit" value="Aggiungi sosta" name="addSosta">
            </form>
            <input type="submit" name="viaggio" value="Aggiungi viaggio">
        </form>
        <h2>Feedback</h2>
        <table>
            <tr>
                <th>Giudizio</th>
                <th>Commento</th>
            </tr>
            <?php
                foreach ($fb as $f)
                {
                    echo "<tr>
                        <td>" . $f['voto'] . "</td>
                        <td>" . $f['giudizio'] . "</td>
                        </tr>";
                } 
            ?>
        </table>
    </body>
</html>