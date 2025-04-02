<?php
require_once 'db_connection.php';

function deleteEntry($table) {
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['eintrag_loeschen'])) {
        $id = intval($_POST['id']);
    
        $sql = "DELETE FROM $table WHERE id = $id";
    
        if ($conn->query($sql) === TRUE) {
            echo "Eintrag mit ID $id wurde gelöscht.";
        } else {
            echo "Fehler beim Löschen: " . $conn->error;
        }
    
        $conn->close();
    
        echo "<br><a href='formular.php'>← Zurück zur Übersicht</a>";
    } else {
        echo "Ungültiger Zugriff.";
    }
}
?>