<?php 
require "../../config/database.php";
require "../includes/user.php";

if ($_SERVER["REQUEST_METHOD"]==="POST"){
    $name = trim($_POST["name"] ?? "");
    $email = trim($_POST["email"] ?? "");
    $password = $_POST["password"] ?? "";

    if ($name === "" || $email === "" || $password === ""){
        die("All fields are required") ;
    }
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)){
        die("Invalid Email Format.") ;
    }
    if (strlen($password) < 6) {
        die("Password must be at least 6 characters");
    }
    if (findUserByEmail($conn, $email)){
        header("Location: register.php?error=Email-exists");
        exit();
    }
    createUser($conn, $name, $email, $password);
    header("Location:login.php");
    exit();
}
?>