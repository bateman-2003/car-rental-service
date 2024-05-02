<?php
// Include database connection file
require_once "../includes/db_connect.php";

// Check if the login form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve username and password from the form
    $username = $_POST["username"];
    $password = $_POST["password"];

    // Prepare and execute SQL statement to check user credentials
    $stmt = $conn->prepare("SELECT * FROM users WHERE username = ? AND password = ?");
    $stmt->bind_param("ss", $username, $password);
    $stmt->execute();
    $result = $stmt->get_result();

    // Check if the user exists
    if ($result->num_rows == 1) {
        // User authenticated, redirect to dashboard or another page
        header("Location: dashboard.php");
        exit();
    } else {
        // User not found or incorrect credentials, display error message
        $error_message = "Invalid username or password.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
    <div class="container">
        <h2>Login</h2>
        <form action="login.php" method="post">
            <label for="username">Username:</label>
            <input type="text" id="username" name="username" required><br><br>
            
            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required><br><br>
            
            <input type="submit" value="Login">
        </form>
        <?php
        // Display error message if authentication failed
        if (isset($error_message)) {
            echo "<p class='error'>$error_message</p>";
        }
        ?>
    </div>
</body>
</html>
