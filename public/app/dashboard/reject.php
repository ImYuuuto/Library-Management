<?php
require "../../config/database.php";

$id = $_GET["id"];

$stmt = $conn->prepare("UPDATE borrowing SET status = 'rejected' WHERE id = ?");
$stmt->execute([$id]);

header("Location: gestion_emprunts.php");
exit();