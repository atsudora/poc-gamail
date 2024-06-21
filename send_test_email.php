<?php
$to = "your-email@example.com";
$subject = "Test Email for Google Analytics";
$headers = "MIME-Version: 1.0" . "\r\n";
$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
$headers .= "From: your-email@example.com" . "\r\n";

$message = '
<!DOCTYPE html>
<html>
<head>
    <title>Test Email</title>
</head>
<body>
    <h1>Test Email for Google Analytics Tracking</h1>
    <p>Click the link below to track in Google Analytics.</p>
    <a href="http://localhost:8888/confirmation.html?utm_source=newsletter&utm_medium=email&utm_campaign=test_campaign">Test Link</a>
</body>
</html>
';

mail($to, $subject, $message, $headers);
echo "Test email sent!";
