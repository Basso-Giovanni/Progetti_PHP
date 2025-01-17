<?php
    require 'db.php';

    $sql = 'SELECT * FROM automobili';
    $result = $conn->query($sql);

    if ($result->num_rows > 0) 
    {
        //creazione dell'oggetto SimpleXMLElement
        $xml = new SimpleXMLElement('<root/>');
    
        while ($row = $result->fetch_assoc()) 
        {
            $record = $xml->addChild('record');
            foreach ($row as $key => $value) 
            {
                $record->addChild($key, htmlspecialchars($value));
            }
        }
    
        $fileName = "../data/automobili.xml";
    
        $xml->asXML($fileName);
    } 

    $conn->close();
?>