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
    <!-- Doctor List Section -->
    <div class="row justify-content-center">
      <div class="col-md-6 mt-4">
        <div class="card">
          <div class="card-header bg-info text-white text-center">
            <h2>Doctor List</h2>
          </div>
          <div class="card-body">
            <ul class="list-group">
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

              // Query to fetch doctors
              $sql = "SELECT * FROM doctor";
              $result = $conn->query($sql);

              if ($result->num_rows > 0) {
                  while ($row = $result->fetch_assoc()) {
                      echo "<li class='list-group-item'>" . $row["name"] . " - " . $row["specialty"] . " - " . $row["location"] . " - " . $row["contact"] . "</li>";
                  }
              } else {
                  echo "<li class='list-group-item'>No doctors found</li>";
              }

              // Close the connection
              $conn->close();
              ?>
            </ul>
          </div>
        </div>
      </div>
    </div>
  </div>
</body>
</html>
