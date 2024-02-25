<?php
session_start();
include('db_connection.php');

if (!isset($_SESSION['user_id'])) {
    header('location: login.php');
    exit();
}

$userId = $_SESSION['user_id'];

// Fetch user details from the database based on user_id
$query = "SELECT * FROM users WHERE user_id='$userId'";
$result = mysqli_query($db, $query);

if ($result && mysqli_num_rows($result) == 1) {
    $user = mysqli_fetch_assoc($result);
} else {
    // Handle error or redirect
}

// Fetch assigned employee details based on user ID
$sql = "SELECT employees.emp_id, employees.name, employees.email, employees.course_hand
        FROM users
        JOIN enrollment_data ON users.user_id = enrollment_data.user_id
        JOIN employee_student_assignment ON enrollment_data.enr_id = employee_student_assignment.enr_id
        JOIN employees ON employee_student_assignment.emp_id = employees.emp_id
        WHERE users.user_id = '$userId'";
$result_assigned_employee = mysqli_query($db, $sql);

// Check if the form is submitted for updating user details
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $firstName = $_POST['firstName'];
    $lastName = $_POST['lastName'];
    $contactNumber = $_POST['contactNumber'];
    $email = $_POST['email'];

    // Update user details in the database
    $updateQuery = "UPDATE users SET first_name='$firstName', last_name='$lastName', phone='$contactNumber', email='$email' WHERE user_id='$userId'";
    $updateResult = mysqli_query($db, $updateQuery);

    if ($updateResult) {
        // Redirect to the same page to refresh the profile with updated details
        header('Location: profile.php');
        exit();
    } else {
        // Handle error
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile Page</title>
    <style>
body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
            color: #333;
        }

        .profile-container {
            max-width: 600px;
            margin: 50px auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        h2 {
            text-align: center;
            color: #3498db;
        }

        p {
            margin-bottom: 10px;
        }

        #employeeDetails {
            border-top: 1px solid #ccc;
            padding-top: 10px;
        }

        .edit-form {
            display: none;
        }

        .edit-btn {
            margin-top: 20px;
            text-align: center;
        }

        .edit-btn button {
            background-color: #3498db;
            color: #fff;
            padding: 8px 12px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        .edit-btn button:hover {
            background-color: #2980b9;
        }    </style>
</head>
<body>

<div class="profile-container">
    <h2>Your Profile</h2>
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <div class="form-group">
            <label for="firstName">First Name:</label>
            <input type="text" id="firstName" name="firstName" value="<?php echo $user['first_name']; ?>" required>
        </div>

        <div class="form-group">
            <label for="lastName">Last Name:</label>
            <input type="text" id="lastName" name="lastName" value="<?php echo $user['last_name']; ?>" required>
        </div>

        <div class="form-group">
            <label for="contactNumber">Contact Number:</label>
            <input type="tel" id="contactNumber" name="contactNumber" value="<?php echo $user['phone']; ?>" required>
        </div>

        <div class="form-group">
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" value="<?php echo $user['email']; ?>" required>
        </div>

        <button type="submit">Update</button>
    </form>

    <h2>Assigned Employee Details</h2>
    <div id="employeeDetails">
        <?php if ($result_assigned_employee && mysqli_num_rows($result_assigned_employee) > 0): ?>
            <?php while ($row = mysqli_fetch_assoc($result_assigned_employee)): ?>
                <p>Employee ID: <?php echo $row['emp_id']; ?></p>
                <p>Name: <?php echo $row['name']; ?></p>
                <p>Email: <?php echo $row['email']; ?></p>
                <p>Course Hand: <?php echo $row['course_hand']; ?></p>
            <?php endwhile; ?>
        <?php else: ?>
            <p>No assigned employee found.</p>
        <?php endif; ?>
    </div>
</div>

</body>
</html>
