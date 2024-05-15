<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Flight Bookings</title>
    <style>
        /* Reset some default styles */
.tab body {
    font-family: Arial, sans-serif;
    margin: 0;
    padding: 0;
}

.tab h1 {
    text-align: center;
}

.tab table {
    width: 100%;
    border-collapse: collapse;
    margin-top: 20px;
}

.tab th, td {
    border: 1px solid #dddddd;
    padding: 8px;
    text-align: left;
}

.tab th {
    background-color: #f2f2f2;
}
body, h1, h2, h3, h4, h5, h6, p, ul, li {
    margin: 0;
    padding: 0;
}

body {
    font-family: Arial, sans-serif;
    line-height: 1.6;
    background-color: #f4f4f4;
}

header {
    background-color: #333;
    color: #fff;
    padding: 10px;
    text-align: center;
}

nav ul {
    list-style-type: none;
    display: flex;
    justify-content: center;
}

nav li {
    margin: 0 10px;
}

nav a {
    color: #fff;
    text-decoration: none;
    padding: 5px 10px;
    transition: background-color 0.3s ease;
}

nav a:hover {
    background-color: #555;
}

main {
    max-width: 800px;
    margin: 20px auto;
    background-color: #fff;
    padding: 20px;
    border-radius: 5px;
    box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
}

h1 {
    font-size: 28px;
    margin-bottom: 20px;
}

form {
    display: grid;
    grid-template-columns: repeat(2, 1fr);
    grid-gap: 20px;
}

label {
    font-weight: bold;
}

select, input[type="date"] {
    width: 100%;
    padding: 8px;
    border: 1px solid #ccc;
    border-radius: 4px;
}

button[type="submit"] {
    grid-column: 1 / -1;
    background-color: #333;
    color: #fff;
    border: none;
    padding: 10px 20px;
    border-radius: 4px;
    cursor: pointer;
    transition: background-color 0.3s ease;
}

button[type="submit"]:hover {
    background-color: #555;
}

footer {
    background-color: #333;
    color: #fff;
    text-align: center;
    padding: 10px;
    margin-top: 20px;
}
    </style>
</head>
<body>
    <header>
        <h1>Flamingo Airlines</h1>
        <nav>
            <ul>
                <li><a href="booking2.php" target="book_flight">Book Flights</a></li>
                <li><a href="viewbook2.php" target="book_flight">View Bookings</a></li>
                <li><a href="canbooking.php" target="book_flight">Cancel Booking</a></li>
                <li><a href="account.php" target="book_flight">Account</a></li>
            </ul>
        </nav>
    </header>
    <iframe src="booking2.php" width="100%" height=600 name=book_flight scrolling="yes"></iframe>

    
  
</body>
</html>