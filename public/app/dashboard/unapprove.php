<?php
require_once "app/includes/auth.php";
requireAdmin();
require_once "config/database.php";

$id = $_GET["id"] ?? null;

if ($id) {
    $stmt = $conn->prepare("UPDATE borrowing SET status = 'pending' WHERE id = ? AND status = 'approved'");
    $stmt->execute([$id]);
}

header("Location: ?page=gestion_emprunts");
exit();
