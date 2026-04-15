<?php
require_once "app/includes/auth.php";
requireLogin();
$page_css = "assets/css/book.css";
require_once "app/includes/header.php";
require_once "config/database.php";

$id = $_GET["id"] ?? null;

$stmt = $conn->prepare("SELECT * FROM books WHERE id = ?");
$stmt->execute([$id]);
$book = $stmt->fetch();

if (!$book) {
    die("Book not found");
}
?>
<div class="container book-page">
    <h1><?= htmlspecialchars($book["title"]) ?></h1>
    <div class="book-card">
        <img src="<?= $book["image"] ?>" alt="book" class="book-img">
        <div class="book-info">
            <p><strong>Author:</strong> <?= htmlspecialchars($book["author"]) ?></p>
            <p><strong>Description:</strong> <?= htmlspecialchars($book["description"]) ?></p>
        </div>
    </div>
    <form method="POST" action="?page=borrow">
        <input type="hidden" name="book_id" value="<?= $book["id"] ?>">
        <button type="submit">Borrow</button>
    </form>
</div>


<?php require_once "app/includes/footer.php"; ?>