<?php
require_once 'db_connection.php';

function deleteEntry($table, $conn) {
    $id = intval($_POST['id']);

    $sql = "DELETE FROM $table WHERE id = $id";

    if ($conn->query($sql) === TRUE) {
        echo "Eintrag mit ID $id wurde gelöscht.";
    } else {
        echo "Fehler beim Löschen: " . $conn->error;
    }
}
?>