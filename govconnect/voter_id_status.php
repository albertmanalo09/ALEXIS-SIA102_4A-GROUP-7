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

// Fetch voter ID status for the logged-in user
$email = $_SESSION["Email"]; 
$sql = "SELECT * FROM voter WHERE email = ?"; 
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
    <title>Voter ID Status</title> 
    <link rel="stylesheet" href="voter_id_status.css">
</head> 
<body> 
    <div class="container">
        <h1 class="title">Voter ID Status</h1> 
        <?php if ($result->num_rows > 0): ?> 
        <table class="voter-table"> 
            <tr> 
                <th>Full Name</th> 
                <th>Date of Birth</th> 
                <th>Address</th> 
                <th>Contact</th> 
                <th>Email</th> 
                <th>Status</th> 
            </tr> 
            <?php while ($row = $result->fetch_assoc()): ?> 
            <tr> 
                <td><?php echo htmlspecialchars($row['fname']); ?></td> 
                <td><?php echo htmlspecialchars($row['birth']); ?></td> 
                <td><?php echo htmlspecialchars($row['address']); ?></td> 
                <td><?php echo htmlspecialchars($row['contact']); ?></td> 
                <td><?php echo htmlspecialchars($row['email']); ?></td> 
                <td><?php echo htmlspecialchars($row['status']); ?></td> 
            </tr> 
            <?php endwhile; ?> 
        </table> 
        <?php else: ?>
            <p class="no-data">No voter ID requests found for this email.</p>
        <?php endif; ?>

        <div class="button-container">
            <a href="voter.php" class="back-button">Back</a>
        </div>
    </div>
</body> 
</html>

<?php 
// Close the database connection
$stmt->close();
$conn->close(); 
?>