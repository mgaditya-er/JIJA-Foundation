<?php
$host = 'localhost';
$user = 'root';
$password = ''; // Change if needed
$database = 'jija';

$conn = new mysqli($host, $user, $password, $database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$doctorName = $_GET['name'];

$sql = "SELECT * FROM doctor WHERE name = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $doctorName);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    echo json_encode($result->fetch_assoc());
} else {
    echo json_encode(null);
}

$stmt->close();
$conn->close();
?>
