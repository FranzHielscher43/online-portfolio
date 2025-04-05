<?php
require_once __DIR__ . '/../db_connection.php';

function getLastID() {
    global $conn;

    $sql = "SELECT id FROM informations ORDER BY id DESC LIMIT 1";
    $result = $conn->query($sql);

    if ($result && $row = $result->fetch_assoc()) {
        return $row['id'];
    }
    return null; // keine Einträge vorhanden
}
?>