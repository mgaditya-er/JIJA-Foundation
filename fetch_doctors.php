<?php
// Database connection parameters
$host = 'localhost';
$user = 'root';
$password = '';
$database = 'jija';

// Connect to MySQL database
$conn = new mysqli($host, $user, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch doctors from the database
$sql = "SELECT name FROM doctor";
$result = $conn->query($sql);
$doctors = array();
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $doctors[] = $row;
    }
}

// Close the connection
$conn->close();

// Return JSON response
header('Content-Type: application/json');
echo json_encode($doctors);
?>
