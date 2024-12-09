<?php
// Database connection parameters
$db_host = 'localhost'; 
$db_port = 3306; 
$db_username = 'root';
$db_password = ''; 
$db_name = 'dbg';

// Create a connection
$conn = new mysqli($db_host, $db_username, $db_password, $db_name, $db_port);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Registration
if (isset($_POST['register'])) {
    $username = $_POST["username"];
    $Fname = $_POST["Fname"];
    $Mname = $_POST["Mname"];
    $Lname = $_POST["Lname"];
    $Email = $_POST["email"];
    $Password = $_POST["password"];
    $Gender = $_POST["gender"];
    $Age = $_POST["age"];
    $Location = $_POST["location"];
    
    // Assuming you have a way to set user type (e.g., from a form or defaulting to 'rider')
    $usertype = 'rider'; // This can be changed based on your application logic

    // Validate and sanitize user input
    $username = $conn->real_escape_string($username);
    $Fname = $conn->real_escape_string($Fname);
    $Mname = $conn->real_escape_string($Mname);
    $Lname = $conn->real_escape_string($Lname);
    $Email = $conn->real_escape_string($Email);
    $Password = $conn->real_escape_string($Password); // No hashing here
    $Gender = $conn->real_escape_string($Gender);
    $Age = $conn->real_escape_string($Age);
    $Location = $conn->real_escape_string($Location);

    // Insert the data into the table
    $stmt = $conn->prepare("INSERT INTO register (Uname, Fname, Mname, Lname, Email, Password, Gender, Age, Location, usertype) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ssssssssss", $username, $Fname, $Mname, $Lname, $Email, $Password, $Gender, $Age, $Location, $usertype);
    $stmt->execute();

    // Check if the data is inserted
    if ($stmt->affected_rows == 1) {
        echo "Registration successful!";
    } else {
        echo "Registration failed!";
    }
}

// Login
if (isset($_POST['login'])) {
    $Email = $_POST["email"] ?? ''; // Use null coalescing to set a default
    $Password = $_POST["password"] ?? '';

    // Validate and sanitize user input
    $Email = $conn->real_escape_string($Email);
    $Password = $conn->real_escape_string($Password);

    // Retrieve the password and user type from the database
    $stmt = $conn->prepare("SELECT Password, Fname, Lname, usertype FROM register WHERE Email = ?");
    $stmt->bind_param("s", $Email);
    $stmt->execute();
    $stmt->bind_result($storedPassword, $Fname, $Lname, $usertype);
    $stmt->fetch();

    // Verify the password
    if ($Password === $storedPassword) { // Compare plain text passwords
        session_start();
        $_SESSION["Email"] = $Email;
        $_SESSION["Fname"] = $Fname;
        $_SESSION["Lname"] = $Lname;
        $_SESSION["usertype"] = $usertype;

        // Redirect based on user type
        if ($usertype === 'admin') {
            header('Location: adminhomepage.php');
        } elseif ($usertype === 'rider') {
            header('Location: riderhomepage.php');
        } else {
            header('Location: homepage.php');
        }
        exit;
    } else {
        echo "<script>alert('Password or email are incorrect');</script>";
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
    <title>GovConnect Login</title>
    <!-- Link to Font Awesome for icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax /libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-image: url('bg (login).jpg'); /* Set the background image */
            background-size: 80%; /* Ensure the image is not zoomed and fully visible */
            background-repeat: no-repeat; /* Prevent repeating */
            background-position: center; /* Center the image */
            background-attachment: fixed; /* Keep the background fixed on scroll */
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            position: relative;
        }

        /* Add dark overlay to background */
        body::before {
            content: "";
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(0, 0, 0, 0.6); /* Dark overlay */
            z-index: 1;
        }

        .login-container {
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

        .login-container h2 {
            font-size: 28px;
            color: #333;
            margin-bottom: 20px;
            font-weight: bold;
        }

        .logo-text {
            font-size: 32px;
            font-weight: bold;
            color: #000;
            margin-bottom: 10px;
        }

        label {
            font-size: 14px;
            color: #333;
            display: block;
            text-align: left;
            margin-bottom: 8px;
        }

        input[type="text"],
        input[type="password"] {
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

        .login-container:hover {
            box-shadow: 0 6px 20px rgba(0, 0, 0, 0.2);
        }

        /* Social media section */
        .social-icons {
            margin-top: 20px;
        }

        .social-icons a {
            margin: 0 10px;
            font-size: 24px;
        }

        /* Specific brand colors for each icon */
        .social-icons a .fa-facebook {
            color: #3b5998;
        }

        .social-icons a .fa-google {
            color: #db4437;
        }

        .social-icons a .fa-instagram {
            color: #C13584;
        }

        /* Placeholder styling */
        input[type="text"]::placeholder,
        input[type="password"]::placeholder {
            font-style: italic;
            color: #999;
        }

        /* Checkbox styling */
        .checkbox-container {
            text-align: left;
            margin-top: -10px;
            margin-bottom: 20px;
        }

        .checkbox-container input {
            margin-right: 8px;
        }

    </style>
</head>

<body>
    <div class="login-container">
        <div class="logo-text">GovConnect</div>
        <h2>Login</h2>
        <form action="" method="post">
            <label for="email">Email:</label>
            <input type="text" id="email" name="email" placeholder="*****@gmail.com" required>
            <label for="password">Password:</label>
            <input type="password" id="password" name="password" placeholder="Enter password" required>

            <div class="checkbox-container">
                <input type="checkbox" id="keepSignedIn" name="keepSignedIn">
                <label for="keepSignedIn">Keep me signed in</label>
            </div>

            <input type="submit" name="login" value="Login">
        </form>
        <p>Don't have an account? <a href="reg.php">Click here to register</a></p>

        <!-- Social Media Icons Section -->
        <div class="social-icons">
            <a href="#"><i class="fab fa-facebook"></i></a>
            <a href="#"><i class="fab fa-google"></i></a>
            <a href="#"><i class="fab fa-instagram"></i></a>
        </div>
    </div>
</body>

</html>