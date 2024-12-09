<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Voter's ID Registration</title>
    <link rel="stylesheet" href="vote.css">
</head>
<body>
    <?php
    // Include server-side logic
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "dbg";
    $message = "";
    $messageClass = "";

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Database connection
        $conn = new mysqli($servername, $username, $password, $dbname);

        if ($conn->connect_error) {
            $message = "Connection failed: " . $conn->connect_error;
            $messageClass = "error";
        } else {
            $fullName = trim($_POST['fname']);
            $dateOfBirth = trim($_POST['birth']);
            $address = trim($_POST['address']);
            $contactNumber = trim($_POST['contact']);
            $email = trim($_POST['email']);

            if (empty($fullName) || empty($dateOfBirth) || empty($address) || empty($contactNumber) || empty($email)) {
                $message = "All fields are required.";
                $messageClass = "error";
            } else {
                $stmt = $conn->prepare("INSERT INTO voter (fname, birth, address, contact, email, status) VALUES (?, ?, ?, ?, ?, 'Pending')");
                $stmt->bind_param("sssss", $fullName, $dateOfBirth, $address, $contactNumber, $email);

                if ($stmt->execute()) {
                    $message = "Registration successful!";
                    $messageClass = "success";
                } else {
                    $message = "Error: " . $stmt->error;
                    $messageClass = "error";
                }
                $stmt->close();
            }
            $conn->close();
        }
    }
    ?>

    <div class="navbar">
        <marquee behavior="scroll" direction="left">
            Voter's ID Registration
        </marquee>
        <ul>
            <li><a href="#" id="requestVoterIDLink"><span class="icon">R</span><span class="full-text">Request for Voter's ID</span></a></li>
            <li><a href="voter_id_status.php"><span class="icon">S</span><span class="full-text">Voter's ID Status</span></a></li>
        </ul>
        <div class="logout-button">
            <p><a href="homepage.php">
                <img src="back_icon_white.png" alt="Back Icon">
                <span class="full-text">Back</span>
            </a></p>
        </div>
    </div>

    <!-- Message Box -->
    <?php if (!empty($message)) : ?>
    <div class="message-box <?php echo $messageClass; ?>">
        <?php echo $message; ?>
    </div>
    <?php endif; ?>

    <!-- Modal -->
    <div id="voterModal" class="modal">
        <div class="modal-content">
            <div class="form-header">
                <span class="close">&times;</span>
                <h2>Voter's ID Application Form</h2>
            </div>
            <form action="" method="POST">
                <label for="voterName">Full Name:</label>
                <input type="text" id="voterName" name="fname" required placeholder="Enter Full Name">

                <label for="birthDate">Date of Birth:</label>
                <input type="date" id="birthDate" name="birth" required class="styled-input">

                <label for="address">Address:</label>
                <input type="text" id="address" name="address" required placeholder="Enter Address">

                <label for="contact">Contact Number:</label>
                <input type="text" id="contact" name="contact" required placeholder="Enter Contact Number">

                <label for="email">Email:</label>
                <input type="email" id="email" name="email" required placeholder="Enter Email">

                <input type="submit" value="Submit">
            </form>
        </div>
    </div>

    <script>
        var modal = document.getElementById("voterModal");
        var requestVoterIDLink = document.getElementById("requestVoterIDLink");
        var closeBtn = document.getElementsByClassName("close")[0];

        requestVoterIDLink.onclick = function(event) {
            event.preventDefault();
            modal.style.display = "flex";
            modal.classList.add('show');
        }

        closeBtn.onclick = function() {
            modal.classList.remove('show');
            setTimeout(() => { modal.style.display = "none"; }, 300);
        }

        window.onclick = function(event) {
            if (event.target == modal) {
                modal.classList.remove('show');
                setTimeout(() => { modal.style.display = "none"; }, 300);
            }
        }
    </script>
</body>
</html>