<?php
require "../includes/auth.php";
requireLogin();
require "../includes/header.php";
require "../../config/database.php";

$stmt = $conn->query("SELECT * FROM books");
$books = $stmt->fetchAll();
?>

<h1>Books</h1>

<ul>
<?php foreach ($books as $book): ?>
    <li>
        <a href="book.php?id=<?= $book["id"] ?>">
            <?= htmlspecialchars($book["title"]) ?>
        </a>
    </li>
<?php endforeach; ?>
</ul>

<?php require "../includes/footer.php"; ?>