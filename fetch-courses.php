<?php
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

// Fetch courses from the database
$sql = "SELECT * FROM courses";
$result = $conn->query($sql);

$courses = array();

while ($row = $result->fetch_assoc()) {
    $courses[] = $row['course_name'];
}

// Output the courses as a JSON response
echo json_encode($courses);

$conn->close();
?>
