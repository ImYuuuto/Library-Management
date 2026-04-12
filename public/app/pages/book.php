<?php
require "../includes/auth.php";
requireLogin();
require "../includes/header.php";
require "../../config/database.php";

$id = $_GET["id"] ?? null;

$stmt = $conn->prepare("SELECT * FROM books WHERE id = ?");
$stmt->execute([$id]);
$book = $stmt->fetch();

if (!$book) {
    die("Book not found");
}
?>

<h1><?= htmlspecialchars($book["title"]) ?></h1>
<p><strong>Author:</strong> <?= htmlspecialchars($book["author"]) ?></p>
<p><strong>Description:</strong> <?= htmlspecialchars($book["description"]) ?></p>

<form method="POST" action="borrow.php">
    <input type="hidden" name="book_id" value="<?= $book["id"] ?>">
    <button type="submit">Borrow</button>
</form>

<?php require "../includes/footer.php"; ?>