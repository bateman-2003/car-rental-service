<?php
// Include database connection file
require_once "includes/db_connect.php";

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

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <div class="container">
        <h2>Registration Form</h2>
        <form action="register.php" method="post">
            <label for="username">Username:</label>
            <input type="text" id="username" name="username" required><br><br>
            
            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required><br><br>
            
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required><br><br>
            
            <label for="phone">Phone:</label>
            <input type="text" id="phone" name="phone" required><br><br>
            
            <input type="submit" value="Register">
        </form>
    </div>
</body>
</html>
