<?php
session_start();
require_once "config/database.php";
require_once "app/includes/user.php";

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $email = trim($_POST["email"] ?? "");
    $password = $_POST["password"] ?? "";

    if ($email === "" || $password === "") {
        die("All fields are required");
    }
    $user = findUserByEmail($conn, $email);
    if (!$user) {
        header("Location: ?page=login");
        exit();
    }
    
    if (password_verify($password, $user["password"])) {
        $_SESSION["user_id"] = $user["id"];
        $_SESSION["name"] = $user["name"];
        $_SESSION["role"] = $user["role"];
        if ($user["role"] === "admin") {
            header("Location: ?page=dashboard");
        } else {
            header("Location: ?page=home");
        }
        exit();
    }

    
    header("Location: ?page=login");
    exit();
}  
?>