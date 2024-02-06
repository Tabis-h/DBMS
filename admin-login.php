<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "signup_page";

    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $username = $_POST['adminUsername'];
    $password = $_POST['adminPassword'];

    echo "Username: " . $username . "<br>";
    echo "Password: " . $password . "<br>";

    $sql = "SELECT * FROM admin_users WHERE username = '$username' AND password = '$password'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $_SESSION['admin_username'] = $username;
        $conn->close();
        header("Location: admin-dashboard.html");
        exit();
    } else {
        $conn->close();
        header("Location: admin-login.html?error=1");
        exit();
    }
}
