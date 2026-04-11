<?php
session_start();
require_once __DIR__ . "/../models/user.php";
require_once __DIR__ . "/../../config/database.php";

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

        header("Location: /gb/public/app/views/auth/login.php");
        exit();
    }

    public function login()
    {
        $user = $this->user->findByEmail($_POST["email"]);
        if ($user && password_verify($_POST["password"], $user["password"])) {
            $_SESSION["user"] = $user;
            if ($user["role"] === "admin") {
                header("Location: /gb/public/app/views/admin/dashboard.php");
                exit();
            } else {
                header("Location: /gb/public/app/views/guest/home.php");
                exit();
            }
        } else {
            echo "Invalid email or password";
        }
    }

    public function logout() {
        session_destroy();
        header("Location: /gb/public/app/views/auth/login.php");
        exit();
    }
}
?>