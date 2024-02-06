<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "signup_page";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT * FROM courses";
$result = $conn->query($sql);

$courses = array();

while ($row = $result->fetch_assoc()) {
    $courses[] = $row['course_name'];
}

echo json_encode($courses);

$conn->close();
