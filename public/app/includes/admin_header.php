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
    <link rel="stylesheet" href="assets/css/admin_header.css">
    <link rel="stylesheet" href="assets/css/admin_footer.css">
</head>

<body>

    <nav>
        <a href="?page=dashboard">Dashboard</a>
        <a href="?page=add_book">Add books</a>
        <a href="?page=modify_books">Modify books</a>
        <a href="?page=gestion_emprunts">Gestion Emprunts</a>
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