<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fees Payment - Admin Panel</title>
    <style>
        table {
            width: 80%;
            margin-top: 20px;
            border-collapse: collapse;
        }

        th, td {
            border: 1px solid #ddd;
            padding: 10px;
            text-align: left;
        }

        th {
            background-color: #4caf50;
            color: white;
        }

        tr:hover {
            background-color: #f5f5f5;
        }
    </style>
</head>

<body>

    <h1>Fees Payment - Admin Panel</h1>

    <?php
    // Database configuration
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "signup_page";

    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Handle updating paid fees
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["studentId"]) && isset($_POST["paidFees"])) {
        $studentId = $_POST["studentId"];
        $paidFees = $_POST["paidFees"];

        // Update paid fees in the database
        $update_sql = "UPDATE enrollment_data SET paid_fee = '$paidFees' WHERE id = $studentId";
        if ($conn->query($update_sql) === TRUE) {
            echo "Paid fees updated successfully!";
        } else {
            echo "Error updating paid fees: " . $conn->error;
        }
    }

    // Fetch data from enrollment_data table
    $enrollment_sql = "SELECT id, fullname, email, id, paid_fee FROM enrollment_data";
    $enrollment_result = $conn->query($enrollment_sql);

    // Fetch data from courses table
    $courses_sql = "SELECT id, course_name, fee FROM courses";
    $courses_result = $conn->query($courses_sql);

    if ($enrollment_result->num_rows > 0 && $courses_result->num_rows > 0) {
        echo "<table>";
        echo "<tr><th>Full Name</th><th>Email</th><th>Course Name</th><th>Fees</th><th>Paid Fees</th><th>Action</th></tr>";

        // Loop through each enrollment row
        while ($enrollment_row = $enrollment_result->fetch_assoc()) {
            // Fetch corresponding course details using course ID
            $id = $enrollment_row['id'];
            $course_sql = "SELECT course_name, fee FROM courses WHERE id = $id";
            $course_result = $conn->query($course_sql);

            if ($course_result && $course_result->num_rows > 0) {
                $course_row = $course_result->fetch_assoc();
                echo "<tr data-id='" . $enrollment_row['id'] . "'>";
                echo "<td>" . $enrollment_row['fullname'] . "</td>";
                echo "<td>" . $enrollment_row['email'] . "</td>";
                echo "<td>" . $course_row['course_name'] . "</td>";
                echo "<td>" . $course_row['fee'] . "</td>";
                echo "<td contenteditable='true'>" . $enrollment_row['paid_fee'] . "</td>";
                echo "<td><button onclick='updatePaidFee(" . $enrollment_row['id'] . ", \"" . $course_row['course_name'] . "\", \"" . $course_row['fee'] . "\")'>Update</button></td>";
                echo "</tr>";
            } else {
                echo "<tr><td colspan='6'>Error: Failed to fetch course details for student ID: " . $enrollment_row['id'] . "</td></tr>";
            }
        }

        echo "</table>";
    } else {
        echo "No data found.";
    }

    $conn->close();
    ?>


    <script>
        function updatePaidFee(studentId, courseName, fee) {
            var row = document.querySelector("tr[data-id='" + studentId + "']");
            var paidFees = row.querySelector("td:nth-child(5)").innerText.trim();

            // Update paid fees in the database using form submission
            var form = document.createElement("form");
            form.method = "post";
            form.action = "";
            form.style.display = "none";
            document.body.appendChild(form);

            var inputId = document.createElement("input");
            inputId.type = "hidden";
            inputId.name = "studentId";
            inputId.value = studentId;
            form.appendChild(inputId);

            var inputPaidFees = document.createElement("input");
            inputPaidFees.type = "hidden";
            inputPaidFees.name = "paidFees";
            inputPaidFees.value = paidFees;
            form.appendChild(inputPaidFees);

            form.submit();
        }
    </script>

</body>

</html>
