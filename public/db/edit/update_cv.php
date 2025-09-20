<?php
require_once '../db_connection.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = intval($_POST['id']);
    $name = $conn->real_escape_string($_POST['name']);
    $position = $conn->real_escape_string($_POST['position']);
    $company = $conn->real_escape_string($_POST['company']);
    $address = $conn->real_escape_string($_POST['address']);
    $start_date = $conn->real_escape_string($_POST['start_date']);
    $end_date = $conn->real_escape_string($_POST['end_date']);
    $description = $conn->real_escape_string($_POST['description']);

    $sql = "UPDATE CV SET 
                name = '$name',
                position = '$position',
                company = '$company',
                address = '$address',
                start_date = '$start_date',
                end_date = '$end_date',
                description = '$description'
            WHERE id = $id";

    if ($conn->query($sql) === TRUE) {
        header("Location: ./../formular.php?info_updated=1");
        exit();
    } else {
        echo "Fehler beim Speichern: " . $conn->error;
    }
}