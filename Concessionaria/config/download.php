<?php
    require 'db.php';

    $result = $conn->query($sql);

    if ($result->num_rows > 0) 
    {
        // Creazione dell'oggetto SimpleXMLElement
        $xml = new SimpleXMLElement('<root/>');
    
        // Iterazione attraverso i risultati
        while ($row = $result->fetch_assoc()) 
        {
            // Creazione di un nodo per ogni record
            $record = $xml->addChild('record');
            foreach ($row as $key => $value) 
            {
                $record->addChild($key, htmlspecialchars($value));
            }
        }
    
        // Nome del file XML
        $fileName = "automobili.xml";
    
        // Salvataggio nel file XML
        $xml->asXML($fileName);
    
        echo "File XML creato con successo: $fileName";
    } 
    else 
    {
        echo "Nessun dato trovato nella tabella.";
    }
    
    // Chiude la connessione
    $conn->close();
    ?>