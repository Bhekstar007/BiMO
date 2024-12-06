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

$programmer = null;

if (isset($_GET['id'])) {
    $id_number = $_GET['id']; // Sanitize input
    echo "Searching for ID: " . $id_number . "<br>"; // Debugging output

    // Prepare the statement
    $stmt = $conn->prepare("SELECT * FROM programmers WHERE id_number = ?");
    if ($stmt) {
        $stmt->bind_param("s", $id_number);
        $stmt->execute();
        $result = $stmt->get_result();
        $programmer = $result->fetch_assoc();
        $stmt->close();

        
        // Debugging: Check if we found a programmer
        if ($programmer) {
            echo "Programmer found: " . $programmer['name'] . "<br>";
        } else {
            echo "No programmer found.<br>";
        }
    } else {
        echo "Prepared statement failed.<br>";
    }
}

if (isset($_POST['update'])) {
    $id_number = $conn->real_escape_string($_POST['id_number']); // Treat as a string
    $name = $conn->real_escape_string($_POST['name']);
    $email = $conn->real_escape_string($_POST['email']);
    $pwd = !empty($_POST['password']) ? password_hash($_POST['password'], PASSWORD_BCRYPT) : $programmer['password']; // Update only if provided
    $phone_number = $conn->real_escape_string($_POST['phone_number']);

    $stmt = $conn->prepare("UPDATE programmers SET name = ?, email = ?, password = ?, phone_number = ? WHERE id_number = ?");
    $stmt->bind_param("sssss", $name, $email, $pwd, $phone_number, $id_number);

    if ($stmt->execute()) {
        header("Location: viewprogrammer.php");
        exit();
    } else {
        echo "Error: " . $stmt->error;
    }
    $stmt->close();
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Edit Programmer</title>
    <link rel="stylesheet" href="phpstyles.css">
    <script src="userinterface/scripts.js"></script>
</head>
<body>
    <?php if ($programmer): ?>
    <form method="POST" action="">
        <label>Name: <input type="text" name="name" value="<?php echo htmlspecialchars($programmer['name']); ?>" required></label><br>
        <label>ID Number: <input type="text" name="id_number" value="<?php echo htmlspecialchars($programmer['id_number']); ?>" required></label><br>
        <label>Email: <input type="email" name="email" value="<?php echo htmlspecialchars($programmer['email']); ?>" required></label><br>
        <label>Password: <input type="password" name="password" placeholder="Leave blank to keep current password"></label><br>
        <label>Phone Number: <input type="text" name="phone_number" value="<?php echo htmlspecialchars($programmer['phone_number']); ?>"></label><br>
        <button type="submit" name="update">Update Programmer</button>
    </form>
    <?php else: ?>
        <p>Programmer not found.</p>
    <?php endif; ?>
</body>
</html>

