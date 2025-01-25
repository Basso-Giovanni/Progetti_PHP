<?php
    //Vi spiego dopo cosa si nasconde qui
?>
<!DOCTYPE html>
<html lang="it">
<head>
  <meta charset="UTF-8">
  <title>Ricerca Animali Marini</title>
  <link rel="stylesheet" href="../style/base.css"> <!-- Percorso verso base.css -->
  <script src="../script/ricerca.js"></script>     <!-- Percorso verso ricerca.js -->
</head>
<body>

  <!-- Inclusione navbar -->
  <?php require_once __DIR__ . '/navpub.php'; ?>

  <div class="container">
    <h1>Ricerca Animali Marini</h1>
    <p>Inizia a digitare il nome dell'animale nel campo sottostante:</p>
    
    <form action="#" method="get">
      <label for="fname">Nome Animale:</label>
      <input type="text" id="fname" name="fname" onkeyup="showHint(this.value)">
      
    </form>

    
    
    <p>Suggerimenti: 
      <span id="txtHint"></span>
    </p>
  </div>

  <footer>
    <p>&copy; <?php echo date('Y'); ?> Studio Marino</p>
  </footer>

</body>
</html>
