<?php
require_once "app/includes/auth.php";
requireAdmin();

$page_css = "assets/css/home.css";
require_once "app/includes/admin_header.php";
?>



<div class="container">
    <h1>Admin Dashboard</h1>
    <p>Welcome to the administration panel.</p>
</div>

<?php require_once "app/includes/admin_footer.php"; ?>