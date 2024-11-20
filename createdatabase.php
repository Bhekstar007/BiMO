<!-- create_database.php -->
<?php
// Database connection parameters
$servername = "localhost";
$username = "root"; // Replace with your MySQL username
$password = "";     // Replace with your MySQL password

// Create a connection to MySQL
$conn = new mysqli($servername, $username, $password);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// SQL to create database
$sql = "CREATE DATABASE IF NOT EXISTS waste_management";
if ($conn->query($sql) === TRUE) {
    echo "Database created successfully or already exists.<br>";
} else {
    echo "Error creating database: " . $conn->error;
}

// Connect to the newly created database
$conn->select_db("waste_management");

// SQL to create table
$sql = "CREATE TABLE IF NOT EXISTS client_data (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    company VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL,
    phone_number VARCHAR(20) NOT NULL,
    company_address VARCHAR(200) NOT NULL,
    project_id VARCHAR(50) NOT NULL
)";

if ($conn->query($sql) === TRUE) {
    echo "Table 'client_data' created successfully or already exists.";
} else {
    echo "Error creating table: " . $conn->error;
}

$sql_2 = "CREATE TABLE programmers (
    id_number VARCHAR (255) PRIMARY KEY UNIQUE,
    name VARCHAR(255) NOT NULL,
    phone_number VARCHAR(100),
    email VARCHAR(255) NOT NULL,
    password varchar(255)
)";

if ($conn->query($sql_2) === TRUE) {
    echo "Table 'programmers' created successfully or already exists.";
} else {
    echo "Error creating table: " . $conn->error;
}

$sql_3 = "CREATE TABLE documents (
    id INT AUTO_INCREMENT PRIMARY KEY,
    file_name VARCHAR(255) NOT NULL,
    upload_time TIMESTAMP DEFAULT CURRENT_TIMESTAMP
)";

if ($conn->query($sql_3) === TRUE) {
    echo "Table 'documents' created successfully or already exists.";
} else {
    echo "Error creating table: " . $conn->error;
}
// Close the connection
$conn->close();
?>
