<!-- NAVBAR -->
<?php
  session_start();
  require_once __DIR__ . '/navpub.php';
  require_once __DIR__ . '/../db/Database.php';
  $db = new Database();

  if ($_SERVER['REQUEST_METHOD'] == 'POST') 
  {
    if (isset($_POST['user']) && isset($_POST['password']))
    {
      $response = $db->getUser($_POST['user'], $_POST['password']);

      if ($response == 0)
      {
        $_SESSION['user'] = $_POST['user'];
        session_regenerate_id();
        header("Location: dashboard.php");
      }
      elseif ($response == -1)
      {
        echo "Utente inesistente!";
      }
      else
      {
        echo "Password errata!";
      }
    }
  }

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
    <h1>Login dipendenti</h1>
    <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
      <label for="user">Utente:</label>
      <input type="text" id="user" name="user" required><br>
      <label for="password">Password:</label>
      <input type="password" id="password" name="password" required><br>
      <input type="submit" id="login" name="login" value="Accedi">
    </form>
  </div>
  <footer>
    <p>&copy; <?php echo date('Y'); ?> Studio Marino</p>
  </footer>
</body>