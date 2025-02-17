<?php
$servername = "localhost"; // Change if using a different host
$username = "root"; // Your MySQL username
$password = ""; // Your MySQL password
$database = "user"; // Your database name

$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
