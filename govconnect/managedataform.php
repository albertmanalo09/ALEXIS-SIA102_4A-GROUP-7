<!DOCTYPE html>
<html lang="en">
<head>
    <title>Manage Data Forms</title>
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
        <h1>Manage Data Forms</h1>
    </div>
    <br>
    
    <?php
        // Database connection parameters
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "dbg"; // Ensure this matches your actual database name
        
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
                    <th style='background-color: #337ab7; color: #fff;'> ID </th>
                    <th style='background-color: #337ab7; color: #fff;'> USERNAME </th>
                    <th style='background-color: #337ab7; color: #fff;'> FIRSTNAME</th>
                    <th style='background-color: #337ab7; color: #fff;'> MIDDLENAME</th>
                    <th style='background-color: #337ab7; color: #fff;'> LASTNAME</th>
                    <th style='background-color: #337ab7; color: #fff;'> PASSWORD</th>
                    <th style='background-color: #337ab7; color: #fff;'> ADDRESS</th>
                    <th style='background-color: #337ab7; color: #fff;'> GENDER</th>
                    <th style='background-color: #337ab7; color: #fff;'> USER TYPE </th>
                    <th colspan='2' style='background-color: #337ab7; color: #fff;'> Manage </th>
                </tr>";
            while($row = $result->fetch_assoc()) {
                echo "<form action='managedata.php' method='post'>";
                echo "<tr>
                        <td>{$row['ID']}</td>
                        <input type='hidden' name='ID' value='{$row['ID']}'>
                        <td><input type='text' name='Uname' value='{$row['Uname']}' class='form-control'></td>
                        <td><input type='text' name='Fname' value='{$row['Fname']}' class='form-control'></td>
                        <td><input type='text' name='Mname' value='{$row['Mname']}' class='form-control'></td>
                        <td><input type='text' name='Lname' value='{$row['Lname']}' class='form-control'></td>
                        <td><input type='text' name='Password' value='{$row['Password']}' class='form-control'></td>
                        <td><input type='text' name='Location' value='{$row['Location']}' class='form-control'></td>
                        <td><input type='text' name='Gender' value='{$row['Gender']}' class='form-control'></td>
                        <td><input type='text' name='usertype' value='{$row['usertype']}' class='form-control'></td>
                        <td><input type='submit' name='update' value='Update' class='btn btn-primary'></td>
                        <td><input type='submit' name='delete' value='Delete' class='btn btn-danger'></td>
                    </tr>";
                echo "</form>";
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