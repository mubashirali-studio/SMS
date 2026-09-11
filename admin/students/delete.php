<?php
include('database/db.php');

$id = $_GET['id'] ?? null;

if ($id) {
    $stmt = $conn->prepare("DELETE FROM students WHERE id = $id");
    $stmt->execute();
}

header("Location: /Website/SMS/?students=true");
exit();
?>