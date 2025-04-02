<?php
$host = "localhost";
$user = "root";
$password = "";
$dbname = "portfolio";

$conn = new mysqli($host, $user, $password, $dbname);

// Check connection
if($conn->connect_error) {
    die("Verbindung fehlgeschlagen: " . $conn->connect_error);
}
?>