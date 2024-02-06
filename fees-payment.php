<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fees Payment - Admin Panel</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 20px;
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

        .edit-fees {
            margin-top: 20px;
            width: 80%;
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            display: flex;
            flex-direction: column;
        }

        label {
            display: block;
            margin-bottom: 10px;
            color: #555;
        }

        input {
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
            margin: 0 auto;
        }

        button:hover {
            background-color: #45a049;
        }
    </style>
</head>

<body>

    <h1>Fees Payment - Admin Panel</h1>

    <?php
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "signup_page";
    ?>
</body>

</html>
<?php

    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $courses_sql = "SELECT e.id, e.fullname, e.email, c.course_name, c.fee, c.paid_fee FROM enrollment_data e JOIN courses c ON e.id = c.id";
    $courses_result = $conn->query($courses_sql);

    if ($courses_result->num_rows > 0) {
        echo "<form method='post'>";
        echo "<table>";
        echo "<tr><th>Full Name</th><th>Email</th><th>Course Name</th><th>Fees</th><th>Paid Fees</th><th>Update</th></tr>";

        while ($row = $courses_result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . $row['fullname'] . "</td>";
            echo "<td>" . $row['email'] . "</td>";
            echo "<td>" . $row['course_name'] . "</td>";
            echo "<td>" . $row['fee'] . "</td>";
            echo "<td contenteditable='true' onBlur='updatePaidFee(this,\"" . $row['id'] . "\")'>" . $row['paid_fee'] . "</td>";
            echo "<td><button type='button' onclick='updateRow(\"" . $row['id'] . "\", \"" . $row['paid_fee'] . "\")'>Update</button></td>";
            echo "</tr>";
        }

        echo "</table>";
        echo "</form>";
    } else {
        echo "No courses found.";
    }

    $conn->close();
    ?>

    <script>
        function updatePaidFee(element, studentId) {
            var paidFee = element.innerText.trim();

            var hiddenInput = document.getElementById("hiddenInput");
            hiddenInput.value += studentId + ":" + paidFee + ",";
        }

        function updateRow(studentId, paidFee) {

            var xhttp = new XMLHttpRequest();
            xhttp.onreadystatechange = function () {
                if (this.readyState == 4 && this.status == 200) {
                    console.log(this.responseText);
                }
            };
            xhttp.open("POST", "update_paid_fee.php", true);
            xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            xhttp.send("studentId=" + studentId + "&paidFee=" + paidFee);
        }
    </script>

    <!-- Hidden input field to store updated paid fees -->
    <input type="hidden" id="hiddenInput" name="updatedFees" value="">

    <!-- Submit button to update all rows -->

</body>

</html>