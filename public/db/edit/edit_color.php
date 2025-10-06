<?php
    require_once __DIR__ . '/../db_connection.php';

    $id = intval($_GET['id']);
    $sql = "SELECT * FROM settings WHERE id = $id";
    $result = $conn->query($sql);

    if($result->num_rows === 1) {
        $row = $result->fetch_assoc();
    } else {
        die("Eintrag nicht gefunden.");
    }
?>

<!DOCTYPE html>
<html lang="de">
    <head>
        <meta charset="UTF-8">
        <title>Farbe bearbeiten</title>
    </head>
    <body>
        <h1>Farbe bearbeiten</h1>
        <form method="POST" action="update_color.php">
            <input type="hidden" name="id" value="<?= $row['id'] ?>">

            <label>Primary Color:<input type="text" name="primary_color" value="<?= htmlspecialchars($row['primary_color']) ?>" required></label><br><br>
            <label>Secondary Color:<input type="text" name="secondary_color" value="<?= htmlspecialchars($row['secondary_color']) ?>" required></label><br><br>
            <label>Contact Font Color:<input type="text" name="contact_font_color" value="<?= htmlspecialchars($row['contact_font_color']) ?>" required></label><br><br>
            <label>Navbar Font Color:<input type="text" name="navbar_color" value="<?= htmlspecialchars($row['navbar_color']) ?>" required></label><br><br>
            <label>Footer Font Color:<input type="text" name="footer_color" value="<?= htmlspecialchars($row['footer_color']) ?>" required></label><br><br>
            
            <button type="submit" name="eintrag_speichern">Speichern</button>
        </form>

        <br><a href="formular.php">← Zurück</a>
    </body>
</html>