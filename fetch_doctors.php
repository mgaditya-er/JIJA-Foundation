<?php
// Database connection details
$host = 'localhost';
$user = 'root';
$password = ''; // Change if needed
$database = 'jija';

// Create a connection
$conn = new mysqli($host, $user, $password, $database);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch doctor names
$sql = "SELECT name FROM doctor";
$result = $conn->query($sql);

$doctors = array();
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $doctors[] = $row['name'];
    }
}

// Return JSON response
echo json_encode($doctors);

// Close the connection
$conn->close();
?>
