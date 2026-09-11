<?php
include(__DIR__ . '/../../database/db.php');

$id = $_GET['id'] ?? null;

if ($id) {
    $stmt = $conn->prepare("DELETE FROM sections WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
}

header("Location: /Website/SMS/?sections=true");
exit();
?>