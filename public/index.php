<?php
require_once "config/database.php";
require_once "app/controllers/AuthController.php";

$controller = new AuthController($conn);

$request_uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$script_path = dirname($_SERVER['SCRIPT_NAME']);
$uri = str_replace($script_path, '', $request_uri);
if (empty($uri) || $uri[0] !== '/') {
    $uri = '/' . ltrim($uri, '/');
}

$method = $_SERVER['REQUEST_METHOD'];

if ($uri == "/register" && $method == "POST") {
    $controller->register();
}

elseif ($uri == "/login" && $method == "POST") {
    $controller->login();
}

elseif ($uri == "/logout" && $method == "POST") {
    $controller->logout();
}

else {
    echo "404 Not Found";
}