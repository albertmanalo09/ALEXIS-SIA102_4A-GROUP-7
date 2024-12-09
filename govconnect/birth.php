<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Birth Certificate Request</title>
    <link rel="stylesheet" href="birth.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>
    <?php
    // Database configuration
    $host = "localhost";
    $dbname = "dbg";
    $username = "root";
    $password = "";

    $message = "";
    $messageClass = "";

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Create connection
        $conn = new mysqli($host, $username, $password, $dbname);

        if ($conn->connect_error) {
            $message = "Connection failed: " . $conn->connect_error;
            $messageClass = "error";
        } else {
            // Retrieve and sanitize form data
            $name = trim($_POST['name']);
            $birthDate = trim($_POST['birth']);
            $contactNumber = trim($_POST['contact']);
            $email = trim($_POST['email']);

            // Validate inputs
            if (empty($name) || empty($birthDate) || empty($contactNumber) || empty($email)) {
                $message = "All fields are required.";
                $messageClass = "error";
            } else {
                // Prepare and execute the SQL statement
                $stmt = $conn->prepare("INSERT INTO birth (name, birth, contact, email, status) VALUES (?, ?, ?, ?, 'Pending')");
                $stmt->bind_param("ssss", $name, $birthDate, $contactNumber, $email);

                if ($stmt->execute()) {
                    $message = "Request successful!";
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
            Birth Certificate Request
        </marquee>
        <ul>
            <li><a href="#" id="requestBirthCertBtn"><span class="icon">B</span><span class="full-text">Request for Birth Certificate</span></a></li>
            <li><a href="birth_cert_status.php"><span class="icon">D</span><span class="full-text">Delivery Status</span></a></li>
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
        <?php echo htmlspecialchars($message); ?>
    </div>
    <?php endif; ?>

    <!-- Modal -->
    <div id="birthCertModal" class="modal">
        <div class="modal-content">
            <span class="close">&times;</span>
            <h2>Request for Birth Certificate</h2>
            <form id="birthForm" action="" method="POST">
                <label for="name">Name:</label>
                <input type="text" id="name" name="name" required>

                <label for="date">Date of Birth:</label>
                <input type="date" id="date" name="birth" required>

                <label for="phone">Phone Number:</label>
                <input type="tel" id="phone" name="contact" required>

                <label for="email">Email:</label>
                <input type="email" id="email" name="email" required>

                <input type="submit" value="Submit">
            </form>
        </div>
    </div>

    <script>
        // Elements
        const modal = document.getElementById("birthCertModal");
        const btn = document.getElementById("requestBirthCertBtn");
        const span = document.getElementsByClassName("close")[0];

        // Show modal when button is clicked
        btn.onclick = function(event) {
            event.preventDefault(); // Prevent link's default behavior
            modal.style.display = "flex"; // Show modal
        }

        // Close modal when 'x' button is clicked
        span.onclick = function() {
            modal.style.display = "none";
        }

        // Close modal when clicking outside of modal content
        window.onclick = function(event) {
            if (event.target == modal) {
                modal.style.display = "none";
            }
        }
    </script>
</body>
</html>