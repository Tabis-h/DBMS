<?php
include 'db_connection.php';

// Fetch and display fees payment information
$sql = "SELECT * FROM fees_payment";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo '<ul>';
    while ($row = $result->fetch_assoc()) {
        echo '<li>' . $row['fullname'] . ' - Amount: ' . $row['amount'] . '</li>';
    }
    echo '</ul>';
} else {
    echo 'No fees payment records.';
}

$conn->close();
?>
