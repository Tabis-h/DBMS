<?php
include('db_connection.php');

// Fetch available employees from the database
$sql_employees = "SELECT * FROM employees";
$result_employees = $db->query($sql_employees);

if (!$result_employees) {
    die("Error fetching employees: " . $db->error);
}

// Fetch available students from the enrollment_data table
$sql_students = "SELECT * FROM enrollment_data";
$result_students = $db->query($sql_students);

if (!$result_students) {
    die("Error fetching students: " . $db->error);
}

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve employee ID and student ID from the form
    $employee_id = $_POST['employee_id'];
    $student_id = $_POST['student_id'];

    // Prepare and execute the SQL query to insert the assignment into the database
    $sql_insert_assignment = "INSERT INTO employee_student_assignment (emp_id, enr_id) VALUES (?, ?)";
    $stmt = $db->prepare($sql_insert_assignment);
    $stmt->bind_param("ii", $employee_id, $student_id);

    if ($stmt->execute()) {
        echo "Employee assigned to student successfully.";
    } else {
        echo "Error assigning employee to student: " . $stmt->error;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Assign Employees - Car Driving School</title>
    <link rel="stylesheet" href="admin-dashboard-style.css">
</head>
<body>
    <header>
        <h1>Assign Employees to Students</h1>
    </header>
    <section id="adminDashboardSection">
        <div class="dashboard-content">
            <h3>Available Employees</h3>
            <ul>
                <?php while ($row_employee = $result_employees->fetch_assoc()): ?>
                    <li><?php echo $row_employee['name']; ?> (Handling: <?php echo $row_employee['course_hand']; ?>)</li>
                <?php endwhile; ?>
            </ul>
        </div>
        <div class="dashboard-content">
            <h3>Assign Employees to Students</h3>
            <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                <!-- Dropdown to select employee -->
                <select name="employee_id">
                    <?php 
                    // Reset the pointer to fetch the employees again
                    $result_employees->data_seek(0);
                    while ($row_employee = $result_employees->fetch_assoc()): 
                    ?>
                        <option value="<?php echo $row_employee['emp_id']; ?>"><?php echo $row_employee['name']; ?></option>
                    <?php endwhile; ?>
                </select>
                <!-- Dropdown to select student -->
                <select name="student_id">
                    <?php 
                    // Reset the pointer to fetch the students again
                    $result_students->data_seek(0);
                    while ($row_student = $result_students->fetch_assoc()): 
                    ?>
                        <option value="<?php echo $row_student['enr_id']; ?>"><?php echo $row_student['fullname']; ?></option>
                    <?php endwhile; ?>
                </select>
                <button type="submit">Assign Employee</button>
            </form>
        </div>
        <a href="admin-dashboard.php">Back to Dashboard</a>
    </section>
</body>
</html>

<?php $db->close(); ?>
