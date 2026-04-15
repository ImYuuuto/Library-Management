<?php
if (session_status() !== PHP_SESSION_ACTIVE) {
    session_start();
}

// No global redirect here as it might break guest access to home/books
// The actual checks are in requireLogin and requireAdmin
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