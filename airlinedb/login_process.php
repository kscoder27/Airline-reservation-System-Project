<?php
session_start();

// Database connection details
$servername = "localhost";
$username = "root";
$password = "root";
$database = "airlinedb4";

// Create connection
$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Retrieve form data
$inputUsername = $_POST['username'];
$inputPassword = $_POST['password'];

// Prepare and execute the SQL query
$sql = "SELECT * FROM Passengers WHERE Username = ? AND Password = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ss", $inputUsername, $inputPassword);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $_SESSION['PassengerID'] = $row['PassengerID'];
    $_SESSION['username'] = $row['Username'];
    header("Location: bookingss.php");
    exit;
} else {
    // Display a pop-up for invalid username or password
    echo '<script>alert("Invalid username or password. Please try again."); window.location.href = "login.php";</script>';
    exit;
}

// Debug session data
echo "<pre>";
print_r($_SESSION);
echo "</pre>";

$stmt->close();
$conn->close();
?>
