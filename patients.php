<?php
session_start();

$email = $_POST['Email'];
$ssn = $_POST['SSN'];
$firstName = $_POST['FirstName'];
$lastName = $_POST['LastName'];

$conn = new mysqli('localhost', 'root', '', 'patients');

if ($conn->connect_error) {
    die('Connection Failed: ' . $conn->connect_error);
} else {
    $stmt = $conn->prepare("SELECT * FROM patients WHERE Email = ? AND SSN = ? AND FirstName = ? AND LastName = ? ");

    if ($stmt === false) {
        die('Error during preparation: ' . $conn->error);
    }

    $stmt->bind_param("ssss", $email, $ssn, $firstName, $lastName);

    if ($stmt->execute() === false) {
        die('Error during execution: ' . $stmt->error);
    }

    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $_SESSION['firstName'] = $firstName;
        $_SESSION['lastName'] = $lastName;
        echo "LOGIN SUCCESSFUL...";
        echo "Welcome, " . $firstName . " " . $lastName;
    } else {
        echo "LOGIN FAILED. Invalid credentials.";   
             
    }
    }
        ?>
   