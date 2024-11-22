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

// Handle file deletion
if (isset($_GET['delete'])) {
    $fileId = (int)$_GET['delete'];

    // Get the file path from the database
    $stmt = $pdo->prepare("SELECT file_name FROM documents WHERE id = :id");
    $stmt->bindParam(':id', $fileId);
    $stmt->execute();
    $file = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($file) {
        $filePath = $file['file_name']; // Path already includes the directory
        // Delete file from directory
        if (file_exists($filePath)) {
            unlink($filePath);
        }

        // Delete file record from the database
        $stmt = $pdo->prepare("DELETE FROM documents WHERE id = :id");
        $stmt->bindParam(':id', $fileId);
        if ($stmt->execute()) {
            echo "File deleted successfully.";
        } else {
            echo "Failed to delete file record from the database.";
        }
    } else {
        echo "File not found.";
    }
}

// Fetch all uploaded files from the database
$stmt = $pdo->prepare("SELECT * FROM documents ORDER BY upload_time DESC");
$stmt->execute();
$files = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Uploaded Files</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f4f4f4;
        }
    </style>
</head>
<body>
    <h1>Uploaded Files</h1>
    <?php if (!empty($files)): ?>
        <table>
            <thead>
                <tr>
                    <th>File Name</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($files as $file): ?>
                    <tr>
                        <td><?php echo htmlspecialchars(basename($file['file_name'])); ?></td>
                        <td>
                            <a href="<?php echo htmlspecialchars($file['file_name']); ?>" download>Download</a> |
                            <a href="?delete=<?php echo $file['id']; ?>" onclick="return confirm('Are you sure you want to delete this file?');">Delete</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php else: ?>
        <p>No files uploaded yet.</p>
    <?php endif; ?>
</body>
</html>
