<?php
require "../includes/auth.php";
requireLogin();
require "../../config/database.php";

$id = $_GET["id"] ?? "";

if (!$id) {
    die("Invalid book ID");
}

$sqlImageSelect = "select image from books where id = ?";
$stmt = $conn->prepare($sqlImageSelect);
$stmt->execute([$id]);
$book = $stmt->fetch();

if ($book && $book['image'] && file_exists("../../" . $book['image'])) {
    unlink("../../" . $book['image']);
}

$sqlDelete = "delete from books where id = ? ";
$stmt = $conn->prepare($sqlDelete);
$stmt->execute([$id]);

header("Location:modify_books.php");
exit();
?>


