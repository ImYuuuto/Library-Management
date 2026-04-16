<?php
require_once "app/includes/auth.php";
requireAdmin();

$page_css = "assets/css/dashboard.css";
require_once "app/includes/admin_header.php";

$sqlUsersCount = "select count(id) as total from users;";
$sqlBooksCount = "select count(id) as total from books;";
$sqlBorrowedCount = "select count(id) as total from borrowing
                    where status = 'approved';";

$stmt = $conn->prepare($sqlUsersCount);
$stmt->execute();
$usersCount = $stmt->fetch()['total'];

$stmt = $conn->prepare($sqlBooksCount);
$stmt->execute();
$booksCount = $stmt->fetch()['total'];

$stmt = $conn->prepare($sqlBorrowedCount);
$stmt->execute();
$borrowedCount = $stmt->fetch()['total'];





?>



<div class="container">
    <h1 class="title">Admin Dashboard</h1>
    <p class="subtitle">Welcome to the administration panel.</p>
    <div id="stats" class="stats-grid">
        <div id="usersCount" class="card">
            <h3>Users</h3>
            <span class="number"><?= $usersCount ?? "Not available" ?></span>
        </div>
        <div id="bookCount" class="card">
            <h3>Books</h3>
            <span class="number"><?= $booksCount ?? "Not available" ?></span>
        </div>
        <div id="borrowedBooks" class="card">
            <h3>Borrowed</h3>
            <span class="number"><?= $borrowedCount ?? "Not available" ?></span>
        </div>

    </div>
</div>

<?php require_once "app/includes/admin_footer.php"; ?>