<?php
// Database connection
$host = 'localhost';
$dbname = 'waste_management';
$username = 'root';
$password = '';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Connection failed: " . $e->getMessage());
}

if (isset($_POST['upload'])) {
    // Directory to save uploaded files
    $targetDir = "uploads/";
    if (!is_dir($targetDir)) {
        mkdir($targetDir, 0777, true);
    }

    // File info
    $fileName = preg_replace('/[^A-Za-z0-9.\-_]/', '_', basename($_FILES["file"]["name"])); // Sanitize file name
    $targetFilePath = $targetDir . $fileName;

    // Move uploaded file to the target directory
    if (move_uploaded_file($_FILES["file"]["tmp_name"], $targetFilePath)) {
        // Save the directory and file name in the database
        $relativePath = $targetDir . $fileName; // Include directory in file path
        $stmt = $pdo->prepare("INSERT INTO documents (file_name) VALUES (:fileName)");
        $stmt->bindParam(':fileName', $relativePath);

        if ($stmt->execute()) {
            echo "The file $fileName has been uploaded successfully.";
        } else {
            echo "Failed to save file metadata in the database.";
        }
    } else {
        echo "Failed to upload the file.";
    }
}
?>
