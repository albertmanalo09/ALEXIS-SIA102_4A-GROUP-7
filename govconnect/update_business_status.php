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
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $request_id = $_POST['request_id'];
    $status = $_POST['status'];

    // Validate input
    if (!empty($request_id) && !empty($status)) {
        // Update the status in the database
        $stmt = $conn->prepare("UPDATE business SET status = ? WHERE id = ?");
        $stmt->bind_param("si", $status, $request_id);

        if ($stmt->execute()) {
            // Redirect back to the view page with a success message
            header("Location: view_business_requests.php?message=Status updated successfully");
            exit;
        } else {
            echo "Error updating status: " . $conn->error;
        }
        $stmt->close();
    } else {
        echo "Invalid input.";
    }
}

$conn->close();
?>