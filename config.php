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
        'pixel_tracking_url' => 'https://poc-gamail.onrender.com/pixel_tracker.php',
        'google_analytics_url' => 'https://poc-gamail.onrender.com/',
        'utm_parameters' => 'utm_source=newsletter&utm_medium=email&utm_campaign=test_campaign'
    ],
    'measurement_protocol' => [
        'api_secret' => getenv('API_SECRET'),
        'ga_tracking_id' => 'G-83RQZRK36V',
        'client_id' => '1111',
    ],
];
