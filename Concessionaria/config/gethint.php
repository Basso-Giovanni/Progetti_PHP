<?php
    // Recupera i criteri di ricerca dalla query string
    $marca = isset($_GET['marca']) ? strtolower($_GET['marca']) : null;
    $modello = isset($_GET['modello']) ? strtolower($_GET['modello']) : null;
    $annoDa = isset($_GET['annoDa']) && !empty($_GET['annoDa']) ? (int)$_GET['annoDa'] : null;
    $annoA = isset($_GET['annoA']) && !empty($_GET['annoA']) ? (int)$_GET['annoA'] : null;
    $prezzoMin = isset($_GET['prezzoMin']) && !empty($_GET['prezzoMin']) ? (int)$_GET['prezzoMin'] : null;
    $prezzoMax = isset($_GET['prezzoMax']) && !empty($_GET['prezzoMax']) ? (int)$_GET['prezzoMax'] : null;

    // Carica il file XML
    $xml = simplexml_load_file('../data/automobili.xml');
    $suggestions = [];

    // Itera su ogni automobile
    foreach ($xml as $auto) 
    {
        $marcaAuto = strtolower($auto->marca);
        $modelloAuto = strtolower($auto->modello);
        $annoProduzione = (int)$auto->annoProduzione;
        $prezzoAuto = (int)$auto->prezzo;

        // Filtraggio
        if ($marca !== null && strpos($marcaAuto, $marca) === false) continue;
        if ($modello !== null && strpos($modelloAuto, $modello) === false) continue;
        if ($annoDa !== null && $annoProduzione < $annoDa) continue;
        if ($annoA !== null && $annoProduzione > $annoA) continue;
        if ($prezzoMin !== null && $prezzoAuto < $prezzoMin) continue;
        if ($prezzoMax !== null && $prezzoAuto > $prezzoMax) continue;

        // Aggiungi ai risultati
        $suggestions[] = "Marca: $auto->marca, Modello: $auto->modello, Anno: $auto->annoProduzione, Prezzo: $auto->prezzo €, Colore: $auto->colore, Stato: $auto->stato";
    }

    // Restituisce i risultati
    if (empty($suggestions)) 
    {
        echo "Nessuna corrispondenza trovata.";
    } 
    else 
    {
        echo implode('<br>', $suggestions);
    }
?>
