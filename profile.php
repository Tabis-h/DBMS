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
                <input type="text" id="firstName" name="firstName" required>
            </div>

            <div class="form-group">
                <label for="lastName">Last Name:</label>
                <input type="text" id="lastName" name="lastName" required>
            </div>

            <div class="form-group">
                <label for="contactNumber">Contact Number:</label>
                <input type="tel" id="contactNumber" name="contactNumber" required>
            </div>

            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" required>
            </div>

            <div class="form-group">
                <label for="registrationDate">Registration Date:</label>
                <input type="text" id="registrationDate" name="registrationDate" readonly>
            </div>

            <button type="button" onclick="updateProfile()">Update</button>
        </form>
    </div>

    <script>
        // Assuming you have a function to fetch and populate user data
        function populateProfile() {
            // Fetch user data and populate the input fields
            // For example, you can use an API call or retrieve data from your database
            // Dummy data for demonstration purposes:
            document.getElementById('firstName').value = 'John';
            document.getElementById('lastName').value = 'Doe';
            document.getElementById('contactNumber').value = '+1234567890';
            document.getElementById('email').value = 'john.doe@example.com';
            document.getElementById('registrationDate').value = '2022-01-01'; // Replace with actual registration date
        }

        function updateProfile() {
            // Perform the update action
            // For example, you can use an API call to update user data
            // Dummy action for demonstration purposes:
            alert('Profile updated successfully!');
        }

        // Populate the profile form when the page loads
        document.addEventListener('DOMContentLoaded', function () {
            populateProfile();
        });
    </script>
</body>

</html>
