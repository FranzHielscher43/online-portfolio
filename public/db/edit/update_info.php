<?php
require_once __DIR__ . '/../db_connection.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = intval($_POST['id']);
    $vorname = $conn->real_escape_string($_POST['vorname']);
    $nachname = $conn->real_escape_string($_POST['nachname']);
    $beruf = $conn->real_escape_string($_POST['beruf']);
    $about_me = $conn->real_escape_string($_POST['about_me']);
    $email = $conn->real_escape_string($_POST['email']);

    $sql = "UPDATE informations SET 
                first_name = '$vorname',
                last_name = '$nachname',
                profession = '$beruf',
                about_text = '$about_me',
                email = '$email'
            WHERE id = $id";

    if ($conn->query($sql) === TRUE) {
        header("Location: ./../formular.php?info_updated=1");
        exit();
    } else {
        echo "Fehler beim Speichern: " . $conn->error;
    }
}