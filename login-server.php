<?php
session_start();
include('db_connection.php'); // Include your database connection file

// Check if the login form is submitted
if (isset($_POST['login_user'])) {
    // Get user-entered credentials
    $email = mysqli_real_escape_string($db, $_POST['email']);
    $password = mysqli_real_escape_string($db, $_POST['password']);

    // Validate the form data
    if (empty($email) || empty($password)) {
        // Handle empty fields, you can redirect or show an error message
        header("Location: login.php?error=emptyfields");
        exit();
    } else {
        // Query to check user in the database
        $query = "SELECT * FROM users WHERE email='$email' AND password='$password'";
        $result = mysqli_query($db, $query);

        if ($result) {
            // Check if a user is found
            if (mysqli_num_rows($result) == 1) {
                // Start a session and store user data
                $row = mysqli_fetch_assoc($result);
                $_SESSION['user_id'] = $row['user_id'];
                $_SESSION['email'] = $row['email'];
                // You can store other user data in the session

                // Redirect to a welcome page or dashboard
                header("Location: index.php");
                exit();
            } else {
                // No user found with the provided credentials
                header("Location: login.php?error=invalidlogin");
                exit();
            }
        } else {
            // Handle database error
            header("Location: login.php?error=sqlerror");
            exit();
        }
    }
} else {
    // Redirect to the login page if the form is not submitted
    header("Location: login.php");
    exit();
}
?>
