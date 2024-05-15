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

// Get the flight number from the form
$flightNumber = $_POST["flightNumber"];

// Get the PassengerID from the session (assuming it's stored there when the user logs in)
if(isset($_SESSION['PassengerID'])) {
    $passengerID = $_SESSION['PassengerID'];
} else {
    // Handle the case when PassengerID is not found in session (redirect to login, display error, etc.)
    echo "Error: Passenger ID not found in session.";
    exit; // Terminate the script
}

// Prepare the SQL query to insert booking details
$sql = "INSERT INTO Bookings (PassengerID, FlightNumber) VALUES (?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("is", $passengerID, $flightNumber);

// Execute the query
if ($stmt->execute() === TRUE) {
    // Booking successful
    // Close the prepared statement and database connection
    $stmt->close();
    $conn->close();

    // Display a JavaScript alert for successful booking
    echo "<script>alert('Booking successful!'); window.location.href = 'booking2.php';</script>";
} else {
    // Booking failed
    echo "Error: " . $sql . "<br>" . $conn->error;

    // Close the prepared statement and database connection
    $stmt->close();
    $conn->close();
}
?>
