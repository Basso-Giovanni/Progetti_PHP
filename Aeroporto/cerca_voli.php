<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="author" content="Giovanni Basso">
    <title>Cerca Voli</title>
</head>
<body>
    <h1>Cerca Voli</h1>
    <form method="GET" action="risultati_voli.php">
        <label>Aeroporto Partenza: <input type="text" name="aeroporto_part"></label><br>
        <label>Aeroporto Arrivo: <input type="text" name="aeroporto_arr"></label><br>
        <label>Data Viaggio: <input type="date" name="DataViaggio"></label><br>
        <button type="submit">Cerca</button>
    </form>
</body>
</html>
