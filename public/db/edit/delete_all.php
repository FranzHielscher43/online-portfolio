<?php
require_once __DIR__ . '/../db_connection.php';

function deleteMultipleEntries($table, $conn, $ids) {
    if (empty($ids)) {
        echo "<script>alert('Keine Einträge ausgewählt.'); window.location.href = '../../formular.php';</script>";
        exit;
    }

    // Sicherheits-Check: nur Zahlen erlauben
    $safe_ids = array_map('intval', $ids);
    $id_list = implode(',', $safe_ids);

    $sql = "DELETE FROM $table WHERE id IN ($id_list)";

    if ($conn->query($sql) === TRUE) {
        echo "<script>alert('Einträge erfolgreich gelöscht!'); window.location.href = '../../formular.php';</script>";
    } else {
        echo "<script>alert('Fehler beim Löschen: " . $conn->error . "'); window.location.href = '../../formular.php';</script>";
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['delete_all'])) {
    deleteMultipleEntries('informations', $conn, $_POST['auswahl']);
}
?>