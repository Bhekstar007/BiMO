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
    $id_number = $_GET['id_number'];
    $result = $conn->query("SELECT * FROM programmers WHERE id_number = $id_number");
    $programmer = $result->fetch_assoc();
}

if (isset($_POST['update'])) {
    $id_number = $_POST['id_number'];
    $name = $_POST['name'];
    $email = $_POST['email'];
    $pwd = $_POST['password'] ? password_hash($_POST['password'], PASSWORD_BCRYPT) : $programmer['password']; // Only update password if provided
    $phone_number = $_POST['phone_number'];

    $sql = "UPDATE programmers SET 
            name = '$name', id_number = '$id_number', email = '$email', 
            password = '$password', phone_number = '$phone_number' 
            WHERE id_number = $id_number";

    if ($conn->query($sql) === TRUE) {
        header("Location: view_programmers.php");
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Edit Programmer</title>
</head>
<body>
    <form method="POST" action="">
        <label>Name: <input type="text" name="name" value="<?php echo $programmer['name']; ?>" required></label><br>
        <label>ID Number: <input type="text" name="id_number" value="<?php echo $programmer['id_number']; ?>" required></label><br>
        <label>Email: <input type="email" name="email" value="<?php echo $programmer['email']; ?>" required></label><br>
        <label>Password: <input type="password" name="password" placeholder="Leave blank to keep current password"></label><br>
        <label>Phone Number: <input type="text" name="phone_number" value="<?php echo $programmer['phone_number']; ?>"></label><br>
        <button type="submit" name="update">Update Programmer</button>
    </form>
</body>
</html>