<!-- submit.php -->
<?php
// Database connection parameters
$servername = "localhost";
$username = "root";
$password = ""; // Replace with your database password
$dbname = "waste_management";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Retrieve and sanitize form data
$name = $_POST['name'];
$company = $_POST['company'];
$email = $_POST['email'];
$phone = $_POST['phone'];
$compadd = $_POST['company_address'];
$project_id = $_POST['project_id'];

// SQL query to insert data
$sql = "INSERT INTO client_data (name, company, email, phone_number, company_address, project_id)
        VALUES ('$name', '$company', '$email', '$phone', '$compadd', '$project_id')";

if ($conn->query($sql) === TRUE) {
    echo "Data submitted successfully!<a href='display.php'>View all submissions</a>";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>
