<?php
// Include database connection file
require_once "../includes/db_connect.php";

// Check if the form to add a new car is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve car details from the form
    $vehicle_model = $_POST["vehicle_model"];
    $vehicle_number = $_POST["vehicle_number"];
    $seating_capacity = $_POST["seating_capacity"];
    $rent_per_day = $_POST["rent_per_day"];
    
    // Insert the new car into the database
    $stmt = $conn->prepare("INSERT INTO cars (agency_id, vehicle_model, vehicle_number, seating_capacity, rent_per_day) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("isidi", $_SESSION["user_id"], $vehicle_model, $vehicle_number, $seating_capacity, $rent_per_day);
    
    if ($stmt->execute()) {
        echo "New car added successfully";
    } else {
        echo "Error: " . $stmt->error;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Car</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
    <div class="container">
        <h2>Add New Car</h2>
        <form action="add_car.php" method="post">
            <label for="vehicle_model">Vehicle Model:</label>
            <input type="text" id="vehicle_model" name="vehicle_model" required><br><br>
            
            <label for="vehicle_number">Vehicle Number:</label>
            <input type="text" id="vehicle_number" name="vehicle_number" required><br><br>
            
            <label for="seating_capacity">Seating Capacity:</label>
            <input type="number" id="seating_capacity" name="seating_capacity" required><br><br>
            
            <label for="rent_per_day">Rent Per Day:</label>
            <input type="number" id="rent_per_day" name="rent_per_day" required><br><br>
            
            <input type="submit" value="Add Car">
        </form>
    </div>
</body>
</html>
