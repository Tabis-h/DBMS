<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Car Driving School</title>
    <link rel="stylesheet" href="index-style.css">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css"
        integrity="sha512-BFVHzxhpr3sKJRDXmLW3o2ZUvZl+g1yUWRwBzCGj8v7+/Hc1hvDdE4Lk8tntDxG4Hs2NoOJ/N6tCx9e9VTJlbA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    
</head>

<body>

    <header>
        <h1 style="margin-bottom: 0;">Car Driving School</h1>
        <button class="admin-btn" onclick="redirectToAdmin()">Admin</button>
    </header>

    <nav>
        <a href="#" onclick="toggleCourses()">Courses</a>
        <a href="enrollment.php">Enrollment</a>
        <a href="login.php">Login</a>
        <div class="user-profile-btn">
            <button class="dropbtn">Profile <i class="fas fa-caret-down"></i></button>
            <div class="dropdown-content">
                <a href="profile.php">Profile</a>
                <a href="#">Settings</a>
                <a href="#">Logout</a>
            </div>
        </div>
    </nav>

    <section id="coursesSection" style="display: none;">
        <h2>Courses Offered</h2>
        <table>
            <thead>
                <tr>
                    <th>Course</th>
                    <th>Fees (Rs)</th>
                    <th>Course Length</th>
                    <th>Timing</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>SUV Driving Course</td>
                    <td>9000</td>
                    <td>6 weeks</td>
                    <td>Mon-Fri, 9 am - 12 pm</td>
                </tr>
                <tr>
                    <td>SUV Driving Course</td>
                    <td>7000</td>
                    <td>8 weeks</td>
                    <td>Mon-Fri, 2 pm - 5 pm</td>
                </tr>
                <tr>
                    <td>SUV Driving Course</td>
                    <td>5000</td>
                    <td>9 weeks</td>
                    <td>Sat-Sun, 10 am - 1 pm</td>
                </tr>
                <!-- Add more courses as needed -->
            </tbody>
        </table>
    </section>

    <footer>
        <p>&copy; 2024 Car Driving School</p>
    </footer>

    <script>
        function toggleCourses() {
            var coursesSection = document.getElementById("coursesSection");
            coursesSection.style.display = (coursesSection.style.display === "none") ? "block" : "none";
        }

        function redirectToAdmin() {
            // Redirect to admin page or perform admin-related actions
            alert("Redirecting to Admin Page");
        }
    </script>
</body>

</html>
