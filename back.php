<?php
include('connect.php');


// Get POST data
$firstName = $_POST['firstName'];
$lastName = $_POST['lastName'];
$age = $_POST['age'];
$phoneNumber = $_POST['phoneNumber'];

// Validate POST data
$errors = [];
if (empty($firstName) || empty($lastName) || empty($age) || empty($phoneNumber)) {
    $errors[] = "All fields are required.";
}

if ($age <= 0) {
    $errors[] = "Age must be a positive number.";
}

if (!preg_match("/^[0-9]{10}$/", $phoneNumber)) {
    $errors[] = "Invalid phone number format. It should be a 10-digit number.";
}

// If there are validation errors, output them
if (!empty($errors)) {
    echo implode("<br>", $errors);
    exit;
}

// Sanitize data before using it in a query
$firstName = $connection->real_escape_string($firstName);
$lastName = $connection->real_escape_string($lastName);
$age = (int)$age; // Ensure age is an integer
$phoneNumber = $connection->real_escape_string($phoneNumber);

// Insert data into the database
$sql = "INSERT INTO students (firstName, lastName, age, phoneNumber) VALUES ('$firstName', '$lastName', $age, '$phoneNumber')";

if (mysqli_query($connection, $sql)) {
    echo "New record created successfully";
} else {
    echo "Error: " . mysqli_error($connection);
}

$connection->close();
?>
