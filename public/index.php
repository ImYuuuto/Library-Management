<?php
session_start();

require_once "config/database.php";

$page = $_GET['page'] ?? 'home';

switch ($page) {

    // ===== PUBLIC PAGES =====
    case 'home':
        require "app/pages/home.php";
        break;

    case 'books':
        require "app/pages/books.php";
        break;

    case 'book':
        require "app/pages/book.php";
        break;

    case 'borrow':
        require "app/pages/borrow.php";
        break;

    case 'my_books':
        require "app/pages/my_books.php";
        break;
    case 'login':
        require "app/auth/login.php";
        break;

    case 'register':
        require "app/auth/register.php";
        break;

    case 'logout':
        require "app/auth/logout.php";
        break;

    case 'dashboard':
        require "app/includes/auth.php";
        require "app/dashboard/dashboard.php";
        break;

    case 'add_book':
        require "app/includes/auth.php";
        require "app/dashboard/add_books.php";
        break;

    case 'edit_book':
        require "app/includes/auth.php";
        require "app/dashboard/edit_book.php";
        break;

    case 'delete_book':
        require "app/includes/auth.php";
        require "app/dashboard/delete_book.php";
        break;

    case 'modify_books':
        require "app/includes/auth.php";
        require "app/dashboard/modify_books.php";
        break;

    case 'approve':
        require "app/includes/auth.php";
        require "app/dashboard/approve.php";
        break;

    case 'reject':
        require "app/includes/auth.php";
        require "app/dashboard/reject.php";
        break;

    case 'unapprove':
        require "app/includes/auth.php";
        require "app/dashboard/unapprove.php";
        break;

    case 'gestion_emprunts':
        require "app/includes/auth.php";
        require "app/dashboard/gestion_emprunts.php";
        break;

    case 'login_process':
        require "app/auth/login_process.php";
        break;
    case 'register_process':
        require "app/auth/register_process.php";
        break;

    default:
        echo "404 Not Found";
        break;
}
