<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fligh Bookings</title>
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

main {
    text-align: center;
    margin-top: 20px; /* Adjust as needed */
}

form {
    display: inline-block;
    padding: 20px;
    border: 1px solid #ccc;
    border-radius: 5px;
    background-color: rgba(255, 255, 255, 0.8); /* Transparent white background */
}

form label {
    display: block;
    margin-bottom: 10px;
}

form select, form input[type="date"] {
    width: 100%;
    padding: 10px;
    margin-bottom: 10px;
}

form button {
    width: 100%;
    padding: 10px;
    background-color: #000;
    color: #fff;
    border: none;
    border-radius: 5px;
    cursor: pointer;
}

form button:hover {
    background-color: #333;
}

.tab {
    margin-top: 50px;
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

/* Styles for responsiveness */
@media screen and (max-width: 600px) {
    form {
        width: 90%;
    }

    table {
        width: 100%;
    }
}

    </style>
</head>
<body>
    

    <main>
        <h1>Book Your Flight</h1>
        <form id="bookingForm" action="search_flightss.php" method="GET">
            <label for="departureAirport">Departure Airport:</label>
            <select id="departureAirport" name="departureAirport">
                <option value="">Select Departure Airport</option>
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

                // Get the list of departure airports
                $sql = "SELECT DISTINCT DepartureAirportCode FROM Flights";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<option value='" . $row["DepartureAirportCode"] . "'>" . $row["DepartureAirportCode"] . "</option>";
                    }
                }

                // Close the database connection
                $conn->close();
                ?>
            </select>

            <label for="arrivalAirport">Arrival Airport:</label>
            <select id="arrivalAirport" name="arrivalAirport">
                <option value="">Select Arrival Airport</option>
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

                // Get the list of arrival airports
                $sql = "SELECT DISTINCT ArrivalAirportCode FROM Flights";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<option value='" . $row["ArrivalAirportCode"] . "'>" . $row["ArrivalAirportCode"] . "</option>";
                    }
                }

                // Close the database connection
                $conn->close();
                ?>
            </select>

            <label for="departureDate">Departure Date:</label>
            <input type="date" id="departureDate" name="departureDate">

            <button type="submit">Search Flights</button>
        </form>
    </main>
    <div class="tab">
    <h1>Airport Details</h1>
    <table>
        <tr>
            <th>Airport Code</th>
            <th>Airport Name</th>
            <th>City</th>
            <th>Country</th>
        </tr>
        <tr>
            <td>JFK</td>
            <td>John F. Kennedy International Airport</td>
            <td>New York City</td>
            <td>United States</td>
        </tr>
        <tr>
            <td>LAX</td>
            <td>Los Angeles International Airport</td>
            <td>Los Angeles</td>
            <td>United States</td>
        </tr>
        <tr>
            <td>LHR</td>
            <td>London Heathrow Airport</td>
            <td>London</td>
            <td>United Kingdom</td>
        </tr>
        <tr>
            <td>CDG</td>
            <td>Charles de Gaulle Airport</td>
            <td>Paris</td>
            <td>France</td>
        </tr>
        <tr>
            <td>SYD</td>
            <td>Sydney Kingsford Smith Airport</td>
            <td>Sydney</td>
            <td>Australia</td>
        </tr>
        <tr>
            <td>PEK</td>
            <td>Beijing Capital International Airport</td>
            <td>Beijing</td>
            <td>China</td>
        </tr>
        <tr>
            <td>DXB</td>
            <td>Dubai International Airport</td>
            <td>Dubai</td>
            <td>United Arab Emirates</td>
        </tr>
        <tr>
            <td>HND</td>
            <td>Tokyo Haneda Airport</td>
            <td>Tokyo</td>
            <td>Japan</td>
        </tr>
        <tr>
            <td>AMS</td>
            <td>Amsterdam Airport Schiphol</td>
            <td>Amsterdam</td>
            <td>Netherlands</td>
        </tr>
        <tr>
            <td>SIN</td>
            <td>Singapore Changi Airport</td>
            <td>Singapore</td>
            <td>Singapore</td>
        </tr>
        <tr>
            <td>FRA</td>
            <td>Frankfurt Airport</td>
            <td>Frankfurt</td>
            <td>Germany</td>
        </tr>
        <tr>
            <td>IST</td>
            <td>Istanbul Airport</td>
            <td>Istanbul</td>
            <td>Turkey</td>
        </tr>
        <tr>
            <td>ATL</td>
            <td>Hartsfield-Jackson Atlanta International Airport</td>
            <td>Atlanta</td>
            <td>United States</td>
        </tr>
        <tr>
            <td>ORD</td>
            <td>O'Hare International Airport</td>
            <td>Chicago</td>
            <td>United States</td>
        </tr>
        <tr>
            <td>DEL</td>
            <td>Indira Gandhi International Airport</td>
            <td>Delhi</td>
            <td>India</td>
        </tr>
        <tr>
            <td>BOM</td>
            <td>Chhatrapati Shivaji Maharaj International Airport</td>
            <td>Mumbai</td>
            <td>India</td>
        </tr>
        <tr>
            <td>MAA</td>
            <td>Chennai International Airport</td>
            <td>Chennai</td>
            <td>India</td>
        </tr>
        <tr>
            <td>BLR</td>
            <td>Kempegowda International Airport</td>
            <td>Bangalore</td>
            <td>India</td>
        </tr>
        <tr>
            <td>HYD</td>
            <td>Rajiv Gandhi International Airport</td>
            <td>Hyderabad</td>
            <td>India</td>
        </tr>
    </table>
            </div>

  
</body>
</html>