<?php
$servername = "localhost"; // Replace with your actual MySQL server name
$username = "root"; // Replace with your actual MySQL username
$password = ""; // Replace with your actual MySQL password
$dbname = "signup_page"; // Replace with your actual MySQL database name

// Create connection
$db = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($db->connect_error) {
    die("Connection failed: " . $db->connect_error);
}

// Optionally, set character set to utf8
$db->set_charset("utf8");
?>
