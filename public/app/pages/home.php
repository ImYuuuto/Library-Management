<?php
require_once "app/includes/auth.php";
require "config/database.php";
requireLogin();
$page_css = "assets/css/home.css";
require "app/includes/header.php";

$books_img1 = "assets/images/book1.jpeg";
$books_img2 = "assets/images/book2.jpg";


?>
<div>
    <h1>Welcome <?= $_SESSION["name"] ?></h1>

    <p>Still working on home page :).</p>
</div>


<div class="dashboard">

    <a class="card" href="?page=books">
        <img src=<?= $books_img1 ?> alt="Books">
        <div class="card-content">
            <h3>Browse Books</h3>
            <p>Explore available books in the library</p>
        </div>
    </a>

    <a class="card" href="?page=my_books">
        <img src=<?= $books_img2 ?> alt="My Books">
        <div class="card-content">
            <h3>My Borrowings</h3>
            <p>See books you borrowed</p>
        </div>
    </a>

</div>

<?php require "app/includes/footer.php"; ?>