<?php
// Database connection details
$host = "localhost";        // Your database host
$user = "root";             // Your database username
$password = "";             // Your database password
$dbname = "document_management"; // Your database name

// Connect to the database
$conn = new mysqli($host, $user, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch documents nearing their due dates (e.g., within the next 3 days)
$query = "
    SELECT title, due_date, assigned_to 
    FROM Documents 
    WHERE due_date BETWEEN CURDATE() AND DATE_ADD(CURDATE(), INTERVAL 3 DAY)
";

$result = $conn->query($query);

$notifications = [];
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $notifications[] = $row;
    }
}

// Convert notifications to JSON for frontend
header('Content-Type: application/json');
echo json_encode($notifications);

// Close the connection
$conn->close();
?>
