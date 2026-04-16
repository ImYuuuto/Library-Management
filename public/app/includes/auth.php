<?php
if (session_status() !== PHP_SESSION_ACTIVE) {
    session_start();
}
function requireLogin()
{
    if (!isset($_SESSION["user_id"])) {
        header("Location: ?page=login");
        exit();
    }
}

function requireAdmin()
{
    requireLogin();

    if ($_SESSION["role"] !== "admin") {
        header("Location: ?page=home");
        exit();
    }
}
?>