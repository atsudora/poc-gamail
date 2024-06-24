<?php
use PHPMailer\PHPMailer\PHPMailer;
return [
    'smtp' => [
        'host' => 'smtp.gmail.com',
        'username' => getenv('SMTP_USERNAME'),
        'password' => getenv('SMTP_PASSWORD'),
        'port' => 587,
        'encryption' => PHPMailer::ENCRYPTION_STARTTLS,
    ],
    'email' => [
        'from' => getenv('EMAIL_FROM'),
        'from_name' => 'Mailer',
        'subject' => 'Test Email for Google Analytics',
        'tracking_pixel_url' => 'http://localhost/track_open.php',
        'google_analytics_url' => 'http://localhost/poc-gamail/complete.html',
        'utm_parameters' => 'utm_source=newsletter&utm_medium=email&utm_campaign=test_campaign'
    ],
    'ga_tracking_id' => 'G-83RQZRK36V',
];