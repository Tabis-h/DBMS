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

// Check if the form for removing a course is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['remove_course'])) {
    $course_to_remove = $_POST['course_to_remove'];

    // Check if the selected course exists
    $check_sql = "SELECT * FROM courses WHERE course_name = '$course_to_remove'";
    $check_result = $conn->query($check_sql);

    if ($check_result->num_rows > 0) {
        // Course exists, proceed with deletion
        $remove_sql = "DELETE FROM courses WHERE course_name = '$course_to_remove'";
        
        if ($conn->query($remove_sql) === TRUE) {
            echo "Course removed successfully!";
        } else {
            echo "Error removing course: " . $conn->error;
        }
    } else {
        echo "Course does not exist.";
    }
}

// Fetch the list of existing courses from the database
$sql = "SELECT * FROM courses";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Courses - Car Driving School</title>
    <link rel="stylesheet" href="admin-dashboard-style.css">
</head>

<body>

    <header>
        <h1>Manage Courses</h1>
        <style> body {
    font-family: Arial, sans-serif;
    background-color: #f4f4f4;
    margin: 0;
    padding: 0;
    display: flex;
    flex-direction: column;
    align-items: center;
}

header {
    background-color: #333;
    color: white;
    padding: 10px;
    text-align: center;
    width: 100%;
}

#manageCoursesSection {
    margin-top: 20px;
    width: 50%;
}

form {
    background-color: #fff;
    padding: 20px;
    border-radius: 8px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    margin-bottom: 20px;
}

label {
    display: block;
    margin-bottom: 10px;
    color: #555;
}

input,
select {
    width: 100%;
    padding: 8px;
    margin-bottom: 15px;
    box-sizing: border-box;
    border: 1px solid #ccc;
    border-radius: 4px;
}

button {
    background-color: #4caf50;
    color: white;
    padding: 10px;
    border: none;
    border-radius: 4px;
    cursor: pointer;
    width: 100%;
}

button:hover {
    background-color: #45a049;
}

a {
    color: #333;
    text-decoration: none;
    margin-top: 10px;
}

a:hover {
    text-decoration: underline;
}

    </style>
    </header>

    <section id="manageCoursesSection">
        <h2>Add New Course</h2>
        <form method="post" action="">
            <label for="new_course">Course Name:</label>
            <input type="text" id="new_course" name="new_course" required>
            <button type="submit" name="add_course">Add Course</button>
        </form>

        <h2>Remove Course</h2>
        <form method="post" action="">
            <label for="course_to_remove">Select Course:</label>
            <select name="course_to_remove" id="course_to_remove" required>
                <?php
                // Loop through the fetched courses and display them in the dropdown
                while ($row = $result->fetch_assoc()) {
                    echo "<option value='" . $row['course_name'] . "'>" . $row['course_name'] . "</option>";
                }
                ?>
            </select>
            <button type="submit" name="remove_course">Remove Course</button>
        </form>
    </section>

    <a href="admin-dashboard.html">Back to Dashboard</a>

</body>

</html>

<?php
// Close the database connection
$conn->close();
?>
