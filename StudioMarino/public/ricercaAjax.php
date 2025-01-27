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
$d = isset($_REQUEST["d"]) ? trim($_REQUEST["d"]) : "";
$a = isset($_REQUEST["a"]) ? trim($_REQUEST["a"]) : "";

if ($d !== "" && $a !== "" && strtotime($d) && strtotime($a)) 
{
    $data_inizio = strtotime($d);
    $data_fine = strtotime($a);
}

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
        $nome_completo = $animale['Nome'];
        $specie_completa = str_replace("_", " ", $s);

        // Verifica se il nome contiene la stringa di ricerca e la specie corrisponde
        if (stripos($nome_completo, $q) !== false && $animale['Specie'] == $specie_completa) 
        {
            if ($d !== "" && $a !== "" && isset($animale['DataAvvistamento'])) 
            {
                $data_avvistamento = strtotime($animale['DataAvvistamento']);
                
                if ($data_avvistamento >= $data_inizio && $data_avvistamento <= $data_fine) 
                {
                    $risultati[] = $nome_completo;
                }
            } 
            else 
            {
                $risultati[] = $nome_completo;
            }
        }
        
        // Se sono stati già raccolti 5 risultati, fermiamo la ricerca
        if (count($risultati) >= 5) 
        {
            break; // Esci dal ciclo se sono stati trovati 5 risultati
        }
    }

    // Mostriamo i risultati se ce ne sono
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

?>
