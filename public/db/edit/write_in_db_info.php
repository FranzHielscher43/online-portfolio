<?php
require_once __DIR__ . '/../db_connection.php';

function schreibeInDatenbank($conn) {
    $vorname = $conn->real_escape_string($_POST['vorname']);
    $nachname = $conn->real_escape_string($_POST['nachname']);
    $beruf = $conn->real_escape_string($_POST['beruf']);
    $about_me = $conn->real_escape_string($_POST['about_me']);
    $bildpfad = $conn->real_escape_string($_POST['bildpfad']);
    $email = $conn->real_escape_string($_POST['email']);

    $sql = "INSERT INTO informations (first_name, last_name, profession, about_text, image_path, email)
            VALUES ('$vorname', '$nachname', '$beruf', '$about_me', '$bildpfad', '$email')";

    if ($conn->query($sql) === TRUE) {
        header("Location: ./../formular.php?erfolg=1");
        exit;
    } else {
        header("Location: ./../formular.php?error=1");
        exit;
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    schreibeInDatenbank($conn);
}
?>