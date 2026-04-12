<?php
require "../includes/auth.php";
requireLogin();
$page_css = "../../assets/css/home.css";
require "../includes/header.php";

$books_img1 = "../../assets/images/book1.jpeg";
$books_img2 = "../../assets/images/book2.jpg";


?>
<div>
    <h1>Welcome <?= $_SESSION["name"] ?></h1>

    <p>This is your library dashboard.</p>
</div>


<div class="dashboard">

    <a class="card" href="books.php">
        <img src=<?= $books_img1 ?> alt="Books">
        <div class="card-content">
            <h3>Browse Books</h3>
            <p>Explore available books in the library</p>
        </div>
    </a>

    <a class="card" href="my_books.php">
        <img src=<?= $books_img2 ?> alt="My Books">
        <div class="card-content">
            <h3>My Borrowings</h3>
            <p>See books you borrowed</p>
        </div>
    </a>

</div>

<?php require "../includes/footer.php"; ?>