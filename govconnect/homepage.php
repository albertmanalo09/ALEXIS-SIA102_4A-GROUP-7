<?php
session_start();

if (!isset($_SESSION["Email"])) {
    header("Location: login.php");
    exit;
}

$Email = $_SESSION["Email"];
$Fname = $_SESSION["Fname"];
$Lname = $_SESSION["Lname"];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Homepage</title>
    <link rel="stylesheet" href="home.css">
</head>
<body>
    <div class="navbar">
        <marquee behavior="scroll" direction="left">
            Welcome, <?php echo $Fname . " " . $Lname; ?>
        </marquee>
        
        <ul>
            <li><a href="business.php"><span class="icon">B</span><span class="full-text">Business Permit</span></a></li>
            <li><a href="voter.php"><span class="icon">V</span><span class="full-text">Voter's ID (Registration)</span></a></li>
            <li><a href="birth.php"><span class="icon">BC</span><span class="full-text">Birth Certificate</span></a></li>
        </ul>
        
        <div class="logout-button">
            <p><a href="logout.php">
                <img src="logout_icon_white.png" alt="Logout Icon">
                <span class="full-text">Logout</span>
            </a></p>
        </div>
    </div>
</body>
</html>