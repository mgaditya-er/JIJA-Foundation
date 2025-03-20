<?php
$servername = "localhost"; // Change if needed
$username = "root";        // Your MySQL username
$password = "root";            // Your MySQL password
$database = "jija"; // Database name

// Create connection
$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die(json_encode(["status" => "error", "message" => "Connection failed: " . $conn->connect_error]));
}

// Get form data from POST request
$name = $_POST['name'];
$specialty = $_POST['specialty'];
$location = $_POST['location'];
$contact = $_POST['contact'];

// Prepare SQL statement
$sql = "INSERT INTO doctors (name, specialty, location, contact) VALUES (?, ?, ?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ssss", $name, $specialty, $location, $contact);

// Execute the query
if ($stmt->execute()) {
    echo json_encode(["status" => "success", "message" => "Doctor added successfully!"]);
} else {
    echo json_encode(["status" => "error", "message" => "Error: " . $stmt->error]);
}

// Close connection
$stmt->close();
$conn->close();
?>
