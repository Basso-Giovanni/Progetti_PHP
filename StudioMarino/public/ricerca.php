<?php
  require_once __DIR__ . '/../db/Database.php';
  $db = new Database();
  $specie = $db->getAllSpecie();

  $db->close();
?>
<!DOCTYPE html>
<html lang="it">
<head>
  <meta charset="UTF-8">
  <title>Ricerca Animali Marini</title>
  <link rel="stylesheet" href="../style/base.css"> <!-- Percorso verso base.css -->
</head>
<body>
  
  <!-- Inclusione navbar -->
  <?php require_once __DIR__ . '/navpub.php'; ?>

  <div class="container">
    <h1>Ricerca Animali Marini</h1>
    <p>Inizia a digitare il nome dell'animale nel campo sottostante:</p>
    
    <form action="#" method="get">
      <label for="fname">Nome Animale:</label>
      <input type="text" id="fname" name="fname" onkeyup="showHint(document.getElementById('fname').value, document.getElementById('select_specie').value)"><br>
      <label for="select_specie">Specie</label>
      <select name="select_specie" id="select_specie" onchange="showHint(document.getElementById('fname').value, document.getElementById('select_specie').value)">
        <?php 
          foreach ($specie as $s)
          {
            echo "<option value=" . str_replace(" ", "_", $s['Specie']) . ">" . $s['Specie'] . "</option>";
          }
        ?>
      </select> 
    </form>
    
    
    
    <p>Suggerimenti:</p><p> 
      <span id="txtHint"></span>
    </p>
  </div>

  <footer>
    <p>&copy; <?php echo date('Y'); ?> Studio Marino</p>
  </footer>
  
</body>
<script src="../script/ricerca.js"></script>     <!-- Percorso verso ricerca.js -->
</html>
