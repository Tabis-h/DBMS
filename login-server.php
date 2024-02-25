<?php
session_start();
include('db_connection.php'); 

if (isset($_POST['login_user'])) {

    $email = mysqli_real_escape_string($db, $_POST['email']);
    $password = mysqli_real_escape_string($db, $_POST['password']);

    if (empty($email) || empty($password)) {

        echo "error=emptyfields";
        exit();
    } else {

        $query = "SELECT * FROM users WHERE email='$email' AND password='$password'";
        $result = mysqli_query($db, $query);

        if ($result) {

            if (mysqli_num_rows($result) == 1) {

                $row = mysqli_fetch_assoc($result);
                $_SESSION['user_id'] = $row['user_id'];
                $_SESSION['email'] = $row['email'];

                // Redirect to index.php upon successful login
                header("Location: index.php");
                exit();
            } else {

                echo "error=invalidlogin";
                exit();
            }
        } else {

            echo "error=sqlerror";
            exit();
        }
    }
} else {

    // Redirect to login page if login form is not submitted
    header("Location: login.php");
    exit();
}
