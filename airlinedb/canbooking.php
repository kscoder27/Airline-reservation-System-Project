<?php
// Start the session
session_start();

// Database connection details
$servername = "localhost";
$username = "root";
$password = "root";
$dbname = "airlinedb4";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get the passenger ID from the session
if(isset($_SESSION['PassengerID'])) {
    $passengerID = $_SESSION['PassengerID'];
} else {
    echo "Error: Passenger ID not found in session.";
    exit; // Terminate the script
}

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['cancel'])) {
    // Get the selected bookings to cancel
    if(isset($_POST['cancel_booking'])) {
        $cancel_bookings = $_POST['cancel_booking'];
        
        // Prepare the SQL query to delete selected bookings
        $sql_delete = "DELETE FROM Bookings WHERE PassengerID = ? AND BookingID = ?";
        $stmt_delete = $conn->prepare($sql_delete);
        
        // Bind parameters and execute the query for each selected booking
        foreach ($cancel_bookings as $bookingID) {
            $stmt_delete->bind_param("ii", $passengerID, $bookingID);
            $stmt_delete->execute();
        }
        
        // Close the statement
        $stmt_delete->close();
    }
}

// Prepare the SQL query to retrieve booking details
$sql = "SELECT Bookings.BookingID, Flights.FlightNumber, Flights.DepartureAirportCode, Flights.ArrivalAirportCode, Flights.DepartureTime, Flights.ArrivalTime, Flights.JourneyDate, Flights.AircraftType 
        FROM Bookings 
        INNER JOIN Flights ON Bookings.FlightNumber = Flights.FlightNumber 
        WHERE Bookings.PassengerID = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $passengerID);
$stmt->execute();
$result = $stmt->get_result();

// Close the database connection
$stmt->close();
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Bookings</title>
    
    <style>
    body {
    font-family: Arial, sans-serif;
    background-image: url('airplay.webp'); 
    background-size: cover;
    background-position: center;
    background-repeat: no-repeat;
    margin: 0;
    padding: 0;
}

h1 {
    text-align: center;
    margin-top: 50px; /* Adjust as needed */
}

table {
    width: 80%;
    margin: 0 auto;
    border-collapse: collapse;
}

th, td {
    padding: 10px;
    border: 1px solid #ddd;
    text-align: left;
}

th {
    background-color: #f2f2f2;
}

p {
    text-align: center;
    margin-top: 20px;
}

/* Styles for responsiveness */
@media screen and (max-width: 600px) {
    table {
        width: 100%;
    }
}


button[type="submit"] {
    background-color: #4CAF50;
    color: white;
    padding: 10px 20px;
    border: none;
    border-radius: 4px;
    cursor: pointer;
    font-size: 16px;
}


button[type="submit"]:hover {
    background-color: #45a049;
}

  
</style>
</head>
<body>
    <h1>View Bookings</h1>
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
    <?php if ($result->num_rows > 0): ?>
        <table>
            <tr>
                <th>Select</th>
                <th>Booking ID</th>
                <th>Flight Number</th>
                <th>Departure Airport</th>
                <th>Arrival Airport</th>
                <th>Departure Time</th>
                <th>Arrival Time</th>
                <th>Journey Date</th>
                <th>Aircraft Type</th>
            </tr>
            <?php while ($row = $result->fetch_assoc()): ?>
                <tr>
                    <td><input type="checkbox" name="cancel_booking[]" value="<?php echo $row["BookingID"]; ?>"></td>
                    <td><?php echo $row["BookingID"]; ?></td>
                    <td><?php echo $row["FlightNumber"]; ?></td>
                    <td><?php echo $row["DepartureAirportCode"]; ?></td>
                    <td><?php echo $row["ArrivalAirportCode"]; ?></td>
                    <td><?php echo $row["DepartureTime"]; ?></td>
                    <td><?php echo $row["ArrivalTime"]; ?></td>
                    <td><?php echo $row["JourneyDate"]; ?></td>
                    <td><?php echo $row["AircraftType"]; ?></td>
                </tr>
            <?php endwhile; ?>
        </table>
        <div class="center-align">
        <button type="submit" name="cancel">Cancel Selected Bookings</button>
        </div>
    <?php else: ?>
        <p>No bookings found for the logged-in passenger.</p>
    <?php endif; ?>
    </form>
</body>
</html>
