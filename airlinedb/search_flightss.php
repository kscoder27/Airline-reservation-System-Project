<?php
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

// Get the search parameters from the form
$departureAirport = $_GET["departureAirport"];
$arrivalAirport = $_GET["arrivalAirport"];
$departureDate = $_GET["departureDate"];

// Prepare the SQL query
$sql = "SELECT * FROM Flights WHERE DepartureAirportCode = ? AND ArrivalAirportCode = ? AND JourneyDate = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("sss", $departureAirport, $arrivalAirport, $departureDate);
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
    <title>Search Results</title>
    <link rel="stylesheet" href="stylesss.css">
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

header {
    background-color: #333;
    color: #fff;
    padding: 10px 0;
}
header nav ul {
    list-style-type: none;
    margin: 0;
    padding: 0;
}
header nav ul li {
    display: inline;
    margin-right: 20px;
}
header nav ul li a {
    color: #fff;
    text-decoration: none;
}
main {
    padding: 20px;
}
h1 {
    margin-top: 0;
}
table {
    width: 100%;
    border-collapse: collapse;
}
th, td {
    border: 1px solid #ddd;
    padding: 8px;
    text-align: left;
}
th {
    background-color: #f2f2f2;
}
form {
    display: inline;
}
input[type="submit"] {
    background-color: #4CAF50;
    color: white;
    padding: 8px 20px;
    border: none;
    cursor: pointer;
    border-radius: 4px;
}
input[type="submit"]:hover {
    background-color: #45a049;
}
    </style>
</head>
<body>
    
    <main>
        <h1>Search Results</h1>
        <?php
        if ($result->num_rows > 0) {
            echo "<table>";
            echo "<tr><th>Flight Number</th><th>Departure Airport</th><th>Arrival Airport</th><th>Departure Time</th><th>Arrival Time</th><th>Journey Date</th><th>Aircraft Type</th><th>Action</th></tr>";
            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row["FlightNumber"] . "</td>";
                echo "<td>" . $row["DepartureAirportCode"] . "</td>";
                echo "<td>" . $row["ArrivalAirportCode"] . "</td>";
                echo "<td>" . $row["DepartureTime"] . "</td>";
                echo "<td>" . $row["ArrivalTime"] . "</td>";
                echo "<td>" . $row["JourneyDate"] . "</td>";
                echo "<td>" . $row["AircraftType"] . "</td>";
                echo "<td><form action='book_flight2.php' method='post'><input type='hidden' name='flightNumber' value='" . $row["FlightNumber"] . "'><input type='submit' name='bookFlight' value='Book'></form></td>";
                echo "</tr>";
            }
            echo "</table>";
        } else {
            echo "<script>alert('No flights found.'); window.location.href = 'booking2.php';</script>";
        }
        ?>
    </main>

    <footer>
        &copy; 2023 Flight Booking System
    </footer>
</body>
</html>
