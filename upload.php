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
    $fileName = basename($_FILES["file"]["name"]);
    $targetFilePath = $targetDir . $fileName;

    // Move uploaded file to the target directory
    if (move_uploaded_file($_FILES["file"]["tmp_name"], $targetFilePath)) {
        // Insert file info into the database
        $stmt = $pdo->prepare("INSERT INTO documents (file_name) VALUES (:fileName)");
        $stmt->bindParam(':fileName', $fileName);

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
