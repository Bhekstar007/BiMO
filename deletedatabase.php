<?php
// Database credentials
$server = "localhost"; // Change to your database server, e.g., "127.0.0.1" or a hostname.
$username = "root";    // Replace with your MySQL username.
$password = ""; // Replace with your MySQL password.
$database = "waste_management"; // Replace with the name of the database you want to delete.

// Connect to the MySQL server
$conn = new mysqli($server, $username, $password);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// SQL query to drop the database
$sql = "DROP DATABASE `$database`";

if ($conn->query($sql) === TRUE) {
    echo "Database '$database' deleted successfully.";
} else {
    echo "Error deleting database: " . $conn->error;
}

// Close the connection
$conn->close();
?>
