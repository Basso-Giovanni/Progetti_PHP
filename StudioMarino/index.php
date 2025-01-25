<?php
    // Includi la classe Database da cui poi faremo le varie operazioni
    require_once __DIR__ . '/db/Database.php';

    // Creiamo l'istanza del Database e recuperiamo i dati degli animali
    $db = new Database();
    $animali = $db->getAllAnimaliMarini();
    $db->close();
?>
<!DOCTYPE html>
<html lang="it">
<head>
  <meta charset="UTF-8">
  <title>Studio Marino - Home</title>
  <!-- Collegamento al file CSS base -->
  <link rel="stylesheet" href="style/base.css">
</head>
<body>

  <!-- Include la navbar -->
  <?php require_once __DIR__ . '/public/nav.php'; ?>

  <div class="container">
    <h1>Benvenuto allo Studio Marino</h1>
    <p>In questa pagina puoi visualizzare l'elenco degli animali marini presenti nel database.</p>
    <br>
    <table class="tabella-animali">
      <thead>
        <tr>
          <th>Nome</th>
          <th>Latitudine</th>
          <th>Longitudine</th>
          <th>Specie</th>
          <th>Data Avvistamento</th>
        </tr>
      </thead>
      <tbody>
      <?php
        if (!empty($animali)) 
        {
            foreach ($animali as $animale) 
            {
                echo "<tr>
                        <td>" . htmlspecialchars($animale['Nome']) . "</td>
                        <td>" . $animale['Latitudine'] . "</td>
                        <td>" . $animale['Longitudine'] . "</td>
                        <td>" . htmlspecialchars($animale['Specie']) . "</td>
                        <td>" . $animale['DataAvvistamento'] . "</td>
                    </tr>";
            }
        } 
        else 
        {
            echo "<tr><td colspan='5'>Nessun animale trovato.</td></tr>";
        }
      ?>
      </tbody>
    </table>
  </div>

  <footer>
    <p>&copy; <?php echo date('Y'); ?> Studio Marino - Tutti i diritti riservati.</p>
  </footer>

</body>
</html>
