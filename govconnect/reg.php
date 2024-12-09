<?php
// Configuration
$db_host = 'localhost';
$db_username = 'root';
$db_password = '';
$db_name = 'dbg';

// Create a connection
$conn = new mysqli($db_host, $db_username, $db_password, $db_name);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Registration
// Registration
if (isset($_POST['register'])) {
    $username = $_POST["username"];
    $Fname = $_POST["Fname"];
    $Mname = $_POST["Mname"];
    $Lname = $_POST["Lname"];
    $Email = $_POST["email"];
    $Password = $_POST["password"]; // Keep the plain text password
    $Gender = $_POST["gender"];
    $Age = $_POST["age"];
    $Location = $_POST["location"];

    // Insert the data into the table
    $stmt = $conn->prepare("INSERT INTO register (Uname, Fname, Mname, Lname, Email, Password, Gender, Age, Location) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("sssssssss", $username, $Fname, $Mname, $Lname, $Email, $Password, $Gender, $Age, $Location);

    if ($stmt->execute()) {
        echo "Registration successful!";
        header('Location: login.php'); // Redirect to login page
        exit;
    } else {
        echo "Error: " . $stmt->error;
    }
}

// Close the connection
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GovConnect Registration</title>
    <!-- Link to Font Awesome for icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-image: url('bg1.png'); /* Updated background image */
            background-size: cover;
            background-repeat: no-repeat;
            background-position: center;
            background-attachment: fixed;
            margin: 0;
            padding: 40px 0; /* Added padding to create space at the top and bottom */
            display: flex;
            justify-content: center;
            align-items: flex-start; /* Align items at the start for better spacing */
            min-height: 100vh; /* Ensure the body covers the full viewport */
            position: relative;
        }

        /* Fix the dark overlay to cover full viewport */
        body::before {
            content: "";
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(0, 0, 0, 0.6); /* Dark overlay */
            z-index: 1;
        }

        .registration-container {
            background-color: rgba(255, 255, 255, 0.9); /* Transparent effect */
            border-radius: 10px;
            padding: 30px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
            max-width: 400px;
            width: 100%;
            text-align: center;
            z-index: 2; /* Ensure it's above the overlay */
            position: relative;
        }

        .registration-container h2 {
            font-size: 28px;
            color: #333;
            margin-bottom: 20px;
            font-weight: bold;
        }

        label {
            font-size: 14px;
            color: #333;
            display: block;
            text-align: left;
            margin-bottom: 8px;
        }

        input[type="text"],
        input[type="email"],
        input[type="password"],
        input[type="number"] {
            width: 100%;
            padding: 12px;
            margin-bottom: 20px;
            border: 1px solid #ccc;
            border-radius: 50px;
            font-size: 14px;
            box-sizing: border-box;
        }

        select {
            width: 100%;
            padding: 12px;
            margin-bottom: 20px;
            border: 1px solid #ccc;
            border-radius: 50px;
            font-size: 14px;
            box-sizing: border-box;
        }

        input[type="submit"] {
            width: 100%;
            padding: 12px;
            background-color: #333;
            color: white;
            border: none;
            border-radius: 50px;
            cursor: pointer;
            font-size: 16px;
        }

        input[type="submit"]:hover {
            background-color: #555;
        }

        p {
            margin-top: 15px;
            font-size: 14px;
            color: #666;
        }

        a {
            color: #000;
            text-decoration: none;
            font-weight: bold;
        }

        a:hover {
            text-decoration: underline;
        }

        /* Placeholder styling */
        input::placeholder {
            font-style: italic;
            color: #999;
        }

    </style>
</head>

<body>
    <div class="registration-container">
        <h2>Register</h2>
        <form action="" method="post" onsubmit="return validateForm();">
            <label for="username">Username:</label>
            <input type="text" id="username" name="username" placeholder="Enter your username" required><br>

            <label for="Fname">First Name:</label>
            <input type="text" id="Fname" name="Fname" placeholder="Enter your FirstName" required><br>

            <label for="Mname">Middle Name:</label>
            <input type="text" id="Mname" name="Mname" placeholder="Enter your MiddleName" required><br>

            <label for="Lname">Last Name:</label>
            <input type="text" id="Lname" name="Lname" placeholder="Enter your LastName" required><br>

            <label for="email">Email:</label>
            <input type="email" id="email" name="email" placeholder="example@example.com" required><br>

            <label for="password">Password:</label>
            <input type="password" id="password" name="password" placeholder="Enter your password" required><br>

            <label for="confirm-password">Confirm Password:</label>
            <input type="password" id="confirm-password" name="confirm-password" placeholder="Re-enter your password" required><br>

            <label for="gender">Gender:</label>
            <select id="gender" name="gender" required>
                <option value="">Select your gender</option>
                <option value="male">Male</option>
                <option value="female">Female</option>
                <option value="other">Other</option>
            </select><br>

            <label for="age">Age:</label>
            <input type="number" id="age" name="age" min="18" max="100" placeholder="Enter your age" required><br>

            <label for="location">Location:</label>
            <input type="text" id="location" name="location" placeholder="Enter your location" required><br>

            <input type="submit" name="register" value="Register">
        </form>
    </div>

    <script>
        function validateForm() {
            var password = document.getElementById("password").value;
            var confirmPassword = document.getElementById("confirm-password").value;

            if (password != confirmPassword) {
                alert("Passwords do not match!");
                return false;
            } else {
                alert("You are now registered!");
                return true;
            }
        }
    </script>
</body>
</html>