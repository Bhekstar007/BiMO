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
    <title>Add Programmer</title>
</head>
<body>
    <a href="viewprogrammer.php">View</a>
    <form method="POST" action="addprogrammer.php">
        <label>Name: <input type="text" name="name" required></label><br>
        <label>ID Number: <input type="text" name="id_number" required></label><br>
        <label>Email: <input type="email" name="email" required></label><br>
        <label>Password: <input type="password" name="password" required></label><br>
        <label>Phone Number: <input type="text" name="phone_number"></label><br>
        <button type="submit" name="submit">Add Programmer</button>
    </form>
</body>
</html>

<?php
if (isset($_POST['submit'])) {
    $name = $_POST['name'];
    $id_number = $_POST['id_number'];
    $email = $_POST['email'];
    $pwd = password_hash($_POST['password'], PASSWORD_BCRYPT); // Secure password hashing
    $phone_number = $_POST['phone_number'];

    $sql = "INSERT INTO programmers (name, id_number, email, password, phone_number) 
            VALUES ('$name', '$id_number', '$email', '$pwd', '$phone_number')";

    if ($conn->query($sql) === TRUE) {
        echo "New programmer added successfully!";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

if (empty($_POST["id_number"])) {// Staff ID validation process
	$IDErr = "<p style='color:red;'>ID number is required</p>";
	}else{
		$id_number = $_POST["id_number"];
		if(!preg_match('/^SS+\d\d\d\d*$/',$id_number) and strlen($id_number)!=6){
			$IDErr = "<p style='color:red;'>ID number should start with SS followed by the number</p>";
		}
	
	}
?>