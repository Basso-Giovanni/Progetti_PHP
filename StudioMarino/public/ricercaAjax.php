<?php

session_start();  // Avvio sessione per salvare localmente la tabella o parte di essa

// Se la sessione NON contiene ancora i dati sugli animali marini, facciamo la query una volta sola
if (!isset($_SESSION['animali_marini'])) 
{
    require_once __DIR__ . '/../db/Database.php';
    $db = new Database();
    $_SESSION['animali_marini']= $db->getAllAnimaliMarini();
    $db->close();
} 
else 
{
    $animali = $_SESSION['animali_marini'];
}

// Leggiamo il parametro di ricerca
$q = isset($_REQUEST["q"]) ? trim($_REQUEST["q"]) : "";
$s = isset($_REQUEST["s"]) ? trim($_REQUEST["s"]) : "";

if ($q === "" && $s === "") 
{
    echo "";
}
else
{
    $risultati = [];
    foreach ($animali as $animale) 
    {
        // Verifichiamo se la stringa $q è contenuta (case-insensitive) nel campo Nome
        // Per il case-insensitive uso `stripos`.
        if (stripos($animale['Nome'], $q) !== false && $animale['Specie'] == str_replace("_", " ", $s)) 
        {
            $risultati[] = $animale['Nome'];
        }
    }

    if (!empty($risultati)) 
    {
        foreach ($risultati as $animale)
        {
            $url = str_replace(" ", "_", strtolower($animale));
            echo "<a href='animale.php?nome=" . $url . "' >" . $animale . "</a><br>";
        }
    } 
    else 
    {
        echo "Nessun suggerimento";
    }
}



/*Soluzione con interrogazione continua del DB
require_once __DIR__ . './../db/Database.php';
$db = new Database();

$q = isset($_GET['q']) ? trim($_GET['q']) : '';
if ($q === '') {
    echo "";
    exit;
}

$risultati = $db->searchAnimaliByName($q);
$db->close();

if (!empty($risultati)) 
{
    $nomi = [];
    foreach ($risultati as $animale) 
    {
        $nomi[] = $animale['Nome'];
    }
    echo implode(', ', $nomi);
} 
else 
{
    echo "Nessun suggerimento";
}*/
