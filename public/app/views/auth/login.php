<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>

    <link rel="stylesheet" href="../../../assets/css/login.css">
</head>

<body>

    <form method="POST" action="/login">

        <div>
            <label for="mail">Email</label>
            <input type="email" name="email" id="mail" placeholder="Enter your email" required>
        </div>

        <div>
            <label for="pass">Password</label>
            <input type="password" name="password" id="pass" placeholder="Enter your password" required>
        </div>

        <button type="submit">Login</button>

        <p class="extra">
            Don't have an account?
            <a href="../auth/register.php">Create one</a>
        </p>

    </form>

</body>

</html>