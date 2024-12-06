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
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Upload File</title>
    <link rel="stylesheet" href="styles.css">
    <script src="userinterface/scripts.js"></script>
</head>
<body>
<a href="displayfiles.php">Back to Uploaded Files</a>
    <form action="upload.php" method="post" enctype="multipart/form-data">
        <label for="file">Choose a file to upload:</label>
        <input type="file" name="file" id="file" required>
        <button type="submit" name="upload">Upload</button>
    </form>
</body>
</html>