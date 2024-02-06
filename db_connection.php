<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "signup_page";

$db = new mysqli($servername, $username, $password, $dbname);

if ($db->connect_error) {
    die("Connection failed: " . $db->connect_error);
}

$db->set_charset("utf8");
?>
