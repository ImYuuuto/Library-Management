<?php
require_once "app/includes/auth.php";
requireLogin();
$page_css = "assets/css/my_books.css";
require_once "app/includes/header.php";
require_once "config/database.php";

$user_id = $_SESSION["user_id"];

// Pagination
$limit = 4;
$page = $_GET["p"] ?? 1;
$page = max(1, (int)$page);
$offset = ($page - 1) * $limit;

// Get books with description + image
$sql = "SELECT books.title, books.description, books.image
        FROM borrowing 
        JOIN books ON borrowing.book_id = books.id 
        WHERE borrowing.user_id = ?
        and borrowing.status = 'approved'
        LIMIT $limit OFFSET $offset";

$stmt = $conn->prepare($sql);
$stmt->execute([$user_id]);
$books = $stmt->fetchAll();

// Count total
$countStmt = $conn->prepare(
    "SELECT COUNT(*) FROM borrowing 
    WHERE user_id = ? and status= 'approved'"
);
$countStmt->execute([$user_id]);
$totalBooks = $countStmt->fetchColumn();

$totalPages = ceil($totalBooks / $limit);
?>

<div class="container">
    <h1>My Borrowed Books</h1>

    <?php if (empty($books)): ?>
        <p class="empty">You haven't borrowed any books yet</p>
    <?php else: ?>

        <div class="grid">
            <?php foreach ($books as $book): ?>
                <div class="card">
                    <img src="<?= $book['image'] ?>" alt="book">

                    <div class="card-content">
                        <h3><?= htmlspecialchars($book["title"]) ?></h3>
                        <p><?= htmlspecialchars($book["description"]) ?></p>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>

        <!-- Pagination -->
        <div class="pagination">
            <?php for ($i = 1; $i <= $totalPages; $i++): ?>
                <a href="?page=my_books&p=<?= $i ?>" class="<?= $i == $page ? 'active' : '' ?>">
                    <?= $i ?>
                </a>
            <?php endfor; ?>
        </div>

    <?php endif; ?>
</div>

<?php require_once "app/includes/footer.php"; ?>