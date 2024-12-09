<?php
include('conn.php'); // This includes the connection file

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Check if the required keys exist in the $_POST array
    if (isset($_POST['ID'], $_POST['Uname'], $_POST['Fname'], $_POST['Mname'], $_POST['Lname'], $_POST['Password'], $_POST['Location'], $_POST['Gender'], $_POST['usertype'])) {
        // Retrieve form data
        $ID = $_POST['ID'];
        $Uname = $_POST['Uname'];
        $Fname = $_POST['Fname'];
        $Mname = $_POST['Mname'];
        $Lname = $_POST['Lname'];
        $Password = $_POST['Password'];
        $Location = $_POST['Location'];
        $Gender = $_POST['Gender'];
        $usertype = $_POST['usertype'];

        // Update
        if (isset($_POST['update'])) {
            $stmt = $conn->prepare("UPDATE register SET Uname=?, Fname=?, Mname=?, Lname=?, Password=?, Location=?, Gender=?, usertype=? WHERE ID=?");
            $stmt->bind_param("ssssssssi", $Uname, $Fname, $Mname, $Lname, $Password, $Location, $Gender, $usertype, $ID);
            
            if ($stmt->execute()) {
                echo '<script>alert("Record Updated!");</script>';
                echo '<script>window.location.assign("viewuser.php");</script>';
            } else {
                echo 'Error Updating: ' . $stmt->error;
            }
            $stmt->close();
        }

        // Delete
        if (isset($_POST['delete'])) {
            $stmt = $conn->prepare("DELETE FROM register WHERE ID=?");
            $stmt->bind_param("i", $ID);
            
            if ($stmt->execute()) {
                echo '<script>alert("Record Deleted!");</script>';
                echo '<script>window.location.assign("viewuser.php");</script>';
            } else {
                echo 'Error Deleting: ' . $stmt->error;
            }
            $stmt->close();
        }
    } else {
        echo 'Some required fields are missing.';
    }
}
?>