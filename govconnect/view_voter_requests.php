<?php
session_start();

if (!isset($_SESSION["Email"]) || $_SESSION["usertype"] !== 'rider') {
    header("Location: login.php");
    exit;
}

// Database connection
$conn = new mysqli("localhost", "root", "", "dbg");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch voter ID requests
$sql = "SELECT * FROM voter"; // Adjust the query as needed
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Voter ID Requests</title>
    <link rel="stylesheet" href="admin.css">
</head>
<body>
    <div class="container">
        <h2>Voter ID Requests</h2>
        <table>
            <tr>
                <th>Full Name</th>
                <th>Date of Birth</th>
                <th>Address</th>
                <th>Contact</th>
                <th>Email</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
            <?php if ($result->num_rows > 0): ?>
                <?php while ($row = $result->fetch_assoc()): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($row['fname']); ?></td>
                        <td><?php echo htmlspecialchars($row['birth']); ?></td>
                        <td><?php echo htmlspecialchars($row['address']); ?></td>
                        <td><?php echo htmlspecialchars($row['contact']); ?></td>
                        <td><?php echo htmlspecialchars($row['email']); ?></td>
                        <td><?php echo htmlspecialchars($row['status']); ?></td>
                        <td>
                            <form action="update_voter_status.php" method="POST">
                                <input type="hidden" name="request_id" value="<?php echo htmlspecialchars($row['id']); ?>">
                                <select name="status" required>
                                    <option value="">Select Status</option>
                                    <option value="Pending" <?php echo ($row['status'] == 'Pending') ? 'selected' : ''; ?>>Pending</option>
                                    <option value="Approved" <?php echo ($row['status'] == 'Approved') ? 'selected' : ''; ?>>Approved</option>
                                    <option value="Denied" <?php echo ($row['status'] == 'Denied') ? 'selected' : ''; ?>>Denied</option>
                                    <option value="Incomplete" <?php echo ($row['status'] == 'Incomplete') ? 'selected' : ''; ?>>Incomplete</option>
                                </select>
                                <button type="submit">Update Status</button>
                            </form>
                        </td>
                    </tr>
                <?php endwhile; ?>
            <?php else: ?>
                <tr>
                    <td colspan="7">No requests found.</td>
                </tr>
            <?php endif; ?>
        </table>
        <br>
        <input type="button" value="Back" onclick="window.location.href='riderhomepage.php';">
    </div>
</body>
</html>

<?php
$conn->close();
?>