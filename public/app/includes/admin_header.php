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
    <link rel="stylesheet" href="../../assets/css/admin_header.css">
    <link rel="stylesheet" href="../../assets/css/admin_footer.css">
</head>

<body>

    <nav>
        <a href="../dashboard/dashboard.php">Dashboard</a>
        <a href="../dashboard/add_books.php">Add books</a>
        <a href="../dashboard/modify_books.php">Modify books</a>
        <a href="../dashboard/gestion_emprunts.php">Gestion Emprunts</a>
        <div class="nav-right">
            <?php if (isset($_SESSION["user_id"])): ?>
                <a class="logout" href="../auth/logout.php">Logout</a>
            <?php else: ?>
                <a href="../auth/login.php">Login</a>
                <a href="../auth/register.php">Register</a>
            <?php endif; ?>
        </div>

    </nav>

    <hr>