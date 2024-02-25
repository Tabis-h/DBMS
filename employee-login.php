<?php
session_start();

// Include database connection
include('db_connection.php');

// Define error messages
$errors = array(
    "emptyfields" => "Please fill in all fields.",
    "invalidlogin" => "Invalid username or password.",
    "sqlerror" => "Database error. Please try again later."
);

// Check for errors in the URL query string
$error_message = "";
if (isset($_GET['error']) && isset($errors[$_GET['error']])) {
    $error_message = $errors[$_GET['error']];
}

if (isset($_POST['login_employee'])) {
    $username = mysqli_real_escape_string($db, $_POST['username']);
    $password = mysqli_real_escape_string($db, $_POST['password']);

    if (empty($username) || empty($password)) {
        header("Location: employee-login.php?error=emptyfields");
        exit();
    } else {
        // Fetch user from employee_logins table
        $query = "SELECT * FROM employee_logins WHERE username='$username'";
        $result = mysqli_query($db, $query);

        if ($result && mysqli_num_rows($result) == 1) {
            $row = mysqli_fetch_assoc($result);
            $stored_password = $row['password'];

            // Verify password
            if ($password == $stored_password) {
                // Password is correct, redirect to employee dashboard
                $_SESSION['username'] = $row['username'];
                header("Location: employee_dashboard.php");
                exit();
            } else {
                // Password is incorrect
                header("Location: employee-login.php?error=invalidlogin");
                exit();
            }
        } else {
            // User not found in database
            header("Location: employee-login.php?error=invalidlogin");
            exit();
        }
    }
}
?>
