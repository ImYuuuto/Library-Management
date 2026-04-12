<?php
require "../includes/auth.php";
requireLogin();
require "../includes/header.php";
require "../../config/database.php";

$user_id = $_SESSION["user_id"];

$sql = "SELECT books.title 
        FROM borrows 
        JOIN books ON borrows.book_id = books.id 
        WHERE borrows.user_id = ?";

$stmt = $conn->prepare($sql);
$stmt->execute([$user_id]);
$books = $stmt->fetchAll();
?>

<h1>My Borrowed Books</h1>

<ul>
<?php foreach ($books as $book): ?>
    <li><?= htmlspecialchars($book["title"]) ?></li>
<?php endforeach; ?>
</ul>

<?php require "../includes/footer.php"; ?>