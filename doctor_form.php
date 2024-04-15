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


    $flag = 0;
    if($flag==0)
    {
      $jsonData = '{
        "doctors": [
            {
                "id": 1,
                "name": "Dr. Aarav Kapoor",
                "specialty": "General Medicine",
                "location": "Delhi Health Clinic",
                "contact": "+91 98765 43210"
            },
            {
                "id": 2,
                "name": "Dr. Diya Sharma",
                "specialty": "Pediatrics",
                "location": "Mumbai Kids Hospital",
                "contact": "+91 87654 32109"
            },
            {
                "id": 3,
                "name": "Dr. Arjun Singhania",
                "specialty": "Cardiology",
                "location": "Chennai Heart Center",
                "contact": "+91 76543 21098"
            },
            {
                "id": 4,
                "name": "Dr. Kavya Reddy",
                "specialty": "Dermatology",
                "location": "Hyderabad Skin Clinic",
                "contact": "+91 65432 10987"
            },
            {
                "id": 5,
                "name": "Dr. Rohit Verma",
                "specialty": "Orthopedics",
                "location": "Bangalore OrthoCare",
                "contact": "+91 54321 09876"
            },
            {
                "id": 6,
                "name": "Dr. Naina Gupta",
                "specialty": "Ophthalmology",
                "location": "Kolkata Eye Clinic",
                "contact": "+91 87654 32109"
            },
            {
                "id": 7,
                "name": "Dr. Vikram Patel",
                "specialty": "Neurology",
                "location": "Ahmedabad Neuro Center",
                "contact": "+91 76543 21098"
            },
            {
                "id": 8,
                "name": "Dr. Ananya Mishra",
                "specialty": "Gynecology",
                "location": "Pune Women\'s Health",
                "contact": "+91 65432 10987"
            },
            {
                "id": 9,
                "name": "Dr. Pranav Khurana",
                "specialty": "ENT",
                "location": "Jaipur ENT Clinic",
                "contact": "+91 54321 09876"
            },
            {
                "id": 10,
                "name": "Dr. Riya Thakur",
                "specialty": "Psychiatry",
                "location": "Lucknow Mental Health",
                "contact": "+91 87654 32109"
            },
            {
                "id": 11,
                "name": "Dr. Arnav Desai",
                "specialty": "Dentistry",
                "location": "Bhopal Dental Care",
                "contact": "+91 76543 21098"
            },
            {
                "id": 12,
                "name": "Dr. Nandini Mehta",
                "specialty": "Pulmonology",
                "location": "Indore Lung Clinic",
                "contact": "+91 65432 10987"
            },
            {
                "id": 13,
                "name": "Dr. Yuvraj Singh",
                "specialty": "Sports Medicine",
                "location": "Chandigarh Sports Clinic",
                "contact": "+91 54321 09876"
            },
            {
                "id": 14,
                "name": "Dr. Simran Kapoor",
                "specialty": "Endocrinology",
                "location": "Surat Endocrine Center",
                "contact": "+91 87654 32109"
            },
            {
                "id": 15,
                "name": "Dr. Armaan Malhotra",
                "specialty": "Urology",
                "location": "Nagpur Urological Care",
                "contact": "+91 76543 21098"
            },
            {
                "id": "16",
                "name": "Dr. Ramesh Sharma",
                "specialty": "Endocrinology",
                "location": "Solapur",
                "contact": "7894563210"
            }
        ]
    }';
    $data = json_decode($jsonData, true);
    foreach ($data['doctors'] as $doctor) {
      $name = $doctor['name'];
      $specialty = $doctor['specialty'];
      $location = $doctor['location'];
      $contact = $doctor['contact'];
  
      $sql = "INSERT INTO doctor (name, specialty, location, contact) VALUES (?, ?, ?, ?)";
      $stmt = $conn->prepare($sql);
      $stmt->bind_param("ssss", $name, $specialty, $location, $contact);
  
      $flag = 1;
  }
  
  // Close the connection
 
    
    }   

    // Close the connection
    $stmt->close();
    $conn->close();

    $new_data = array(
            'id' => '', // You can generate a unique ID here if needed
            'name' => $name,
            'specialty' => $specialty,
            'location' => $location,
            'contact' => $contact
        );
        $existing_data = json_decode(file_get_contents('doctors.json'), true);
        $existing_data['doctors'][] = $new_data;
        file_put_contents('doctors.json', json_encode($existing_data));
  }
  ?>
</body>
</html>
