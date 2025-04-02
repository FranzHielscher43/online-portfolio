<?php
$host = "db"; 
$user = "root";
$password = "root";
$dbname = "portfolio";

$conn = new mysqli($host, $user, $password, $dbname);

if ($conn->connect_error) {
    die("Verbindung fehlgeschlagen: " . $conn->connect_error);
}
?>