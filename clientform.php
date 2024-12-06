<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Client Information Form</title>
    <link rel="stylesheet" href="phpstyles.css">
    <script src="userinterface/scripts.js" defer></script>
    <style>
        .error-message {
            color: red;
            font-size: 0.9em;
        }
    </style>
</head>
<body>
    <a href='display.php'>Back</a>
    <h2>Client Information Form</h2>
    <form action="submit.php" method="POST" id="clientForm">
        <label for="name">Name:</label>
        <input type="text" id="name" name="name" required pattern="^[A-Za-z\s]+$" title="Name can only contain letters and spaces.">
        <span class="error-message" id="nameError"></span><br><br>

        <label for="company">Company:</label>
        <input type="text" id="company" name="company" required>
        <span class="error-message" id="companyError"></span><br><br>

        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required>
        <span class="error-message" id="emailError"></span><br><br>

        <label for="phone">Phone Number:</label>
        <input type="text" id="phone" name="phone" required 
               pattern="^\+60-?(11|12|13|14|15|16|17|18|19)-?\d{4}-?\d{4}$" 
               title="Phone number must start with +60, followed by 2 digits for area code, and 8 digits for the number (e.g., +60-11-1234-5678). Dashes are optional.">
        <span class="error-message" id="phoneError"></span><br><br>

        <label for="company_address">Company Address:</label>
        <input type="text" id="company_address" name="company_address" required>
        <span class="error-message" id="addressError"></span><br><br>

        <label for="project_id">Project ID:</label>
        <input type="text" id="project_id" name="project_id" required pattern="^PRO-\d{5}$" title="Project ID must follow the format PRO-XXXXX.">
        <span class="error-message" id="projectIdError"></span><br><br>

        <button type="submit">Submit</button>
    </form>

    <script>
        //JavaScript validation
        document.getElementById('clientForm').addEventListener('submit', function(e) {
            let isValid = true;

            //Clear previous errors
            document.querySelectorAll('.error-message').forEach(el => el.textContent = '');

            //Name validation
            const name = document.getElementById('name').value;
            if (!/^[A-Za-z\s]+$/.test(name)) {
                document.getElementById('nameError').textContent = "Please enter a valid name (letters and spaces only).";
                isValid = false;
            }

            //Email validation
            const email = document.getElementById('email').value;
            if (!/^\S+@\S+\.\S+$/.test(email)) {
                document.getElementById('emailError').textContent = "Please enter a valid email address.";
                isValid = false;
            }

            //Phone validation
            const phone = document.getElementById('phone').value;
            if (!/^\+60-?(11|12|13|14|15|16|17|18|19)-?\d{4}-?\d{4}$/.test(phone)) {
                document.getElementById('phoneError').textContent = "Phone number must start with +60, followed by 2 digits for area code, and 8 digits for the number. Dashes are optional.";
                isValid = false;
            }

            //Project ID validation
            const projectId = document.getElementById('project_id').value;
            if (!/^PRO-\d{5}$/.test(projectId)) {
                document.getElementById('projectIdError').textContent = "Project ID must follow the format PRO-XXXXX.";
                isValid = false;
            }

            //Prevent submission if invalid
            if (!isValid) {
                e.preventDefault();
            }
        });
    </script>
</body>
</html>