<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Doctor Form</title>
</head>
<body>
  <h2>Doctor Information</h2>
  <form action="" method="post">
    <label for="name">Name:</label>
    <input type="text" id="name" name="name" required><br>
    <label for="specialty">Specialty:</label>
    <input type="text" id="specialty" name="specialty" required><br>
    <label for="location">Location:</label>
    <input type="text" id="location" name="location" required><br>
    <label for="contact">Contact:</label>
    <input type="text" id="contact" name="contact" required><br>
    <button type="submit" id="saveBtn" name="saveBtn">Save</button>
  </form>

  <?php
  if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get the form data
    $name = $_POST['name'];
    $specialty = $_POST['specialty'];
    $location = $_POST['location'];
    $contact = $_POST['contact'];

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

    // Prepare SQL statement
    $sql = "INSERT INTO doctor (name, specialty, location, contact) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssss", $name, $specialty, $location, $contact);

    // Execute the statement
    if ($stmt->execute()) {
        echo "<p>Doctor data saved successfully.</p>";
    } else {
        echo "<p>Error: " . $sql . "<br>" . $conn->error . "</p>";
    }

    // Close the connection
    $stmt->close();
    $conn->close();
  }
  ?>
</body>
</html>
