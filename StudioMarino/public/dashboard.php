<?php
    session_start();
    if (!isset($_SESSION['user']))
    {
        header('Location: login.php');
        exit;
    }
    
    require_once __DIR__ . '/navlog.php';
    require_once __DIR__ . '/../db/Database.php';
    $db = new Database();
    $animali = $db->getAllAnimaliMarini();

    // if ($_SERVER['REQUEST_METHOD'] == 'POST') 
    // {
    //     if ()
    // }

    //TODO: Aggiungere il codice per aggiungere l'animale, Aggiungere il codice di Database.php per modificare l'ultimo avvistamento


    $db->close();
?>

<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8"> 
    <title>Studio Marino - Login</title>
    <!-- Collegamento al file CSS base -->
    <link rel="stylesheet" href="../style/base.css">
</head>
<body>
  <div class="container">
    <h1>Nuovo animale</h1>
    <form>
        <label for="nome">Nome</label>
        <input type="text" name="nome" id="nome" required><br>
        <label for="lat">Latitudine (max 10 cifre di cui 7 decimali)</label>
        <input 
            type="number" 
            id="lat" 
            name="lat" 
            step="0.0000001" 
            max="999.9999999" 
            required
        ><br>
        <label for="long">Longitudine (max 10 cifre di cui 7 decimali)</label>
        <input 
            type="number" 
            id="lat" 
            name="lat" 
            step="0.0000001" 
            max="999.9999999" 
            required
        ><br>
        <label for="specie">Specie</label>
        <input type="text" name="specie" id="specie" required><br>
        <label for="desc">Descrizione (facoltativa)</label><br>
        <textarea id="desc" name="desc" rows="10" cols="50" placeholder="Aggiungi una descrizione..."></textarea><br>
        <label for="data">Data avvistamento (facoltativa)</label>
        <input type="date" name="data" id="data"><br>
        <input type="submit" name="add" value="Aggiungi">
    </form>
    <h1>Aggiungi avvistamento</h1>
    <form>
        <label>Seleziona l'animale</label>
        <select>
            <?php
                foreach ($animali as $animale)
                {
                    echo "<option value=" . $animale['Nome'] . ">" . $animale['Nome'] . "</option>";
                }
            ?>
        </select><br>
        <label for="lat">Latitudine (max 10 cifre di cui 7 decimali)</label>
        <input 
            type="number" 
            id="lat" 
            name="lat" 
            step="0.0000001" 
            max="999.9999999" 
            required
        ><br>
        <label for="long">Longitudine (max 10 cifre di cui 7 decimali)</label>
        <input 
            type="number" 
            id="lat" 
            name="lat" 
            step="0.0000001" 
            max="999.9999999" 
            required
        ><br>
        <label for="desc">Descrizione (facoltativa)</label><br>
        <textarea id="desc" name="desc" rows="10" cols="50" placeholder="Aggiungi una descrizione..."></textarea><br>
        <label for="data">Data avvistamento (facoltativa)</label>
        <input type="date" name="data" id="data"><br>
        <input type="submit" name="update" value="Aggiorna">
    </form>
  </div>
  <footer>
    <p>&copy; <?php echo date('Y'); ?> Studio Marino | Accesso effettuato come: <?php echo $_SESSION['user']?></p>
  </footer>
</body>