<?php
session_start();
include('db_connection.php');

// Check if the user is not logged in, redirect to login page
if (!isset($_SESSION['user_id'])) {
    header('location: login.html');
    exit();
}

// Fetch user data from the database using the stored user ID
$userId = $_SESSION['user_id'];
$query = "SELECT * FROM users WHERE user_id='$userId'";
$result = mysqli_query($db, $query);

if ($result && mysqli_num_rows($result) == 1) {
    $user = mysqli_fetch_assoc($result);
} else {
    // Handle the case where the user is not found
    // You can redirect to an error page or handle it based on your requirements
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile Page</title>
    <link rel="stylesheet" href="profile-style.css">
</head>

<body>

    <div class="profile-container">
        <h2>Your Profile</h2>
        <form id="profile-form">
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

            <div class="form-group">
                <label for="registrationDate">Registration Date:</label>
                <input type="text" id="registrationDate" name="registrationDate" value="<?php echo $user['registration_date']; ?>" readonly>
            </div>

            <button type="button" onclick="updateProfile()">Update</button>
        </form>
    </div>

    <script>
        // Function to update the profile (you can implement this function as needed)
        function updateProfile() {
            // Perform the update action
            // For example, you can use an API call to update user data
            // Dummy action for demonstration purposes:
            alert('Profile updated successfully!');
        }
    </script>
</body>

</html>
