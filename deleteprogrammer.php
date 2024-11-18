<?php
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

if (isset($_GET['id_number'])) {
    $id = $_GET['id_number'];
    $sql = "DELETE FROM programmers WHERE id_number = $id_number";

    if ($conn->query($sql) === TRUE) {
        header("Location: viewprogrammers.php");
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}
?>