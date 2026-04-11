<?php
session_start();
require_once "../models/user.php";
require_once "../../config/database.php";

class AuthController
{
    private $user;

    public function __construct($conn)
    {
        $this->user = new User($conn);
    }

    public function register()
    {
        $name = $_POST["name"];
        $email = $_POST["email"];
        $pass = $_POST["password"];

        $this->user->create($name, $email, $pass);

        header("Location:../views/auth/login.php");
        exit();
    }

    public function login()
    {
        $user = $this->user->findByEmail($_POST["email"]);
        if ($user && password_verify($_POST["password"], $user["password"])) {
            $_SESSION["user"] = $user;
            if ($user["role"] === "admin") {
                header("Location:");
                exit();
            } else {
                header("Location:");
            }
        } else {
            echo "Invalid email or password";
        }
    }

    public function logout() {
        session_destroy();
        header("Location: ../views/auth/login.php");
    }
}
?>