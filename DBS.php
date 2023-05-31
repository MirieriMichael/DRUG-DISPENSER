<?php
$firstName = $_POST['FirstName'];
$lastName = $_POST['LastName'];
$phoneNumber = $_POST['PhoneNumber'];
$email = $_POST['Email'];
$SSN = $_POST['SSN'];
$conn = new mysqli('localhost', 'root', '', 'patients');

if ($conn->connect_error) {
    die('Connection Failed: ' . $conn->connect_error);
} else {
    $stmt = $conn->prepare("INSERT INTO patients (FirstName, LastName, PhoneNumber, Email, SSN) VALUES (?, ?, ?, ?, ?)");
    
    if ($stmt === false) {
        die('Error during preparation: ' . $conn->error);
    }
    
    $stmt->bind_param("ssisi", $firstName, $lastName, $phoneNumber, $email, $SSN);
    
    if ($stmt->execute() === false) {
        die('Error during execution: ' . $stmt->error);
    }
    
    echo "LOGIN SUCCESSFUL...";
    
    $stmt->close();
    $conn->close();
}
?>