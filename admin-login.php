<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Assuming you have a database connection established
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "signup_page";

    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Get form data using prepared statements to prevent SQL injection
    $username = $_POST['adminUsername'];
    $password = $_POST['adminPassword'];

    // Debugging information
    echo "Username: " . $username . "<br>";
    echo "Password: " . $password . "<br>";

    // Direct SQL query for debugging purposes (without hashing)
    $sql = "SELECT * FROM admin_users WHERE username = '$username' AND password = '$password'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // Admin login successful
        $_SESSION['admin_username'] = $username;
        $conn->close();
        header("Location: admin-dashboard.html"); // Redirect to admin dashboard or any other admin page
        exit();
    } else {
        // Invalid username or password
        $conn->close();
        header("Location: admin-login.html?error=1"); // Redirect back to login page with an error parameter
        exit();
    }
}
// No closing tag needed to avoid accidental whitespace
