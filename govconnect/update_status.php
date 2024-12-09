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

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $request_id = $_POST['request_id'];
    $status = $_POST['status'];

    // Debugging output
    var_dump($request_id, $status); // Uncomment this line for debugging

    // Validate input
    if (empty($request_id) || empty($status)) {
        echo "Invalid request data.";
        exit;
    }

    // Prepare the SQL statement
    $sql = "UPDATE birth SET status = ? WHERE id = ?";
    $stmt = $conn->prepare($sql);
    
    if ($stmt === false) {
        die("Prepare failed: " . $conn->error);
    }

    // Bind parameters and execute
    $stmt->bind_param("si", $status , $request_id);
    if ($stmt->execute()) {
        echo "Status updated successfully.";
    } else {
        echo "Error updating status: " . $stmt->error;
    }

    $stmt->close();
}

$conn->close();
header("Location: view_birth_requests.php");
exit;
?>