<?php
require_once __DIR__ . '/../db_connection.php';

function deleteEntry($table, $conn) {
    $id = intval($_POST['id']);

    $sql = "DELETE FROM $table WHERE id = $id";

    if ($conn->query($sql) === TRUE) {
        echo "<script>alert('Eintrag erfolgreich gelöscht!');</script>";
    } else {
        echo "<script>alert('Fehler beim löschen!');</script>";    
    }
}
?>