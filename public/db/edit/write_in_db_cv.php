<?php
require_once __DIR__ . '/../db_connection.php';

function schreibeInDatenbank($conn) {
    $name = $conn->real_escape_string($_POST['name']);
    $position = $conn->real_escape_string($_POST['position']);
    $company = $conn->real_escape_string($_POST['company']);
    $address = $conn->real_escape_string($_POST['address']);
    $start_date = $conn->real_escape_string($_POST['start_date']);
    $end_date = $conn->real_escape_string($_POST['end_date']);
    $description = $conn->real_escape_string($_POST['description']);

    $sql = "INSERT INTO CV (name, position, company, address, start_date, end_date, description)
            VALUES ('$name', '$position', '$company', '$address', '$start_date', '$end_date', '$description')";

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