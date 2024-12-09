<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $to = "2121489@ub.edu.ph"; // client's email address
    $subject = "Parcel Delivery Notification";
    $message = '
    <html>
    <head>
        <title>Parcel Delivery Notification</title>
        <style>
            body {
                font-family: Arial, sans-serif;
                background-color: #f4f4f4;
                margin: 0;
                padding: 20px;
            }
            .container {
                background-color: #ffffff;
                border-radius: 5px;
                padding: 20px;
                box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            }
            h1 {
                color: #333;
            }
            p {
                font-size: 16px;
                color: #555;
            }
            .footer {
                margin-top: 20px;
                font-size: 12px;
                color: #999;
            }
        </style>
    </head>
    <body>
        <div class="container">
            <h1>Parcel Delivery Notification</h1>
            <p>Dear Client,</p>
            <p>Your parcel has been dispatched and is on its way to you!</p>
            <p>Tracking Number: <strong>123321</strong></p>
            <p>Expected Delivery Date: <strong>December 02, 2024</strong></p>
            <p>Thank you for choosing our delivery services.</p>
            <p>Best regards,<br>Your Delivery Team</p>
            <div class="footer">This is an automated message, please do not reply.</div>
        </div>
    </body>
    </html>
    ';

    // Set content-type header for sending HTML email
    $headers  = "MIME-Version: 1.0" . "\r\n";
    $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

    // Additional headers
    $headers .= 'From: Your Delivery Service <noreply@yourservice.com>' . "\r\n"; // Replace with your email

    // Send email
    if (mail ($to, $subject, $message, $headers)) {
        echo "Email sent successfully.";
    } else {
        echo "Email sending failed.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Send Parcel Notification</title>
</head>
<body>
    <form action="send_notification.php" method="post">
        <button type="submit">Send Parcel Notification</button>
    </form>
</body>
</html>