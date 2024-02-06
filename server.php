<?php

$servername = "localhost";  
$username = "root";  
$password = "";  
$dbname = "signup_page";  

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $first_name = $_POST["firstname"];
    $last_name = $_POST["lastname"];
    $email = $_POST["email"];
    $password = $_POST["password"];
    $phone = $_POST["Phone"];
    $age = $_POST["age"];
    $gender = $_POST["gender"];

    $sql = "INSERT INTO users (first_name, last_name, email, password, phone, age, gender)
            VALUES ('$first_name', '$last_name', '$email', '$password', '$phone', $age, '$gender')";

    if ($conn->query($sql) === TRUE) {
        echo "New record created successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

$conn->close();