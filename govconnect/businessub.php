<?php
header('Content-Type: application/json');

// Database configuration
$host = "localhost";
$dbname = "dbg";
$username = "root";
$password = "";

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $businessName = trim($_POST['bname']);
        $ownerName = trim($_POST['oname']);
        $address = trim($_POST['address']);
        $email = trim($_POST['email']);
        $businessType = trim($_POST['btype']);

        if (empty($businessName) || empty($ownerName) || empty($address) || empty($email) || empty($businessType)) {
            echo json_encode(['status' => 'error', 'message' => 'All fields are required.']);
        } else {
            $sql = "INSERT INTO business (bname, oname, address, email, btype, status) VALUES (:bname, :oname, :address, :email, :btype, 'Pending')";
            $stmt = $pdo->prepare($sql);

            $stmt->bindParam(':bname', $businessName);
            $stmt->bindParam(':oname', $ownerName);
            $stmt->bindParam(':address', $address);
            $stmt->bindParam(':email', $email);
            $stmt->bindParam(':btype', $businessType);

            if ($stmt->execute()) {
                echo json_encode(['status' => 'success', 'message' => 'Permit submitted successfully!']);
            } else {
                echo json_encode(['status' => 'error', 'message' => 'Error submitting the permit.']);
            }
        }
    }
} catch (PDOException $e) {
    echo json_encode(['status' => 'error', 'message' => 'Connection failed: ' . $e->getMessage()]);
}