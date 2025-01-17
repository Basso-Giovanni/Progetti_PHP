<?php
    session_start();

    $marca = isset($_GET['marca']) ? strtolower($_GET['marca']) : null;
    $modello = isset($_GET['modello']) ? strtolower($_GET['modello']) : null;
    $annoDa = isset($_GET['annoDa']) && !empty($_GET['annoDa']) ? (int)$_GET['annoDa'] : null;
    $annoA = isset($_GET['annoA']) && !empty($_GET['annoA']) ? (int)$_GET['annoA'] : null;
    $prezzoMin = isset($_GET['prezzoMin']) && !empty($_GET['prezzoMin']) ? (int)$_GET['prezzoMin'] : null;
    $prezzoMax = isset($_GET['prezzoMax']) && !empty($_GET['prezzoMax']) ? (int)$_GET['prezzoMax'] : null;

    $xml = simplexml_load_file('../data/automobili.xml');
    $suggestions = [];

    echo "<table>
            <tr>
                <th>Marca</th>
                <th>Modello</th>
                <th>Anno</th>
                <th>Prezzo (€)</th>
                <th>Colore</th>
                <th>Chilometraggio (km)</th>
                <th>Stato</th>
                <th>Azioni</th>
            </tr>";

    foreach ($xml as $auto) 
    {
        $marcaAuto = strtolower($auto->marca);
        $modelloAuto = strtolower($auto->modello);
        $annoProduzione = (int)$auto->annoProduzione;
        $prezzoAuto = (int)$auto->prezzo;

        if ($marca !== null && strpos($marcaAuto, $marca) === false) continue;
        if ($modello !== null && strpos($modelloAuto, $modello) === false) continue;
        if ($annoDa !== null && $annoProduzione < $annoDa) continue;
        if ($annoA !== null && $annoProduzione > $annoA) continue;
        if ($prezzoMin !== null && $prezzoAuto < $prezzoMin) continue;
        if ($prezzoMax !== null && $prezzoAuto > $prezzoMax) continue;

        $stato_info = $auto->stato == 1 ? "nuovo" : "usato";

        echo "<tr>
                <td>{$auto->marca}</td>
                <td>{$auto->modello}</td>
                <td>{$auto->annoProduzione}</td>
                <td>{$auto->prezzo} €</td>
                <td>{$auto->colore}</td>
                <td>{$auto->chilometraggio} km</td>
                <td>{$stato_info}</td>";

        if (isset($_SESSION['email'])) 
        {
            echo "<td><a href='../config/edit.php?q={$auto->id}'>Modifica</a>|<a href='../config/delete.php?q={$auto->id}'>Elimina</a></td>";
        } 
        else 
        {
            echo "<td>-</td>";
        }

        echo "</tr>";
    }

    echo "</table>";
?>