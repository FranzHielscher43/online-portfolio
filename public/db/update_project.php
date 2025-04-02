<?php
require_once 'db_connection.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = intval($_POST['id']);
    $titel = $conn->real_escape_string($_POST['titel']);
    $beschreibung = $conn->real_escape_string($_POST['beschreibung']);
    $url = $conn->real_escape_string($_POST['url']);

    $sql = "UPDATE projects SET 
            title = '$titel',
            description = '$beschreibung',
            url = '$url'
        WHERE id = $id";
    if ($conn->query($sql) === TRUE) {
        header("Location: formular.php?info_updated=1");
        exit();
    } else {
        echo "Fehler beim Speichern: " . $conn->error;
    }
}