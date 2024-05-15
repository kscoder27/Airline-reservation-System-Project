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

// Prepare the SQL query to retrieve account details
$sql = "SELECT * FROM Passengers WHERE PassengerID = ?";
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
    <title>Account Details</title>
    <style>
        body {
            background-image: url('airplay.webp'); /* Replace 'background_image.jpg' with the path to your background image */
            background-size: cover;
            background-repeat: no-repeat;
            background-attachment: fixed;
            font-family: Arial, sans-serif; /* Optional: Define a font family for better readability */
            color: #333; /* Optional: Define text color */
            text-align: center;
        }

        table {
            margin: 0 auto;
            border-collapse: collapse;
            width: 50%;
        }

        th, td {
            padding: 8px;
            border-bottom: 1px solid #ddd;
        }

        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>
    <h1>Account Details</h1>
    <?php if ($result->num_rows > 0): ?>
        <table>
            <tr>
                <th>Field</th>
                <th>Value</th>
            </tr>
            <?php while ($row = $result->fetch_assoc()): ?>
                <tr>
                    <td><strong>PassengerID</strong></td>
                    <td><?php echo $row["PassengerID"]; ?></td>
                </tr>
                <tr>
                    <td><strong>First Name</strong></td>
                    <td><?php echo $row["FirstName"]; ?></td>
                </tr>
                <tr>
                    <td><strong>Last Name</strong></td>
                    <td><?php echo $row["LastName"]; ?></td>
                </tr>
                <tr>
                    <td><strong>Email</strong></td>
                    <td><?php echo $row["Email"]; ?></td>
                </tr>
                <tr>
                    <td><strong>Phone Number</strong></td>
                    <td><?php echo $row["PhoneNumber"]; ?></td>
                </tr>
                <tr>
                    <td><strong>Username</strong></td>
                    <td><?php echo $row["Username"]; ?></td>
                </tr>
                <tr>
                    <td><strong>Password</strong></td>
                    <td><?php echo $row["Password"]; ?></td>
                </tr>
            <?php endwhile; ?>
        </table>
    <?php else: ?>
        <p>No account details found.</p>
    <?php endif; ?>
</body>
</html>
