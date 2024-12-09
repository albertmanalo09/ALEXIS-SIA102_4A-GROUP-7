<!DOCTYPE html>
<html lang="en">
<head>
    <title>List of Users</title>
    <link rel="stylesheet" href="admin.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>

<body>
<div class="navbar">
    <marquee behavior="scroll" direction="left">
        <?php
        session_start(); // Start the session
        // Assuming you store the user's first name and last name in the session upon login
        if (isset($_SESSION['Fname']) && isset($_SESSION['Lname'])) {
            $Fname = $_SESSION['Fname'];
            $Lname = $_SESSION['Lname'];
        } else {
            $Fname = "User "; // Default value if not set
            $Lname = ""; // Default value if not set
        }
        echo "Welcome, " . htmlspecialchars($Fname . " " . $Lname);
        ?>
    </marquee>
    
    <ul>
        <li><a href="viewuser.php"><span class="icon">View User</span><span class="full-text">View User</span></a></li>
        <li><a href="managedataform.php"><span class="icon">Manage Data Form</span><span class="full-text">Manage Data Form</span></a></li>
        <li><a href="adminhomepage.php"><span class="icon">Back</span><span class="full-text">Back</span></a></li>
    </ul>
    <div class="logout-button">
            <p><a href="logout.php">
                <img src="logout_icon_white.png" alt="Logout Icon">
                <span class="full-text">Logout</span>
            </a></p>
        </div>
</div>

<div class="container">
    <div class="myheader">
        <h1>List of Users</h1>
    </div>
    <br>
    
    <?php
        // Database connection parameters
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "dbg"; // Make sure this matches your actual database name
        
        // Create connection
        $db = new mysqli($servername, $username, $password, $dbname);
        
        // Check connection
        if ($db->connect_error) {
            die("Connection failed: " . $db->connect_error);
        }
        
        // Query to fetch data
        $sql = "SELECT * FROM register";
        $result = $db->query($sql);
        
        if ($result->num_rows > 0) {
            // Output data of each row
            echo "<table border='1' width='100%' style='border-collapse: collapse'>";
            echo "<tr align='center'>
                    <th style='background-color: #337ab7; color: #fff;'>  ID </th>
                    <th style='background-color: #337ab7; color: #fff;'> USERNAME </th>
                    <th style='background-color: #337ab7; color: #fff;'> FIRSTNAME</th>
                    <th style='background-color: #337ab7; color: #fff;'> MIDDLENAME</th>
                    <th style='background-color: #337ab7; color: #fff;'> LASTNAME</th>
                    <th style='background-color: #337ab7; color: #fff;'> PASSWORD</th>
                    <th style='background-color: #337ab7; color: #fff;'> ADDRESS</th>
                    <th style='background-color: #337ab7; color: #fff;'> GENDER</th>
                    <th style='background-color: #337ab7; color: #fff;'> USER TYPE </th>
                </tr>";
            while($row = $result->fetch_assoc()) {
                echo "<tr>
                        <td>{$row['ID']}</td>
                        <td>{$row['Uname']}</td>
                        <td>{$row['Fname']}</td>
                        <td>{$row['Mname']}</td>
                        <td>{$row['Lname']}</td>
                        <td>{$row['Password']}</td>
                        <td>{$row['Location']}</td>
                        <td>{$row['Gender']}</td>
                        <td>{$row['usertype']}</td>
                    </tr>";
            }
            echo "</table>";
        } else {
            echo "0 results";
        }
        
        // Close connection
        $db->close();
    ?>
    
    <div class="cssclsNoprint">
        <input type="button" onClick="parent.location='adminhomepage.php'" value="BACK">&emsp;&emsp;&emsp;
        <input type="button" onClick="window.print()" value="PRINT">
    </div>
</div>
</body>
</html>