<?php
$servername = "localhost";
$username = "root";
$password = ""; // Replace with your database password
$dbname = "waste_management";
$conn = new mysqli($servername, $username, $password, $dbname);

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Prepared statement to prevent SQL injection, id_number is treated as a string
    $stmt = $conn->prepare("DELETE FROM programmers WHERE id_number = ?");
    $stmt->bind_param("s", $id); // 's' denotes a string parameter

    if ($stmt->execute()) {
        header("Location: viewprogrammer.php");
        exit();
    } else {
        echo "Error: " . $stmt->error;
    }
} else {
    echo "No ID provided.";
}
?>


