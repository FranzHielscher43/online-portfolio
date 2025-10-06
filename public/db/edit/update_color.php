<?php
require_once '../db_connection.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = intval($_POST['id']);
    $primary_color = $conn->real_escape_string($_POST['primary_color']);
    $secondary_color = $conn->real_escape_string($_POST['secondary_color']);
    $contact_font_color = $conn->real_escape_string($_POST['contact_font_color']);
    $navbar_color = $conn->real_escape_string($_POST['navbar_color']);
    $footer_color = $conn->real_escape_string($_POST['footer_color']);

    $sql = "UPDATE settings SET 
                primary_color = '$primary_color',
                secondary_color = '$secondary_color',
                contact_font_color = '$contact_font_color',
                navbar_color = '$navbar_color',
                footer_color = '$footer_color'
                
            WHERE id = $id";

    if ($conn->query($sql) === TRUE) {
        header("Location: ./../formular.php?info_updated=1");
        exit();
    } else {
        echo "Fehler beim Speichern: " . $conn->error;
    }
}