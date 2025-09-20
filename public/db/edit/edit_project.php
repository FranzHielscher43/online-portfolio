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
        <label>Image_Path_1:<input type="text" name = "image_path_1" value = "<?= htmlspecialchars($row['image_path_1']) ?>" required></label><br><br>
        <label>Image_Path_2:<input type="text" name = "image_path_2" value = "<?= htmlspecialchars($row['image_path_2']) ?>" required></label><br><br>
        <label>Image_Path_3:<input type="text" name = "image_path_3" value = "<?= htmlspecialchars($row['image_path_3']) ?>" required></label><br><br>
        
        <button type="submit" name="eintrag_speichern">Speichern</button>
    </form>

    <br><a href="formular.php">← Zurück</a>
</body>
</html>