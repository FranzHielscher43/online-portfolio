<?php
require_once __DIR__ . '/../db_connection.php';

// Get and save data
$title = $conn -> real_escape_string($_POST['titel']);
$beschreibung = $conn -> real_escape_string($_POST['beschreibung']);
$url = $conn -> real_escape_string($_POST['url']);

$sql = "INSERT INTO projects(title, description, url) VALUES ('$title', '$beschreibung', '$url')";

if ($conn->query($sql) === TRUE) {
    header("Location: ./../formular.php?erfolg=1");
    exit;
} else {
    header("Location: ./../formular.php?error=1");
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
schreibeInDatenbank($conn);
}
?>