<?php 
session_start(); 
if (!isset($_SESSION["Email"])) { 
    header("Location: login.php"); 
    exit; 
}

// Database connection
$conn = new mysqli("localhost", "root", "", "dbg"); 
if ($conn->connect_error) { 
    die("Connection failed: " . $conn->connect_error); 
}

// Fetch birth certificate status for the logged-in user
$email = $_SESSION["Email"]; 
$sql = "SELECT * FROM birth WHERE email = ?"; // Query the birth table
$stmt = $conn->prepare($sql); 
$stmt->bind_param("s", $email); 
$stmt->execute(); 
$result = $stmt->get_result(); 
?>

<!DOCTYPE html> 
<html lang="en"> 
<head> 
    <meta charset="UTF-8"> 
    <meta name="viewport" content="width=device-width, initial-scale=1.0"> 
    <title>Birth Certificate Status</title> 
    <link rel="stylesheet" href="birth_cert_status.css">
</head> 
<body> 
    <div class="container">
        <h1>Birth Certificate Status</h1> 
        <table> 
            <tr> 
                <th>Full Name</th> 
                <th>Date of Birth</th> 
                <th>Contact</th> 
                <th>Email</th> 
                <th>Status</th> 
            </tr> 
            <?php if ($result->num_rows > 0): ?> 
                <?php while ($row = $result->fetch_assoc()): ?> 
                    <tr> 
                        <td><?php echo htmlspecialchars($row['name']); ?></td> 
                        <td><?php echo htmlspecialchars($row['birth']); ?></td> 
                        <td><?php echo htmlspecialchars($row['contact']); ?></td> 
                        <td><?php echo htmlspecialchars($row['email']); ?></td> 
                        <td><?php echo htmlspecialchars($row['status']); ?></td> 
                    </tr> 
                <?php endwhile; ?> 
            <?php else: ?> 
                <tr> 
                    <td colspan="5">No birth certificate requests found.</td> 
                </tr> 
            <?php endif; ?> 
        </table> 
        
        <br>
        <a href="birth.php" class="back-button">Back</a>
    </div>
</body> 
</html>

<?php 
// Close the database connection
$stmt->close();
$conn->close(); 
?>