<?php
// Database configuration
$servername = "localhost";  // Change this if your MySQL server is on a different host
$username = "root";  // Replace with your MySQL username
$password = "";  // Replace with your MySQL password
$dbname = "signup_page";  // Replace with your database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Process the form data (Example: Inserting data into the 'users' table)
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $first_name = $_POST["firstname"];
    $last_name = $_POST["lastname"];
    $email = $_POST["email"];
    $password = $_POST["password"];
    $phone = $_POST["Phone"];
    $age = $_POST["age"];
    $gender = $_POST["gender"];

    // Insert data into the 'users' table
    $sql = "INSERT INTO users (first_name, last_name, email, password, phone, age, gender)
            VALUES ('$first_name', '$last_name', '$email', '$password', '$phone', $age, '$gender')";

    if ($conn->query($sql) === TRUE) {
        echo "New record created successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

// Close the database connection
$conn->close();
?>
