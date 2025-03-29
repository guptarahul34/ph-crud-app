<?php
$host = "db";
$username = "root"; // Change as per your MySQL credentials
$password = "rahulgupta";
$dbname = "student";

// Create connection
$conn = new mysqli($host, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
