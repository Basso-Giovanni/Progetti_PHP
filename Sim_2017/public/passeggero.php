<?php
    require_once __DIR__ . "/nav.php";
    require_once __DIR__ . "/../private/database.php";

    $db = new Database();

    $viaggi = $db->getViaggiPasseggero($_SESSION['email']);
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
        <h1>Area personale: profilo passeggero</h1>
        <h2>Viaggi prenotati</h2>
        <table>
            <tr>
                <th>Partenza</th>
                <th>Destinazione</th>
                <th>Data</th>
                <th>Feedback</th>
            </tr>
            <?php
                foreach ($viaggi as $v)
                {
                    echo "<tr>
                        <td>" . $v['cittaP'] . "</td>
                        <td>" . $v['cittaD'] . "</td>
                        <td>" . $v['data'] . "</td>";

                    $data_db_obj = new DateTime($v['data']);
                    $oggi = new DateTime();

                    if ($data_db_obj < $oggi)
                    {
                        echo "<td><a href='feedback.php?id=" . $v['email'] . "'>Feedback all'autista</a></td>";
                    }
                    else
                    {
                        echo "<td>Dopo il viaggio potrai lasciare un feedback</td>";
                    }
                    echo "</tr>";
                } 
            ?>
        </table>
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