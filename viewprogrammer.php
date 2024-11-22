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
<nav>
    <a href="index.php">Home</a>
    <a href="viewprogrammer.php">Programmer Manager</a>
    <a href="display.php">Client Details</a>
    <a href="displayfiles.php">Files</a>
    <a href="createdatabase.php">Create Database</a>
    <a href="deletedatabase.php">Delete Database</a>
</nav>
    <h1>Programmer List</h1>
    <a href="addprogrammer.php">Add New Programmer</a>
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