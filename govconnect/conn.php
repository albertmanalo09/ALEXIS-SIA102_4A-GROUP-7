<?php
// Connect to the database
$conn = mysqli_connect("localhost", "root", "", "dbg");

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
?>