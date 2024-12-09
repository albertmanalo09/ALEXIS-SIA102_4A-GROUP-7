<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Business Permit</title>
    <link rel="stylesheet" href="business.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>
    <div class="navbar">
        <marquee behavior="scroll" direction="left">
            Business Permit
        </marquee>
        <ul>
            <li><a href="#" id="requestPermitLink"><span class="icon">R</span><span class="full-text">Request for Business Permit</span></a></li>
            <li><a href="business_status.php"><span class="icon">D</span><span class="full-text">Delivery Status</span></a></li>
        </ul>
        <div class="logout-button">
            <p><a href="homepage.php">
                <img src="back_icon_white.png" alt="Back Icon">
                <span class="full-text">Back</span>
            </a></p>
        </div>
    </div>

    <div id="messageBox" class="message-box"></div> <!-- Message Box -->

    <div id="myModal" class="modal">
        <div class="modal-content">
            <div class="form-header">
                <span class="close">&times;</span>
                <h2>Business Permit Application Form</h2>
            </div>
            <form action="businessub.php" method="POST">
                <label for="businessName">Business Name:</label>
                <input type="text" id="businessName" name="bname" required placeholder="Enter Business Name">

                <label for="ownerName">Owner's Name:</label>
                <input type="text" id="ownerName" name="oname" required placeholder="Enter Owner's Name">

                <label for="address">Address:</label>
                <input type="text" id="address" name="address" required placeholder="Enter Address">

                <label for="email">Email:</label>
                <input type="email" id="email" name="email" required placeholder="Enter your email">

                <label for="businessType">Business Type:</label>
                <select id="businessType" name="btype" required>
                    <option value="">Select Business Type</option>
                    <option value="Retail">Retail</option>
                    <option value="Service">Service</option>
                    <option value="Manufacturing">Manufacturing</option>
                    <option value="Food">Food</option>
                    <option value="Other">Other</option>
                </select>

                <input type="submit" value="Submit">
            </form>
        </div>
    </div>

    <script>
        var modal = document.getElementById("myModal");
        var requestPermitLink = document.getElementById("requestPermitLink");
        var span = document.getElementsByClassName("close")[0];

        requestPermitLink.onclick = function(event) {
            event.preventDefault(); // Prevent default anchor behavior
            modal.style.display = "flex";
            modal.classList.add('show');
        };

        span.onclick = function() {
            modal.classList.remove('show');
            setTimeout(() => { modal.style.display = "none"; }, 300);
        };

        window.onclick = function(event) {
            if (event.target == modal) {
                modal.classList.remove('show');
                setTimeout(() => { modal.style.display = "none"; }, 300);
            }
        };

        $(document).ready(function () {
            $('form').submit(function (event) {
                event.preventDefault(); // Prevent default form submission
                const formData = $(this).serialize(); // Serialize form data

                $.ajax({
                    url: 'businessub.php',
                    type: 'POST',
                    data: formData,
                    dataType: 'json',
                    success: function (response) {
                        const messageBox = $('#messageBox');
                        messageBox.html(response.message);
                        messageBox.removeClass('success error');
                        messageBox.addClass(response.status);
                        if (response.status === 'success') {
                            $('form')[0].reset(); // Clear the form if successful
                        }
                    },
                    error: function () {
                        const messageBox = $('#messageBox');
                        messageBox.html('An error occurred. Please try again.');
                        messageBox.removeClass('success').addClass('error');
                    }
                });
            });
        });
    </script>
</body>
</html>