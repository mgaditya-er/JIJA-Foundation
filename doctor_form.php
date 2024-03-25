<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="bootstrap.css" />

  <title>Doctor Form</title>
  <style>
    body {
      background-color: #f8f9fa; /* Set a light background color */
    }
    .container {
      margin-top: 50px; /* Add top margin for spacing */
    }
  </style>
</head>
<body>
  <div class="container">
    <div class="row justify-content-center"> <!-- Center the content -->
      <div class="col-md-6">
        <div class="card">
          <div class="card-header bg-primary text-white text-center">
            <h2>Doctor Information</h2>
          </div>
          <div class="card-body">
            <form action="" method="post">
              <div class="form-group">
                <label for="name">Name:</label>
                <input type="text" class="form-control" id="name" name="name" required>
              </div>
              <div class="form-group">
                <label for="specialty">Specialty:</label>
                <input type="text" class="form-control" id="specialty" name="specialty" required>
              </div>
              <div class="form-group">
                <label for="location">Location:</label>
                <input type="text" class="form-control" id="location" name="location" required>
              </div>
              <div class="form-group">
                <label for="contact">Contact:</label>
                <input type="text" class="form-control" id="contact" name="contact" required>
              </div>
              <button type="submit" class="btn btn-primary btn-block" id="saveBtn" name="saveBtn">Save</button>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>

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
