<?php
session_start();
require "../../config/database.php";

$user_id = $_SESSION["user_id"];
$book_id = $_POST["book_id"] ?? null;

if ($book_id) {

    $check_sql = "select id from borrowing where user_id=? and book_id=?;";
    $check = $conn->prepare($check_sql);
    $check->execute([$user_id, $book_id]);
    
     if ($check->rowCount() == 0) {
        $stmt = $conn->prepare(
            "INSERT INTO borrowing (user_id, book_id) VALUES (?, ?)"
        );
        $stmt->execute([$user_id, $book_id]);
    }
}

header("Location: my_books.php");
exit();

?>