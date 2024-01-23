<?php include('server.php')?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LOGIN/SIGNUP PAGE</title>
    <link rel="stylesheet" href="style.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <style>
        
    </style>
</head>
<body>
    <div class="wrapper">
        <form method="post" action="login.php">
            <h1>Login</h1>
            <div class="input-class">
                <input type="text" placeholder="Email" name="email" required>
                <i class='bx bxs-user'></i>
            </div>
            <div class="input-class">
                <input type="password" placeholder="Password" name="password" required>
                <i class='bx bx-lock-alt'></i>
            </div>
            <div class="remember-forgot">
                <label><input type="checkbox" name="remember">Remember me</label>
                <a href="#">Forgot password?</a>
            </div>
            <button type="submit" class="btn" name="login_user">Login</button>
            <div class="register-link">
                <p>Don't have an account? <a href="signup.html">Register</a></p>
            </div>
        </form>
    </div>
</body>
</html>
