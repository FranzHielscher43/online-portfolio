<?php
require_once __DIR__ . '/../db_connection.php';

$id = intval($_GET['id']);
$sql = "SELECT * FROM projects WHERE id = $id";
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
    <title>Projekt bearbeiten</title>
</head>
<body>
    <h1>Projekt bearbeiten</h1>
    <form method="POST" action="update_project.php">
        <input type="hidden" name="id" value="<?= $row['id'] ?>">

        <label>Titel:<input type="text" name="titel" value="<?= htmlspecialchars($row['title']) ?>" required></label><br><br>
        <label>Beschreibung:<input type="text" name="beschreibung" value="<?= htmlspecialchars($row['description']) ?>" required></label><br><br>
        <label>URL:<input type="text" name="url" value="<?= htmlspecialchars($row['url']) ?>" required></label><br><br>

        <button type="submit" name="eintrag_speichern">Speichern</button>
    </form>

    <br><a href="formular.php">← Zurück</a>
</body>
</html>