<?php
// db.php
$servername = "localhost";
$username = "root";       // your MySQL username
$password = "";           // your MySQL password (default is empty for XAMPP)
$dbname = "ema_project";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
