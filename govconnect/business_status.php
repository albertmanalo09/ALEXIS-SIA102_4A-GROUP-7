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

// Fetch business permit requests for the logged-in user
$email = $_SESSION["Email"]; 
$sql = "SELECT * FROM business WHERE email = ?"; // Assuming 'owner_email' is the column that stores the owner's email
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
    <title>Business Permit Status</title> 
    <link rel="stylesheet" href="business_status.css">
</head> 
<body> 
    <div class="container">
        <h1>Your Business Permit Status</h1> 
        <table> 
            <tr> 
                <th>Business Name</th> 
                <th>Owner's Name</th> 
                <th>Address</th> 
                <th>Business Type</th> 
                <th>Status</th> 
            </tr> 
            <?php if ($result->num_rows > 0): ?> 
                <?php while ($row = $result->fetch_assoc()): ?> 
                    <tr> 
                        <td><?php echo htmlspecialchars($row['bname']); ?></td> 
                        <td><?php echo htmlspecialchars($row['oname']); ?></td> 
                        <td><?php echo htmlspecialchars($row['address']); ?></td> 
                        <td><?php echo htmlspecialchars($row['btype']); ?></td> 
                        <td><?php echo htmlspecialchars($row['status']); ?></td> 
                    </tr> 
                <?php endwhile; ?> 
            <?php else: ?> 
                <tr> 
                    <td colspan="5">No business requests found.</td> 
                </tr> 
            <?php endif; ?> 
        </table> 
        
        <br>
        <a href="business.php" class="back-button">Back</a>
    </div>
</body> 
</html>

<?php 
// Close the database connection
$stmt->close();
$conn->close(); 
?>