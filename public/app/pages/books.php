<?php
require_once "app/includes/auth.php";
requireLogin();
$page_css = "assets/css/books.css";
require_once "app/includes/header.php";
require_once "config/database.php";

$stmt = $conn->query("SELECT * FROM books");
$books = $stmt->fetchAll();
?>
<div class="container">
    <h1>Books list</h1>
    <?php if (empty($books)): ?>
        <p class="empty">No books available</p>
    <?php else: ?>
        <ul>
            <?php foreach ($books as $book): ?>
                <li>
                    <a href="?page=book&id=<?= $book["id"] ?>">
                        <span><?= htmlspecialchars($book["title"]) ?></span>
                    </a>
                    <img src="<?= $book['image'] ?>" alt="book-img">
                </li>
            <?php endforeach; ?>
        </ul>
    <?php endif; ?>
</div>


<?php require_once "app/includes/footer.php"; ?>