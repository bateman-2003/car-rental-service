<?php
// Include database connection file
require_once "../includes/db_connect.php";

// Check if the registration form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve user input from the form
    $username = $_POST["username"];
    $password = $_POST["password"];
    $user_type = "Customer"; // Assuming all registrations are for customers
    $email = $_POST["email"];
    $phone = $_POST["phone"];
    
    // Prepare SQL statement
    $stmt = $conn->prepare("INSERT INTO users (username, password, user_type, email, phone) VALUES (?, ?, ?, ?, ?)");

    // Bind parameters
    $stmt->bind_param("sssss", $username, $password, $user_type, $email, $phone);

    // Execute the statement
    if ($stmt->execute()) {
        echo "New record created successfully";
    } else {
        echo "Error: " . $stmt->error;
    }

    // Close statement
    $stmt->close();
}
?>
