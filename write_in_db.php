<?php

require_once 'db_connection.php';

// Get and save data
$vorname = $conn -> real_escape_string($_POST['vorname']);
$nachname = $conn -> real_escape_string($_POST['nachname']);
$beruf = $conn -> real_escape_string($_POST['beruf']);
$email = $conn -> real_escape_string($_POST['email']);

$sql = "INSERT INTO informations(first_name, last_name, profession, email) VALUES ('$vorname', '$nachname', '$beruf', '$email')";

if($conn->query($sql) === TRUE) {
    echo "Neuer Eintrag erfolgreich gepeichert. <br>";
    echo "<a href='formular.php'>Zurück zum Formular</a>";
} else {
    echo "Fehler: " . $conn->error;
}

$conn->close();

?>