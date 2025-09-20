<?php
session_start();
if(!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
    header("Location: /db/access/login.php");
    exit();
}

require_once 'db_connection.php';
require_once './edit/delete.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['loesche_info'])) {
        deleteEntry('informations', $conn);
    }

    if(isset($_POST['loesche_cv'])) {
        deleteEntry('CV', $conn);
    }

    if (isset($_POST['loesche_projekt'])) {
        deleteEntry('projects', $conn);
    }
    
    if(isset($_POST['loesche_benutzer'])) {
        deleteEntry('users', $conn);
    }
}

?>

<!DOCTYPE html>
<html lang="de">
    <head>
        <meta charset = "UTF-8">
        <title>portfolio-content-management</title>
        <link rel="stylesheet" href="./style/formular.css">
    </head>
    <body>
        <a href="/db/access/logout.php">Logout</a>
        <h1>Neuen Eintrag hinzufügen:</h1>
        <form action = "/db/edit/write_in_db_info.php" method = "POST">
            <label>Vorname:<input type = "text" name = "vorname" required></label><br><br>
            <label>Nachname:<input type = "text" name = "nachname" required></label><br><br>
            <label>Beruf:<input type = "text" name = "beruf" required></label><br><br>
            <label>About Me:<input type = "text" name = "about_me" required><label><br><br>
            <label>Bildpfad:<input type = "text" name = "bildpfad" required><label><br><br>
            <label>Email:<input type = "text" name = "email" required></label><br><br>
            <button type = "submit">Speichern</button>
        </form>

        <h1>Gespeicherte Informationen</h1>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Vorname</th>
                    <th>Nachname</th>
                    <th>Beruf</th>
                    <th>About Me</th>
                    <th>Bildpfad</th>
                    <th>Email</th>
                    <th>Erstellt am</th>
                    <th>Aktion</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $sql = "SELECT * FROM informations ORDER BY created ASC";
                $result = $conn->query($sql);

                if ($result && $result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . htmlspecialchars($row['id'] ) . "</td>";
                        echo "<td>" . htmlspecialchars($row['first_name']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['last_name']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['profession']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['about_text']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['image_path']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['email']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['created']) . "</td>";
                        echo "<td>
                                <form method='POST' onsubmit=\"return confirm('Diesen Eintrag wirklich löschen?');\">
                                    <input type='hidden' name='id' value='" . $row['id'] . "'>
                                    <button type='submit' name='loesche_info'>🗑️ Löschen</button>
                                </form>
                                <form method='GET' action='/db/edit/edit_info.php'>
                                    <input type='hidden' name='id' value='" . $row['id'] . "'>
                                    <button type='submit'>✏️ Bearbeiten</button>
                                </form>
                            </td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='8'>Keine Einträge vorhanden.</td></tr>";
                }

                ?>
            </tbody>
        </table>
        <br>

        <!-- CV -->
        <h1>Neuen Lebenslaufeintrag hinzufügen:</h1>
        <form action = "/db/edit/write_in_db_cv.php" method = "POST">
            <label>Name:<input type = "text" name = "name" required></label><br><br>
            <label>Position:<input type = "text" name = "position" required></label><br><br>
            <label>Unternehmen:<input type = "text" name = "company" required></label><br><br>
            <label>Adresse:<input type = "text" name = "address" required></label><br><br>
            <label>Startdatum:<input type = "text" name = "start_date" required><label><br><br>
            <label>Enddatum:<input type = "text" name = "end_date" required><label><br><br>
            <label>Beschreibung:<input type = "text" name = "description" required></label><br><br>
            <button type = "submit">Speichern</button>
        </form>

        <h1>Gespeicherte Lebenslaufeinträge</h1>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Position</th>
                    <th>Unternehmen</th>
                    <th>Adresse</th>
                    <th>Startdatum</th>
                    <th>Enddatum</th>
                    <th>Beschreibung</th>
                    <th>Erstellt am</th>
                    <th>Aktion</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $sql = "SELECT * FROM CV ORDER BY created ASC";
                $result = $conn->query($sql);

                if ($result && $result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . htmlspecialchars($row['id'] ) . "</td>";
                        echo "<td>" . htmlspecialchars($row['name']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['position']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['company']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['address']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['start_date']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['end_date']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['description']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['created']) . "</td>";
                        echo "<td>
                                <form method='POST' onsubmit=\"return confirm('Diesen Eintrag wirklich löschen?');\">
                                    <input type='hidden' name='id' value='" . $row['id'] . "'>
                                    <button type='submit' name='loesche_cv'>🗑️ Löschen</button>
                                </form>
                                <form method='GET' action='/db/edit/edit_cv.php'>
                                    <input type='hidden' name='id' value='" . $row['id'] . "'>
                                    <button type='submit'>✏️ Bearbeiten</button>
                                </form>
                            </td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='10'>Keine Einträge vorhanden.</td></tr>";
                }

                ?>
            </tbody>
        </table>
        <br>
        </form>

        <h1>Neues Projekt hinzufügen:</h1>
        <form action = "/db/edit/write_in_db_project.php" method = "POST">
            <label>Titel:<input type = "text" name = "titel" required></label><br><br>
            <label>Beschreibung:<input type = "text" name = "beschreibung" required></label><br><br>
            <label>URL:<input type = "text" name = "url" required></label><br><br>
            <button type = "submit">Speichern</button>
        </form>
        <h1>Gespeicherte Projekte:</h1>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Titel</th>
                    <th>Beschreibung</th>
                    <th>URL</th>
                    <th>Erstellt am</th>
                    <th>Aktion</th>
                </tr>
            </thead>
            <tbody>
            <?php
                $sql = "SELECT * FROM projects ORDER BY created ASC";
                $result = $conn->query($sql);

                if ($result && $result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . htmlspecialchars($row['id'] ) . "</td>";
                        echo "<td>" . htmlspecialchars($row['title']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['description']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['url']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['created']) . "</td>";
                        echo "<td>
                                <form method='POST' onsubmit=\"return confirm('Dieses Projekt wirklich löschen?');\">
                                    <input type='hidden' name='id' value='" . $row['id'] . "'>
                                    <button type='submit' name='loesche_projekt'>🗑️ Löschen</button>
                                </form>
                                 <form method='GET' action='/db/edit_project.php'>
                                    <input type='hidden' name='id' value='" . $row['id'] . "'>
                                    <button type='submit'>✏️ Bearbeiten</button>
                                </form>
                            </td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='7'>Keine Einträge vorhanden.</td></tr>";
                }
                ?>
            </tbody>
        </table>
        <br>
        
        <h1>Vorhandene Benutzer:</h1>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Titel</th>
                    <th>Erstellt am</th>
                    <th>Aktion</th>
                </tr>
            </thead>
            <tbody>
            <?php
                $sql = "SELECT * FROM users ORDER BY created ASC";
                $result = $conn->query($sql);

                if ($result && $result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . htmlspecialchars($row['id'] ) . "</td>";
                        echo "<td>" . htmlspecialchars($row['username']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['created']) . "</td>";
                        echo "<td>
                                <form method='POST' onsubmit=\"return confirm('Diesen User wirklich löschen?');\">
                                    <input type='hidden' name='id' value='" . $row['id'] . "'>
                                    <button type='submit' name='loesche_benutzer'>🗑️ Löschen</button>
                                </form>
                            </td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='4'>Keine Benutzer vorhanden.</td></tr>";
                }

                $conn->close();
                ?>
            </tbody>
        </table>
    </body>
</html>
