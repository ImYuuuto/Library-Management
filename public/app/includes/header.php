<?php
$page_css = $page_css ?? "";
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Library</title>
    <link rel="stylesheet" href="<?= $page_css  ?>">
    <link rel="stylesheet" href="assets/css/header.css">
    <link rel="stylesheet" href="assets/css/footer.css">
</head>

<body>

    <nav>
        <a href="?page=home">Home</a>
        <a href="?page=books">Books</a>
        <a href="?page=my_books">My Borrowings</a>
        <div class="nav-right">
            <?php if (isset($_SESSION["user_id"])): ?>
                <a class="logout" href="?page=logout">Logout</a>
            <?php else: ?>
                <a href="?page=login">Login</a>
                <a href="?page=register">Register</a>
            <?php endif; ?>
        </div>

    </nav>

    <hr>