<?php
// Change these to your database connection details
$servername = "localhost";
$username = "root";
$password = "root123";
$dbname = "abil";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Initialize message variable
$message = "";

// If the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $dob = $_POST['dob'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $password = $_POST['password'];

    // Options array with cost parameter
    $options = [
        'cost' => 12, // You can adjust the cost as needed, higher values mean slower hashing
        'salt' => "D5f6g7H8i9J0k1L2",
    ];
    $salt = "D5f6g7H8i9J0k1L2";
    // Hash the password (for basic security, use password_hash() in a real-world scenario)
    //$hashed_password = md5($password); // This is not recommended for production, use password_hash() instead
    $passwordWithSalt = $salt . $password;
    $hashed_password = password_hash($passwordWithSalt, PASSWORD_DEFAULT);

    // Prepare and bind the SQL statement
    $stmt = $conn->prepare("INSERT INTO users (name, dob, email, phone, password) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("sssss", $name, $dob, $email, $phone, $hashed_password);

    // Execute the statement
    if ($stmt->execute()) {
        $message = "Registration successful!";
        sleep(2);
        header("Location: dashboard.html");

    } else {
        $message = "Error: " . $stmt->error;
    }

    // Close the statement and connection
    $stmt->close();
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>College Bus Management Sign Up</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color:#f3f0ff;
            margin: 0;
            padding: 20px;
        }

        .main {
            max-width: 400px;
            margin: 0 auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            background-repeat: no-repeat;
        }

        h2 {
            text-align: center;
            margin-bottom: 20px;
            color: #333;
        }

        form {
            display:grid;
            gap: 15px;
            height: 580px;
            
        }

        label {
            font-weight: bold;
            color: #555;
        }

        input {
            padding: 10px;
            border-radius: 5px;
            border: 1px solid #ccc;
            transition: border-color 0.3s;
        }

        input:focus {
            outline: none;
            border-color: #39f;
        }

        .error {
            color: red;
            font-size: 12px;
        }

        .loading {
            text-align: center;
            color: #333;
            font-weight: bold;
            animation: spin 1s linear infinite;
        }

        @keyframes spin {
            0% {
                transform: rotate(0deg);
            }
            100% {
                transform: rotate(360deg);
            }
        }

        input[type="submit"] {
            background-color: #39f;
            color: #fff;
            cursor: pointer;
            border: none;
            padding: 10px;
            border-radius: 5px;
            transition: background-color 0.3s;
        }

        input[type="submit"]:hover {
            background-color: #1c7ed6;
        }

        .success {
            color: #008000;
            font-weight: bold;
            text-align: center;
            margin-top: 10px;
        }
    </style>
</head>
<body>

    <div class="main">
        <h2>College Bus Management - Sign Up</h2>
        <form id="signupForm" onsubmit="submitForm(event)" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
            <label for="name">Name:</label>
            <input type="text" id="name" name="name" required>

            <label for="dob">Date of Birth:</label>
            <input type="date" id="dob" name="dob" required>
            
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required>
            <span id="emailError" class="error"></span>

            <label for="phone">Phone Number:</label>
            <input type="tel" id="phone" name="phone" required>
            <span id="phoneError" class="error"></span>

            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required>
            <span id="passwordError" class="error"></span>
    
            <label for="confirmPassword">Confirm Password:</label>
            <input type="password" id="confirmPassword" name="confirmPassword" required>
            <span id="confirmPasswordError" class="error"></span>
    
            <input type="submit" value="Sign Up">
            <div id="loading" class="loading" style="display: none;"></div>
        </form>
        
        <?php if (!empty($message)): ?>
        <p class="success"><?php echo $message; ?></p>
        <?php endif; ?>
    </div>

    <script>
        function submitForm(event) {
            event.preventDefault();
            
            const name = document.getElementById('name').value;
            const dob = document.getElementById('dob').value;
            const email = document.getElementById('email').value;
            const phone = document.getElementById('phone').value;
            const password = document.getElementById('password').value;
            const confirmPassword = document.getElementById('confirmPassword').value;

            const emailError = document.getElementById('emailError');
            const phoneError = document.getElementById('phoneError');
            const passwordError = document.getElementById('passwordError');
            const confirmPasswordError = document.getElementById('confirmPasswordError');
            const loading = document.getElementById('loading');

            // Clear previous error messages
            emailError.textContent = "";
            phoneError.textContent = "";
            passwordError.textContent = "";
            confirmPasswordError.textContent = "";

            // Validate email
            if (!isValidEmail(email)) {
                emailError.textContent = "Invalid email format";
                return;
            }

            // Validate phone number
            if (!isValidPhone(phone)) {
                phoneError.textContent = "Invalid phone number";
                return;
            }

            // Validate password
            if (password.length < 8) {
                passwordError.textContent = "Password must be at least 8 characters long.";
                return;
            }

            // Confirm password
            if (password !== confirmPassword) {
                confirmPasswordError.textContent = "Passwords do not match.";
                return;
            }

            // If all validations pass, show loading animation
            loading.style.display = "block";

            // Submit the form
            document.getElementById("signupForm").submit();
        }

        function isValidEmail(email) {
            // Basic email format validation
            const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            return emailRegex.test(email);
        }

        function isValidPhone(phone) {
            // Basic phone number format validation
            const phoneRegex = /^\d{10}$/;
            return phoneRegex.test(phone);
        }
    </script>
</body>
</html>
