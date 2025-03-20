<?php
// Database configuration
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "jija";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    header('HTTP/1.1 500 Internal Server Error');
    die("Connection failed: " . $conn->connect_error);
}

// Function to sanitize input data
function sanitizeInput($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

// Process form data only if it's a POST request
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validate and sanitize input
    $name = sanitizeInput($_POST['name'] ?? '');
    $age = filter_var($_POST['age'] ?? '', FILTER_VALIDATE_INT);
    $number = sanitizeInput($_POST['number'] ?? '');
    $address = sanitizeInput($_POST['address'] ?? '');
    $query = sanitizeInput($_POST['query'] ?? '');
    $disability = sanitizeInput($_POST['disability'] ?? '');
    $email = filter_var($_POST['email'] ?? '', FILTER_SANITIZE_EMAIL);
    
    // Basic input validation
    $errors = [];
    
    if (empty($name)) {
        $errors[] = "Name is required";
    }
    
    if ($age === false || $age < 0 || $age > 120) {
        $errors[] = "Valid age is required";
    }
    
    if (empty($number) || !preg_match("/^[0-9]{10}$/", $number)) {
        $errors[] = "Valid 10-digit phone number is required";
    }
    
    if (empty($address)) {
        $errors[] = "Address is required";
    }
    
    if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Valid email is required";
    }
    
    // If there are validation errors
    if (!empty($errors)) {
        header('HTTP/1.1 400 Bad Request');
        echo "Error: " . implode(", ", $errors);
        exit();
    }
    
    // Prepare and bind to prevent SQL injection
    $stmt = $conn->prepare("INSERT INTO patients (name, age, number, address, query, disability, email, registration_date) 
                            VALUES (?, ?, ?, ?, ?, ?, ?, NOW())");
    
    if ($stmt === false) {
        header('HTTP/1.1 500 Internal Server Error');
        die("Error preparing statement: " . $conn->error);
    }
    
    $stmt->bind_param("sisssss", $name, $age, $number, $address, $query, $disability, $email);
    
    // Execute the statement
    if ($stmt->execute()) {
        echo "Patient registration successful! Thank you for registering with JIJA Foundation.";
        
        // Optional: Send confirmation email
        // mail($email, "Registration Confirmation", "Thank you for registering with JIJA Foundation.");
    } else {
        header('HTTP/1.1 500 Internal Server Error');
        echo "Error: " . $stmt->error;
    }
    
    // Close statement
    $stmt->close();
} else {
    // Not a POST request
    header('HTTP/1.1 405 Method Not Allowed');
    echo "Error: Only POST requests are allowed";
}

// Close connection
$conn->close();
?>