<?php
    require_once __DIR__ . '/../db/Database.php';
    $db = new Database();

    if ($_SERVER['REQUEST_METHOD'] == 'GET')
    {
        $nome = $_GET['nome'];
        $dati = $db->searchAnimaliByName($nome);

        if (isset($dati) && !empty($dati))
        {
            $nome = $dati[0]['Nome'];
            $specie = $dati[0]['Specie'];
            $lat = $dati[0]['Latitudine'];
            $long = $dati[0]['Longitudine'];
            $desc = $dati[0]['Descrizione'];
            $data = $dataFormattata = DateTime::createFromFormat('Y-m-d', $dati[0]['DataAvvistamento'])->format('d/m/Y'); ;
        }
    }
    else
    {
        echo "Errore nell'apertura della scheda";
        exit;
    }
?>

<!DOCTYPE html>
<html lang="it">
<head>
  <meta charset="UTF-8">
  <title>Studio Marino - Animale</title>
  <!-- Collegamento al file CSS base -->
  <link rel="stylesheet" href="../style/base.css">
</head>
<body>

  <!-- Include la navbar -->
  <?php require_once __DIR__ . '/navpub.php'; ?>

  <div class="container">
    <h1>Animale: <?php echo $nome?></h1>
    <h2>Specie: <?php echo $specie?></h2>
    <p>Latitudine: <?php echo $lat?></p>
    <p>Longitudine: <?php echo $long?></p>
    <p><?php echo $desc?></p>
    <p>Data ultimo avvistamento: <?php echo $data?></p>
</div>
  <footer>
    <p>&copy; <?php echo date('Y'); ?> Studio Marino - Tutti i diritti riservati.</p>
  </footer>

</body>
</html>
