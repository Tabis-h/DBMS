<?php
include('db_connection.php');


$sql = "SELECT * FROM employees";
$result = $db->query($sql);

if (!$result) {
    die("Error fetching employees: " . $db->error);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Employee Management - Car Driving School</title>
    <link rel="stylesheet" href="admin-dashboard-style.css">
    <style>
        
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        th, td {
            padding: 8px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }
        th {
            background-color: #f2f2f2;
        }
        form {
            max-width: 400px;
            margin-top: 20px;
        }
        input[type="text"],
        input[type="email"],
        button[type="submit"] {
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
        <h1>Employee Management</h1>
    </header>
    <section id="adminDashboardSection">
        <div class="dashboard-content">
            <h3>Manage Employees</h3>
            <?php if ($result->num_rows > 0): ?>
                <table>
                    <tr>
                        <th>Employee ID</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Course Hand</th>
                        
                    </tr>
                    <?php while ($row = $result->fetch_assoc()): ?>
                        <tr>
                            <td><?php echo $row['emp_id']; ?></td>
                            <td><?php echo $row['name']; ?></td>
                            <td><?php echo $row['email']; ?></td>
                            <td><?php echo $row['course_hand']; ?></td>
                            
                        </tr>
                    <?php endwhile; ?>
                </table>
            <?php else: ?>
                <p>No employees found.</p>
            <?php endif; ?>
        </div>
        <div class="dashboard-content">
            <h3>Add Employee</h3>
            
            <form method="post" action="add_employee.php">
                <input type="text" name="name" placeholder="Employee Name">
                <input type="email" name="email" placeholder="Employee Email">
                <input type="text" name="course_hand" placeholder="Course Hand">
                
                <button type="submit">Add Employee</button>
            </form>
        </div>
        <a href="admin-dashboard.php">Back to Dashboard</a>
    </section>
</body>
</html>
