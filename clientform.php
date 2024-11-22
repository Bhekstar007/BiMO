<!-- form.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Client Information Form</title>
</head>
<body>
<a href='display.php'>Back</a>
    <h2>Client Information Form</h2>
    <form action="submit.php" method="POST">
        <label for="name">Name:</label>
        <input type="text" id="name" name="name" required><br><br>

        <label for="company">Company:</label>
        <input type="text" id="company" name="company" required><br><br>

        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required><br><br>

        <label for="phone">Phone Number:</label>
        <input type="text" id="phone" name="phone" required><br><br>

        <label for="company_address">Company Address:</label>
        <input type="text" id="company_address" name="company_address" required><br><br>

        <label for="project_id">Project ID:</label>
        <input type="text" id="project_id" name="project_id" required><br><br>
        
        <button type="submit">Submit</button>
    </form>
</body>
</html>
