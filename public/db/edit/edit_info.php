<?php
require_once __DIR__ . '/../db_connection.php';

$id = intval($_GET['id']);
$sql = "SELECT * FROM informations WHERE id = $id";
$result = $conn->query($sql);

if ($result->num_rows === 1) {
    $row = $result->fetch_assoc();
} else {
    die("Eintrag nicht gefunden.");
}
?>

<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <title>Eintrag bearbeiten</title>
</head>
<body>
    <h1>Eintrag bearbeiten</h1>
    <form method="POST" action="update_info.php">
        <input type="hidden" name="id" value="<?= $row['id'] ?>">

        <label>Vorname:<input type="text" name="vorname" value="<?= htmlspecialchars($row['first_name']) ?>" required></label><br><br>
        <label>Nachname:<input type="text" name="nachname" value="<?= htmlspecialchars($row['last_name']) ?>" required></label><br><br>
        <label>Beruf:<input type="text" name="beruf" value="<?= htmlspecialchars($row['profession']) ?>" required></label><br><br>
        <label>Email:<input type="email" name="email" value="<?= htmlspecialchars($row['email']) ?>" required></label><br><br>

        <button type="submit" name="eintrag_speichern">Speichern</button>
    </form>

    <br><a href="formular.php">← Zurück</a>
</body>
</html>