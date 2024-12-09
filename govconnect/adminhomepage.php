<?php
session_start();

if (!isset($_SESSION["Email"]) || $_SESSION["usertype"] !== 'admin') {
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
    <title>Admin Homepage</title>
    <link rel="stylesheet" href="home.css">
</head>
<body>
    <div class="navbar">
        <marquee behavior="scroll" direction="left">
            Welcome, <?php echo $Fname . " " . $Lname; ?>
        </marquee>
        
        <ul>
            <li><a href="viewuser.php"><span class="icon">View User</span><span class="full-text">View User</span></a></li>
            <li><a href="managedataform.php"><span class="icon">Manage Data Form</span><span class="full-text">Manage Data Form</span></a></li>
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