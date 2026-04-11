<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration</title>
    <link rel="stylesheet" href="../../../assets/css/register.css">
</head>

<body>
    <form method="POST" action="/gb/public/register">
        <div>
            <label for="nom">Name</label>
            <input name="name" placeholder="Enter your name" id="nom" required>
            <small class="error"></small>
        </div>
        <div>
            <label for="mail">Email</label>
            <input type="email" name="email" id="mail" placeholder="Enter your email" required>
            <small class="error"></small>
        </div>
        <div>
            <label for="pass">Password</label>
            <input type="password" name="password" id="pass" placeholder="Enter your password" required>
            <small class="error"></small>
        </div>
        <button>Register</button>
        <p class="extra">
            Already have an account?
            <a href="../auth/login.php">Login</a>
        </p>
    </form>
    <script src="../../../assets/js/register.js"></script>
</body>
</html>