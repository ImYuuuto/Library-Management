<?php
require "../includes/auth.php";
requireLogin();
require "../../config/database.php";
$page_css = "../../assets/css/modify_books.css";
require "../includes/admin_header.php";

/* =========================
   PAGINATION + FILTER
========================= */

$limit = 10;
$page = isset($_GET['page']) ? max(1, (int)$_GET['page']) : 1;
$offset = ($page - 1) * $limit;

$categoryFilter = $_GET['category'] ?? "";

/* =========================
   FETCH CATEGORIES
========================= */
$categoriesStmt = $conn->query("SELECT * FROM categories");
$categories = $categoriesStmt->fetchAll();

/* =========================
   COUNT TOTAL BOOKS
========================= */
if ($categoryFilter) {
    $countStmt = $conn->prepare("SELECT COUNT(*) FROM books WHERE category_id = ?");
    $countStmt->execute([$categoryFilter]);
} else {
    $countStmt = $conn->query("SELECT COUNT(*) FROM books");
}

$totalBooks = $countStmt->fetchColumn();
$totalPages = ceil($totalBooks / $limit);

/* =========================
   FETCH BOOKS WITH JOIN
========================= */

if ($categoryFilter) {
    $stmt = $conn->prepare("
        SELECT books.*, categories.name AS category_name
        FROM books
        LEFT JOIN categories ON books.category_id = categories.id
        WHERE category_id = ?
        LIMIT $limit OFFSET $offset
    ");
    $stmt->execute([$categoryFilter]);
} else {
    $stmt = $conn->query("
        SELECT books.*, categories.name AS category_name
        FROM books
        LEFT JOIN categories ON books.category_id = categories.id
        LIMIT $limit OFFSET $offset
    ");
}

$books = $stmt->fetchAll();
?>

<div class="admin-container">

    <h2>Manage Books</h2>

    <!-- CATEGORY FILTER -->
    <form method="GET" class="filter-form">
        <select name="category" onchange="this.form.submit()">
            <option value="">All Categories</option>
            <?php foreach ($categories as $cat): ?>
                <option value="<?= $cat['id'] ?>" 
                    <?= ($categoryFilter == $cat['id']) ? 'selected' : '' ?>>
                    <?= $cat['name'] ?>
                </option>
            <?php endforeach; ?>
        </select>
    </form>

    <!-- TABLE -->
    <table class="books-table">
        <thead>
            <tr>
                <th>Image</th>
                <th>Title</th>
                <th>Author</th>
                <th>Category</th>
                <th>Available</th>
                <th>Actions</th>
            </tr>
        </thead>

        <tbody>
            <?php foreach ($books as $book): ?>
            <tr>
                <td>
                    <img src="../../<?= $book['image'] ?>" class="book-img">
                </td>

                <td><?= $book['title'] ?></td>
                <td><?= $book['author'] ?></td>
                <td><?= $book['category_name'] ?? 'None' ?></td>

                <td>
                    <span class="badge <?= $book['available'] ? 'available' : 'not-available' ?>">
                        <?= $book['available'] ? 'Yes' : 'No' ?>
                    </span>
                </td>

                <td>
                    <a href="edit_book.php?id=<?= $book['id'] ?>" class="btn edit">Edit</a>

                    <a href="delete_book.php?id=<?= $book['id'] ?>" 
                       class="btn delete"
                       onclick="return confirm('Delete this book?')">
                        Delete
                    </a>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <!-- PAGINATION -->
    <div class="pagination">
        <?php for ($i = 1; $i <= $totalPages; $i++): ?>
            <a href="?page=<?= $i ?>&category=<?= $categoryFilter ?>" 
               class="<?= ($i == $page) ? 'active' : '' ?>">
               <?= $i ?>
            </a>
        <?php endfor; ?>
    </div>

</div>
<?php require "../includes/admin_footer.php"; ?>