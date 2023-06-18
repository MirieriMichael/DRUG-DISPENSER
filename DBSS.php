<?php
$firstName = $_POST['FirstName'];
$lastName = $_POST['LastName'];
$phoneNumber = $_POST['PhoneNumber'];
$email = $_POST['Email'];
$SSN = $_POST['SSN'];
$Gender = $_POST['GENDER'];
$Insurance = $_POST['Insurance'];
$Coverage = $_POST['InsuranceCover'];
$conn = new mysqli('localhost', 'root', '', 'patients');

if ($conn->connect_error) {
    die('Connection Failed: ' . $conn->connect_error);
} else {
    $stmt = $conn->prepare("INSERT INTO signup (FirstName, LastName, PhoneNumber, Email, SSN, GENDER, Insurance, InsuranceCover) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
    
    if ($stmt === false) {
        die('Error during preparation: ' . $conn->error);
    }
    
    $stmt->bind_param("ssisisss", $firstName, $lastName, $phoneNumber, $email, $SSN, $Gender, $Insurance, $Coverage);
    
    if ($stmt->execute() === false) {
        die('Error during execution: ' . $stmt->error);
    }
    
    echo "SIGN UP SUCCESSFUL...";
    
    $stmt->close();
    $conn->close();
}
?>
