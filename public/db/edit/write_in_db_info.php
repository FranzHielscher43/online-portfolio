<?php
require_once __DIR__ . '/../db_connection.php';

function schreibeInDatenbank($conn) {
    $vorname = $conn->real_escape_string($_POST['vorname']);
    $nachname = $conn->real_escape_string($_POST['nachname']);
    $beruf = $conn->real_escape_string($_POST['beruf']);
    $email = $conn->real_escape_string($_POST['email']);

    $sql = "INSERT INTO informations (first_name, last_name, profession, email)
            VALUES ('$vorname', '$nachname', '$beruf', '$email')";

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