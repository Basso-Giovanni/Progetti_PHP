<?php
    require_once __DIR__ . "/nav.php";
    require_once __DIR__ . "/../private/database.php";
    
    $db = new Database();

    $viaggi = $db->getViaggiAttivi();
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
        <h1>Lista viaggi Car pooling</h1>
        <table>
            <tr>
                <th>Partenza</th>
                <th>Arrivo</th>
                <th>Data</th>
            </tr>
            <?php //i viaggi visibili saranno solo quelli attivi
                foreach ($viaggi as $v)
                {
                    echo "<a href='trip.php?id=" . $v['idV'] . "'><tr>
                        <td>" . $v['cittaP'] . "</td>
                        <td>" . $v['cittaD'] . "</td>
                        <td>" . $v['data'] . "</td>
                        </tr></a>";
                }
            ?>
        </table> 
    </body>
</html>