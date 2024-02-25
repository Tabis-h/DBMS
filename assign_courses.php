<?php
include('db_connection.php');

// Check if the form is submitted for assigning a course
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['assign_course'])) {
    // Retrieve employee ID and course ID from the form
    $employee_id = $_POST['employee_id'];
    $course_id = $_POST['course_id'];

    // Fetch employee name from the database based on the selected employee ID
    $sql_employee_name = "SELECT name FROM employees WHERE emp_id = ?";
    $stmt_employee_name = $db->prepare($sql_employee_name);
    $stmt_employee_name->bind_param("i", $employee_id);
    $stmt_employee_name->execute();
    $result_employee_name = $stmt_employee_name->get_result();
    $row_employee_name = $result_employee_name->fetch_assoc();
    $employee_name = $row_employee_name['name'];

    // Fetch course name from the database based on the selected course ID
    $sql_course_name = "SELECT course_name FROM courses WHERE c_id = ?";
    $stmt_course_name = $db->prepare($sql_course_name);
    $stmt_course_name->bind_param("i", $course_id);
    $stmt_course_name->execute();
    $result_course_name = $stmt_course_name->get_result();
    $row_course_name = $result_course_name->fetch_assoc();
    $course_name = $row_course_name['course_name'];

    // Prepare and execute the SQL query to insert the assignment into the database
    $sql_insert = "INSERT INTO employee_course_assignment (emp_id, emp_name, c_id, course_name) VALUES (?, ?, ?, ?)";
    $stmt = $db->prepare($sql_insert);
    $stmt->bind_param("isss", $employee_id, $employee_name, $course_id, $course_name);

    if ($stmt->execute()) {
        echo "Course assigned successfully.";
    } else {
        echo "Error assigning course: " . $stmt->error;
    }
}

// Check if the form is submitted for removing an assigned course
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['remove_course'])) {
    // Retrieve the ID of the assigned course to remove
    $assigned_course_id = $_POST['assigned_course_id'];

    // Prepare and execute the SQL query to delete the assigned course from the database
    $sql_delete = "DELETE FROM employee_course_assignment WHERE emp_id = ?";
    $stmt = $db->prepare($sql_delete);
    $stmt->bind_param("i", $assigned_course_id);

    if ($stmt->execute()) {
        echo "Assigned course removed successfully.";
    } else {
        echo "Error removing assigned course: " . $stmt->error;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Assign Courses - Car Driving School</title>
    <link rel="stylesheet" href="admin-dashboard-style.css">
    <style>
        /* Add custom CSS for improved appearance */
        form {
            max-width: 400px;
            margin-top: 20px;
        }
        select, button[type="submit"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }
        button[type="submit"] {
            background-color: #4CAF50;
            color: white;
            cursor: pointer;
        }
        button[type="submit"]:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>
    <header>
        <h1>Assign Courses to Employees</h1>
    </header>
    <section id="adminDashboardSection">
        <div class="dashboard-content">
            <h3>Assign Courses</h3>
            <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                <select name="employee_id">
                    <?php 
                    $sql_employees = "SELECT * FROM employees";
                    $result_employees = $db->query($sql_employees);
                    if ($result_employees->num_rows > 0) {
                        while ($row = $result_employees->fetch_assoc()): 
                    ?>
                        <option value="<?php echo $row['emp_id']; ?>"><?php echo $row['name'] . " (ID: " . $row['emp_id'] . ")"; ?></option>
                    <?php 
                        endwhile; 
                    } else {
                        echo "<option value=''>No employees found</option>";
                    }
                    ?>
                </select>
                <select name="course_id">
                    <?php 
                    $sql_courses = "SELECT * FROM courses";
                    $result_courses = $db->query($sql_courses);
                    if ($result_courses->num_rows > 0) {
                        while ($row = $result_courses->fetch_assoc()): 
                    ?>
                        <option value="<?php echo $row['c_id']; ?>"><?php echo $row['course_name'] . " (ID: " . $row['c_id'] . ")"; ?></option>
                    <?php 
                        endwhile; 
                    } else {
                        echo "<option value=''>No courses found</option>";
                    }
                    ?>
                </select>
                <button type="submit" name="assign_course">Assign Course</button>
            </form>
        </div>
        <div class="dashboard-content">
            <h3>Remove Assigned Courses</h3>
            <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                <select name="assigned_course_id">
                    <?php 
                    $sql_assigned_courses = "SELECT * FROM employee_course_assignment";
                    $result_assigned_courses = $db->query($sql_assigned_courses);
                    if ($result_assigned_courses->num_rows > 0) {
                        while ($row = $result_assigned_courses->fetch_assoc()): 
                    ?>
                        <option value="<?php echo $row['emp_id']; ?>"><?php echo $row['emp_name'] . " - " . $row['course_name']; ?></option>
                    <?php 
                        endwhile; 
                    } else {
                        echo "<option value=''>No assigned courses found</option>";
                    }
                    ?>
                </select>
                <button type="submit" name="remove_course">Remove Course</button>
            </form>
        </div>
        <a href="admin-dashboard.php">Back to Dashboard</a>
    </section>
</body>
</html>
