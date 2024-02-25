<?php
session_start();


if (isset($_GET['logout'])) {
    session_destroy();
    header("Location: index.php"); 
    exit();
}


$isLoggedIn = isset($_SESSION['user_id']);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Car Driving School</title>
    <link rel="stylesheet" href="index-style.css">
    <link rel="stylesheet" href="https:
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
        <a href="enrollment.html">Enrollment</a>
        <?php if ($isLoggedIn) : ?>
            <a href="?logout" class="logout-btn">Logout</a>
        <?php else : ?>
            <a href="login.php">Login</a>
        <?php endif; ?>
        <div class="user-profile-btn">
            <button class="dropbtn">Profile <i class="fas fa-caret-down"></i></button>
            <div class="dropdown-content">
                <a href="profile.php">Profile</a>                
            </div>
        </div>
    </nav>

    <section id="coursesSection" style="display: none;">
        <h2>Courses Offered</h2>
        <table id="coursesTable">
            <thead>
                <tr>
                    <th>Course</th>
                    <th>Fees (Rs)</th>
                    <th>Course Length</th>
                    <th>Timing</th>
                </tr>
            </thead>
            <tbody id="coursesData">
                <!-- Course data will be dynamically added here -->
            </tbody>
        </table>
    </section>

    <footer>
        <p>&copy; 2024 Car Driving School</p>
    </footer>

    <script>
        function redirectToAdmin() {
            
            window.location.href = 'admin-login.html';
        }

        function toggleCourses() {
            var coursesSection = document.getElementById('coursesSection');
            if (coursesSection.style.display === 'none') {
                coursesSection.style.display = 'block';
                fetchCourses();
            } else {
                coursesSection.style.display = 'none';
            }
        }

        function fetchCourses() {
            fetch('fetch_courses.php')
                .then(response => response.json())
                .then(data => {
                    var coursesData = document.getElementById('coursesData');
                    coursesData.innerHTML = ''; 

                    data.forEach(course => {
                        var row = document.createElement('tr');
                        row.innerHTML = `
                            <td>${course.course_name}</td>
                            <td>${course.fee}</td>
                            <td>${course.course_length}</td>
                            <td>${course.timing}</td>
                        `;
                        coursesData.appendChild(row);
                    });
                })
                .catch(error => console.error('Error fetching courses:', error));
        }
    </script>
</body>

</html>
