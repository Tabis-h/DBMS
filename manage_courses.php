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
    if (isset($_POST['add_course'])) {
        $new_course = mysqli_real_escape_string($conn, $_POST['new_course']);
        $insert_course_sql = "INSERT INTO courses (course_name) VALUES ('$new_course')";
        if ($conn->query($insert_course_sql) === TRUE) {
            echo "Course added successfully!";
        } else {
            echo "Error adding course: " . $conn->error;
        }
    } elseif (isset($_POST['remove_course'])) {
        $course_to_remove = $_POST['course_to_remove'];
        $remove_course_sql = "DELETE FROM courses WHERE course_name = '$course_to_remove'";
        if ($conn->query($remove_course_sql) === TRUE) {
            echo "Course removed successfully!";
        } else {
            echo "Error removing course: " . $conn->error;
        }
    } elseif (isset($_POST['update_fees'])) {
        $course_to_update = mysqli_real_escape_string($conn, $_POST['course_to_update']);
        $new_fee = mysqli_real_escape_string($conn, $_POST['new_fee']);
        $update_fee_sql = "UPDATE courses SET fee = $new_fee WHERE course_name = '$course_to_update'";
        if ($conn->query($update_fee_sql) === TRUE) {
            echo "Fees updated successfully!";
        } else {
            echo "Error updating fees: " . $conn->error;
        }
    } elseif (isset($_POST['update_timing_length'])) {
        $course_to_update_timing_length = mysqli_real_escape_string($conn, $_POST['course_to_update_timing_length']);
        $new_timing = mysqli_real_escape_string($conn, $_POST['new_timing']);
        $new_length = mysqli_real_escape_string($conn, $_POST['new_length']);
        $update_timing_length_sql = "UPDATE courses SET timing = '$new_timing', course_length = '$new_length' WHERE course_name = '$course_to_update_timing_length'";
        if ($conn->query($update_timing_length_sql) === TRUE) {
            echo "Timing and length updated successfully!";
        } else {
            echo "Error updating timing and length: " . $conn->error;
        }
    }
}

$courses_sql = "SELECT * FROM courses";
$courses_result = $conn->query($courses_sql);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Courses - Admin Panel</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        h1 {
            background-color: #333;
            color: white;
            padding: 10px;
            text-align: center;
            width: 100%;
        }

        section {
            margin-top: 20px;
            width: 50%;
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
    </style>
</head>

<body>

    <h1>Manage Courses - Admin Panel</h1>

    
    <section>
        <h2>Add New Course</h2>
        <form method="post" action="">
            <label for="new_course">Course Name:</label>
            <input type="text" id="new_course" name="new_course" required>
            <button type="submit" name="add_course">Add Course</button>
        </form>
    </section>

    
    <section>
        <h2>Remove Course</h2>
        <form method="post" action="">
            <label for="course_to_remove">Select Course:</label>
            <select name="course_to_remove" id="course_to_remove" required>
                <?php
                while ($row = $courses_result->fetch_assoc()) {
                    echo "<option value='" . $row['course_name'] . "'>" . $row['course_name'] . "</option>";
                }
                mysqli_data_seek($courses_result, 0);
                ?>
            </select>
            <button type="submit" name="remove_course">Remove Course</button>
        </form>
    </section>

    
    <section>
        <h2>Update Fees</h2>
        <form method="post" action="">
            <label for="course_to_update">Select Course:</label>
            <select name="course_to_update" id="course_to_update" required>
                <?php
                while ($row = $courses_result->fetch_assoc()) {
                    echo "<option value='" . $row['course_name'] . "'>" . $row['course_name'] . "</option>";
                }
                ?>
            </select>
            <label for="new_fee">New Fee:</label>
            <input type="number" id="new_fee" name="new_fee" step="0.01" required>
            <button type="submit" name="update_fees">Update Fees</button>
        </form>
    </section>

   
<section>
    <h2>Update Timing and Length</h2>
    <form method="post" action="">
        <label for="course_to_update_timing_length">Select Course:</label>
        <select name="course_to_update_timing_length" id="course_to_update_timing_length" required>
            <?php
            
            mysqli_data_seek($courses_result, 0);
            while ($row = $courses_result->fetch_assoc()) {
                echo "<option value='" . $row['course_name'] . "'>" . $row['course_name'] . "</option>";
            }
            ?>
        </select>
        <label for="new_timing">New Timing:</label>
        <input type="text" id="new_timing" name="new_timing" required>
        <label for="new_length">New Length:</label>
        <input type="text" id="new_length" name="new_length" required>
        <button type="submit" name="update_timing_length">Update Timing and Length</button>
    </form>
</section>

    

</body>

</html>

<?php
$conn->close();
?>
