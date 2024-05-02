<?php
$host = "localhost"; // Change this to your database host
$username = "username"; // Change this to your database username
$password = "password"; // Change this to your database password
$database = "id22113770_car_rental_system"; // Change this to your database name

// Create connection
$conn = new mysqli($host, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
// Uncomment the line below if you want to display a success message
// echo "Connected successfully";
?>
