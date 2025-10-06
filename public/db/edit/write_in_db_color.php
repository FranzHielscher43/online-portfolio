<?php
require_once __DIR__ . '/../db_connection.php';

function schreibeInDatenbank($conn) {
    $primary_color = $conn->real_escape_string($_POST['primary_color']);
    $secondary_color = $conn->real_escape_string($_POST['secondary_color']);
    $contact_font_color = $conn->real_escape_string($_POST['contact_font_color']);
    $navbar_color = $conn->real_escape_string($_POST['navbar_color']);
    $footer_color = $conn->real_escape_string($_POST['footer_color']);
    
    $sql = "INSERT INTO settings (primary_color, secondary_color, contact_font_color, navbar_color, footer_color)
            VALUES ('$primary_color', '$secondary_color', '$contact_font_color', '$navbar_color', '$footer_color')";

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