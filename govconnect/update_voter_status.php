<?php
session_start();

// Check if the user is logged in and is a 'rider'
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
        // Prepare the SQL statement to update the status
        $stmt = $conn->prepare("UPDATE voter SET status = ? WHERE id = ?");
        if ($stmt === false) {
            die("Prepare failed: " . $conn->error);
        }

        // Bind parameters
        $stmt->bind_param("si", $status, $request_id);

        // Execute the statement
        if ($stmt->execute()) {
            // Redirect back to the view page with a success message
            header("Location: view_voter_requests.php?message=Status updated successfully");
            exit;
        } else {
            echo "Error updating status: " . $stmt->error;
        }
        $stmt->close();
    } else {
        echo "Invalid input.";
    }
}

// Close the database connection
$conn->close();
?>