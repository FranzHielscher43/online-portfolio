<?php
require_once __DIR__ . '/../db_connection.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = intval($_POST['id']);
    $titel = $conn->real_escape_string($_POST['titel']);
    $beschreibung = $conn->real_escape_string($_POST['beschreibung']);
    $url = $conn->real_escape_string($_POST['url']);
    $image_path_1 = $conn->real_escape_string($_POST['image_path_1']);
    $image_path_2 = $conn->real_escape_string($_POST['image_path_2']);
    $image_path_3 = $conn->real_escape_string($_POST['image_path_3']);

    $sql = "UPDATE projects SET 
            title = '$titel',
            description = '$beschreibung',
            url = '$url',
            image_path_1 = '$image_path_1',
            image_path_2 = '$image_path_2',
            image_path_3 = '$image_path_3'
        WHERE id = $id";
    if ($conn->query($sql) === TRUE) {
        header("Location: ./../formular.php?info_updated=1");
        exit();
    } else {
        echo "Fehler beim Speichern: " . $conn->error;
    }
}