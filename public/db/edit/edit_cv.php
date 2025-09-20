<?php
    require_once __DIR__ . '/../db_connection.php';

    $id = intval($_GET['id']);
    $sql = "SELECT * FROM CV WHERE id = $id";
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
        <title>Eintrag bearbeiten</title>
    </head>
    <body>
        <h1>Eintrag bearbeiten</h1>
        <form method="POST" action="update_cv.php">
            <input type="hidden" name="id" value="<?= $row['id'] ?>">

            <label>Name:<input type="text" name="name" value="<?= htmlspecialchars($row['name']) ?>" required></label><br><br>
            <label>Position:<input type="text" name="position" value="<?= htmlspecialchars($row['position']) ?>" required></label><br><br>
            <label>Unternehmen:<input type="text" name="company" value="<?= htmlspecialchars($row['company']) ?>" required></label><br><br>
            <label>Adresse:<input type="text" name="address" value="<?= htmlspecialchars($row['address']) ?>" required></label><br><br>
            <label>Startdatum:<input type="date" name="start_date" value="<?= htmlspecialchars($row['start_date']) ?>" required></label><br><br>
            <label>Enddatum:<input type="date" name="end_date" value="<?= htmlspecialchars($row['end_date']) ?>" required></label><br><br>
            <label>Beschreibung:<input type="text" name="description" value="<?= htmlspecialchars($row['description']) ?>" required></label><br><br>

            <button type="submit" name="eintrag_speichern">Speichern</button>
        </form>

        <br><a href="formular.php">← Zurück</a>
    </body>
</html>