<?php
session_start();

// Define error messages
$errors = array(
    "emptyfields" => "Please fill in all fields.",
    "invalidlogin" => "Invalid email or password.",
    "sqlerror" => "Database error. Please try again later."
);

// Check for errors in the URL query string
$error_message = "";
if (isset($_GET['error']) && isset($errors[$_GET['error']])) {
    $error_message = $errors[$_GET['error']];
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="wrapper">
        <form method="post" action="login-server.php">
            <h1>Login</h1>
            <?php if (!empty($error_message)) : ?>
                <p style='color: red;'><?php echo $error_message; ?></p>
            <?php endif; ?>
            <div class="input-class">
                <input type="text" placeholder="Email" name="email" required>
                <!-- Add your icon here -->
            </div>
            <div class="input-class">
                <input type="password" placeholder="Password" name="password" required>
                <!-- Add your icon here -->
            </div>
            <div class="remember-forgot">
                <label><input type="checkbox" name="remember">Remember me</label>
                <a href="#">Forgot password?</a>
            </div>
            <button type="submit" class="btn" name="login_user">Login</button>
            <div class="register-link">
                <p>Don't have an account? <a href="signup.php">Register</a></p>
                <p>employee? <a href="login_employee.html">Employee Login</a></p>

            </div>
        </form>
    </div>
</body>
</html>
