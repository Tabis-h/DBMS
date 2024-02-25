<?php



$servername = "localhost";
$username = "root";
$password = "";
$dbname = "signup_page";


$conn = new mysqli($servername, $username, $password, $dbname);


if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


$courses_sql = "SELECT course_name, fee, course_length, timing FROM courses";
$courses_result = $conn->query($courses_sql);


$courses_data = array();
if ($courses_result->num_rows > 0) {
    while ($row = $courses_result->fetch_assoc()) {
        $courses_data[] = $row;
    }
}


$conn->close();


header('Content-Type: application/json');
echo json_encode($courses_data);

