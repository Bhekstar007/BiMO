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
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Manage Programmers</title>
</head>
<body>
    <h1>Programmer List</h1>
    <table border="1">
        <tr>
            <th>Name</th>
            <th>ID Number</th>
            <th>Email</th>
            <th>Phone Number</th>
            <th>Actions</th>
        </tr>
        <?php
        $result = $conn->query("SELECT * FROM programmers");
        while ($row = $result->fetch_assoc()) {
            echo "<tr>
                    <td>{$row['name']}</td>
                    <td>{$row['id_number']}</td>
                    <td>{$row['email']}</td>
                    <td>{$row['phone_number']}</td>
                    <td>
                        <a href='editprogrammer.php?id={$row['id_number']}'>Edit</a> |
                        <a href='deleteprogrammer.php?id={$row['id_number']}'>Delete</a>
                    </td>
                </tr>";
        }
        ?>
    </table>
</body>
</html>