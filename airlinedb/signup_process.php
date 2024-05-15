<?php
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
$firstName = $_POST['first-name'];
$lastName = $_POST['last-name'];
$email = $_POST['email'];
$phoneNumber = $_POST['phone'];
$username = $_POST['username'];
$password = $_POST['password'];

// Prepare and execute the SQL query
$sql = "INSERT INTO Passengers (FirstName, LastName, Email, PhoneNumber, Username, Password) VALUES (?, ?, ?, ?, ?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ssssss", $firstName, $lastName, $email, $phoneNumber, $username, $password);

if ($stmt->execute()) {
    // Redirect to the home page with a pop-up message
    echo "<script>
            window.addEventListener('load', function() {
                alert('Signed up successfully!');
                window.location.href = 'home.php';
            });
        </script>";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$stmt->close();
$conn->close();
?>