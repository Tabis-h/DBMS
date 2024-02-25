<?php
// Include database connection code here (if not already included)

// Assuming you have a database connection established
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "signup_page";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch courses and their fees from the database
$courses_sql = "SELECT course_name, fee, course_length, timing FROM courses";
$courses_result = $conn->query($courses_sql);

// Store the fetched courses in an array
$courses_data = array();
if ($courses_result->num_rows > 0) {
    while ($row = $courses_result->fetch_assoc()) {
        $courses_data[] = $row;
    }
}

// Close the database connection
$conn->close();

// Return JSON response with the course data
header('Content-Type: application/json');
echo json_encode($courses_data);

