<?php
require_once 'db_connection.php';
require_once 'delete.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['eintrag_loeschen'])) {
    deleteEntry('informations', $conn); // wir geben zusätzlich $conn mit
}
?>

<!DOCTYPE html>
<html lang="de">
    <head>
        <meta charset = "UTF-8">
        <title>Info hinzufügen</title>
        <style>
        table {
            border-collapse: collapse;
            min-width: 80%;
            margin: 20px auto;
        }
        th, td {
            border: 1px solid #aaa;
            padding: 10px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
        h1, form {
            text-align: center;
        }
    </style>
    </head>
    <body>
        <h1>Neuen Eintrag hinzufügen:</h1>
        <form action = "write_in_db.php" method = "POST">
            <label>Vorname:<input type = "text" name = "vorname" required></label><br><br>
            <label>Nachname:<input type = "text" name = "nachname" required></label><br><br>
            <label>Beruf:<input type = "text" name = "beruf" required></label><br><br>
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
                        echo "<td>" . htmlspecialchars($row['email']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['created']) . "</td>";
                        echo "<td>
                                <form method='POST' onsubmit=\"return confirm('Diesen Eintrag wirklich löschen?');\">
                                    <input type='hidden' name='id' value='" . $row['id'] . "'>
                                    <button type='submit' name='eintrag_loeschen'>🗑️ Löschen</button>
                                </form>
                            </td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='7'>Keine Einträge vorhanden.</td></tr>";
                }

                $conn->close();
                ?>
            </tbody>
        </table>

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
                                <form method='POST' onsubmit=\"return confirm('Diesen Eintrag wirklich löschen?');\">
                                    <input type='hidden' name='id' value='" . $row['id'] . "'>
                                    <button type='submit' name='eintrag_loeschen'>🗑️ Löschen</button>
                                </form>
                            </td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='7'>Keine Einträge vorhanden.</td></tr>";
                }

                $conn->close();
                ?>
            </tbody>
        </table>
    </body>
</html>
