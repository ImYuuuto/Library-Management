<?php 
session_start();
require "../../config/database.php";
require "../includes/user.php";

if ($_SERVER["REQUEST_METHOD"]==="POST"){

    $email = trim($_POST["email"] ?? "");
    $password = $_POST["password"] ?? "";

    if ($email === "" || $password === ""){
        die("All fields are required") ;
    }
    if (findUserByEmail($conn, $email)){
        $user = findUserByEmail($conn, $email);

        if ($user && password_verify($password, $user["password"])){
            $_SESSION["user_id"] = $user["id"];
            $_SESSION["name"] = $user["name"];
            header("Location:../pages/home.php");
            exit();
        }
    }
}
?>