<?php
session_start();

if (!isset($_SESSION["Email"]) || $_SESSION["usertype"] !== 'rider') {
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
    <title>Rider Homepage</title>
    <link rel="stylesheet" href="riderhomepage.css">
</head>
<body>
    <div class="navbar">
        <marquee behavior="scroll" direction="left">
            Welcome, <?php echo $Fname . " " . $Lname; ?>
        </marquee>
        
        <ul>
            <li><a href="view_birth_requests.php"><span class="icon">Birth</span><span class="full-text">View Birth Certificate Requests</span></a></li>
            <li><a href="view_business_requests.php"><span class="icon">Business</span><span class="full-text">View Business Permit Requests</span></a></li>
            <li><a href="view_voter_requests.php"><span class="icon">Voter</span><span class="full-text">View Voter ID Requests</span></a></li>
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