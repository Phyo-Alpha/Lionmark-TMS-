<?php
require __DIR__ . '/../vendor/autoload.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

//TODO: delete this file after testing

echo "<h2>Testing Hostinger Email Configuration</h2>";

$mail = new PHPMailer(true);

try {
    // Server settings
    $mail->isSMTP();
    $mail->Host       = 'smtp.hostinger.com';
    $mail->SMTPAuth   = true;
    $mail->Username   = 'admin@lionmark.com.sg';
    $mail->Password   = 'Lionmarka20222!';
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
    $mail->Port       = 465;

    // Timeout settings
    $mail->Timeout = 30;
    $mail->SMTPKeepAlive = false;
    $mail->SMTPDebug = 2; // Enable debug output

    // Recipients
    $mail->setFrom('admin@lionmark.com.sg', 'Lionmarks Training');
    $mail->addAddress('edwardphyo115@gmail.com', 'Test User'); // Change this to your test email

    // Content
    $mail->isHTML(true);
    $mail->Subject = 'Test Email from Lionmarks';
    $mail->Body    = '<h1>Test Email</h1><p>This is a test email to verify SMTP configuration.</p>';

    echo "<p>Attempting to send test email...</p>";
    echo "<pre>";
    $mail->send();
    echo "</pre>";
    echo "<p style='color: green;'>✅ Email sent successfully!</p>";
} catch (Exception $e) {
    echo "<p style='color: red;'>❌ Email failed to send!</p>";
    echo "<p><strong>Error:</strong> " . $e->getMessage() . "</p>";
    echo "<p><strong>SMTP Error Info:</strong> " . $mail->ErrorInfo . "</p>";
}
