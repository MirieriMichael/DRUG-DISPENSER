<?php

// Server name must be localhost
$servername = "localhost";

// In my case, user name will be root
$username = "root";

// Password is empty
$password = "";

// Creating a connection
$conn = new mysqli($servername, $username, $password);

// Check connection
if ($conn->connect_error) {
    die("Connection failure: " . $conn->connect_error);
}

// Creating a database named Drugdispensersh
$sql = "CREATE DATABASE IF NOT EXISTS Drugdispensershe";
if ($conn->query($sql) === TRUE) {
    echo "Database created successfully<br>";
} else {
    echo "Error creating database: " . $conn->error;
}

// Selecting the database
$conn->select_db("Drugdispensershe");

// Creating the "patients" table if it doesn't exist
$sql = "CREATE TABLE IF NOT EXISTS patients (
    SSN INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    NAMES VARCHAR(30) NOT NULL,
    AGE INT(3) NOT NULL,
    ADDRESSES VARCHAR(100) NOT NULL
)";

if ($conn->query($sql) === TRUE) {
    echo "Table created successfully<br>";
} else {
    echo "Error creating table: " . $conn->error;
}

$NAMES = "ZEPH";
$AGE = 46;
$ADDRESSES = "098760987";

$sql = "INSERT INTO patients (NAMES, AGE, ADDRESSES)
        VALUES ('$NAMES', $AGE, '$ADDRESSES')";

if ($conn->query($sql) === TRUE) {
    echo "Data inserted successfully<br>";
} else {
    echo "Error inserting data: " . $conn->error;
}

// Retrieving the data from the "patients" table
$sql = "SELECT * FROM patients";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Output the data
    while ($row = $result->fetch_assoc()) {
        echo "SSN: " . $row["SSN"] . "<br>";
        echo "Name: " . $row["NAMES"] . "<br>";
        echo "Age: " . $row["AGE"] . "<br>";
        echo "Address: " . $row["ADDRESSES"] . "<br>";
        echo "<br>";
    }
} else {
    echo "No data found";
}

// Closing connection
$conn->close();
?>
