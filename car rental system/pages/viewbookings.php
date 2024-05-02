<?php
// Include database connection file
require_once "../includes/db_connect.php";

// Retrieve booked cars for the current agency from the database
$stmt = $conn->prepare("SELECT * FROM bookings WHERE car_id IN (SELECT car_id FROM cars WHERE agency_id = ?)");
$stmt->bind_param("i", $_SESSION["user_id"]);
$stmt->execute();
$result = $stmt->get_result();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Bookings</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
    <div class="container">
        <h2>View Bookings</h2>
        <table>
            <thead>
                <tr>
                    <th>Booking ID</th>
                    <th>Car ID</th>
                    <th>User ID</th>
                    <th>Start Date</th>
                    <th>End Date</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // Display booked cars
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . $row['booking_id'] . "</td>";
                    echo "<td>" . $row['car_id'] . "</td>";
                    echo "<td>" . $row['user_id'] . "</td>";
                    echo "<td>" . $row['start_date'] . "</td>";
                    echo "<td>" . $row['end_date'] . "</td>";
                    echo "</tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
</body>
</html>
