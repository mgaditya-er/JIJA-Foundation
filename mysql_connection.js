const mysql = require('mysql2');

// Create a connection to the MySQL server
const connection = mysql.createConnection({
  host: 'localhost',
  user: 'root',
  password: 'root',
  database: 'jija'
});

// Connect to the MySQL server
connection.connect((err) => {
  if (err) {
    console.error('Error connecting to MySQL database:', err);
    return;
  }
  
  console.log('Connected to MySQL database');
});

// Handle form submission
const saveDoctorData = (doctor) => {
  // Insert the doctor data into the database
  const sql = 'INSERT INTO doctors (name, specialty, location, contact) VALUES (?, ?, ?, ?)';
  const values = [doctor.name, doctor.specialty, doctor.location, doctor.contact];

  connection.query(sql, values, (err, result) => {
    if (err) {
      console.error('Error saving doctor data:', err);
      return;
    }
    console.log('Doctor data saved successfully:', result);
  });
};

// Example doctor object
const doctor = {
  name: 'Dr. John Doe',
  specialty: 'Cardiology',
  location: 'New York',
  contact: '123-456-7890'
};

// Call the function to save doctor data
saveDoctorData(doctor);

// Close the connection after saving data (optional)
connection.end();
