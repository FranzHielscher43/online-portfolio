<?php
require_once '/../db_connection.php';

$username = 'admin';
$password = 'admin'; 
$hash = password_hash($password, PASSWORD_DEFAULT);

$sql = "INSERT INTO users (username, password) VALUES ('$username', '$hash')";

if ($conn->query($sql)) {
    echo "Benutzer eingefügt.";
} else {
    echo "Fehler: " . $conn->error;
}
?>