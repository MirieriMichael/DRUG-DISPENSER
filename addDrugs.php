<?php
$Servername="localhost";
$Username="root";
$Password="";

$conn=new mysqli($Servername,$Username,$Password);

if ($conn->connect_error) {
    die("Connection failure: " . $conn->connect_error);
}
$sql="CREATE DATABASE IF NOT EXISTS Drugs";
$conn->select_db("Drugs");

$sql = "CREATE TABLE IF NOT EXISTS DrugsIssued (
    tradename VARCHAR (6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    Formula VARCHAR(30) PRIMARY KEY,
    Price INT(9) NOT NULL,
    
)";
if ($conn->query($sql) === TRUE) {
    echo "Database created successfully<br>";
} else {
    echo "Error creating database: " . $conn->error;
}
$trade="Peroxide";
$form=123344;
$pricing=1900;

$sql="INSERT INTO DrugsIssued(tradename,Formula,Price)
VALUES('$trade','$form','$pricing')";
if ($conn->query($sql) === TRUE) {
    echo "Data inserted successfully<br>";
} else {
    echo "Error inserting data: " . $conn->error;
}
$sql="SELECT *FROM DrugsIssued";

$result = $conn->query($sql);

if ($result->num_rows > 0) {
    
    while ($row = $result->fetch_assoc()) {
        echo "tradename: " . $row["tradename"] . "<br>";
        echo "Formula: " . $row["Formula"] . "<br>";
        echo "Price: " . $row["Price"] . "<br>";
        echo "<br>";
    }
} else {
    echo "No data found";
}
