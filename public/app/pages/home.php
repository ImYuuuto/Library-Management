<?php
require "../includes/auth.php";
requireLogin();
$page_css = "../../assets/css/home.css"; 
require "../includes/header.php";

?>

<h1>Welcome <?= $_SESSION["name"] ?></h1>

<p>This is your library dashboard.</p>

<ul>
    <li><a href="books.php">Browse Books</a></li>
    <li><a href="my_books.php">My Borrowings</a></li>
</ul>

<?php require "../includes/footer.php"; ?>