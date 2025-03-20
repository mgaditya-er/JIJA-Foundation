<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="bootstrap.css" />
  <title>Doctor Form</title>
  <style>
    body {
      background-color: #f8f9fa;
    }
    .container {
      margin-top: 50px;
    }
  </style>
</head>
<body>
  <div class="container">
    <div class="row justify-content-center">
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
    $password = ''; // Change if necessary
    $database = 'jija';

    // Connect to MySQL database
    $conn = new mysqli($host, $user, $password, $database);

    // Check connection
    if ($conn->connect_error) {
        die("<script>alert('Database connection failed!');</script>");
    }

    // Insert into the database
    $sql = "INSERT INTO doctor (name, specialty, location, contact) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssss", $name, $specialty, $location, $contact);

    if ($stmt->execute()) {
        echo "<script>alert('Doctor data saved successfully!');</script>";

        // Save data to JSON file
        $file = 'doctors.json';
        $existing_data = file_exists($file) ? json_decode(file_get_contents($file), true) : ['doctors' => []];

        $new_data = [
            'id' => count($existing_data['doctors']) + 1,
            'name' => $name,
            'specialty' => $specialty,
            'location' => $location,
            'contact' => $contact
        ];

        $existing_data['doctors'][] = $new_data;
        file_put_contents($file, json_encode($existing_data, JSON_PRETTY_PRINT));
    } else {
        echo "<script>alert('Error: Could not save doctor.');</script>";
    }

    $stmt->close();

    // Bulk data insertion (only once)
    $flagFile = 'flag.txt';
    // if (!file_exists($flagFile)) {
    //     $jsonData = '{
    //       "doctors": [
    //         {"id": 1, "name": "Dr. Aarav Kapoor", "specialty": "General Medicine", "location": "Delhi Health Clinic", "contact": "+91 98765 43210"},
    //         {"id": 2, "name": "Dr. Diya Sharma", "specialty": "Pediatrics", "location": "Mumbai Kids Hospital", "contact": "+91 87654 32109"},
    //         {"id": 3, "name": "Dr. Arjun Singhania", "specialty": "Cardiology", "location": "Chennai Heart Center", "contact": "+91 76543 21098"},
    //         {"id": 4, "name": "Dr. Kavya Reddy", "specialty": "Dermatology", "location": "Hyderabad Skin Clinic", "contact": "+91 65432 10987"}
    //       ]
    //     }';

    //     $data = json_decode($jsonData, true);

    //     foreach ($data['doctors'] as $doctor) {
    //         $stmt = $conn->prepare($sql);
    //         $stmt->bind_param("ssss", $doctor['name'], $doctor['specialty'], $doctor['location'], $doctor['contact']);
    //         $stmt->execute();
    //     }

    //     file_put_contents($flagFile, "1"); // Prevent re-execution
    //     echo "<script>alert('Bulk doctor data inserted successfully!');</script>";
    // }

    $conn->close();
  }
  ?>
</body>
</html>
