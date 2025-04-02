<?php

require_once 'db_connection.php';

// Get and save data
$title = $conn -> real_escape_string($_POST['titel']);
$beschreibung = $conn -> real_escape_string($_POST['beschreibung']);
$url = $conn -> real_escape_string($_POST['url']);

$sql = "INSERT INTO projects(title, description, url) VALUES ('$title', '$beschreibung', '$url')";

if($conn->query($sql) === TRUE) {
    echo "Neuer Eintrag erfolgreich gepeichert. <br>";
    echo "<a href='formular.php'>Zurück zum Formular</a>";
} else {
    echo "Fehler: " . $conn->error;
}

$conn->close();

?>