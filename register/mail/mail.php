<?php

require_once __DIR__ . '/../../class/phpformbuilder/mailer/phpmailer/src/Exception.php';
require_once __DIR__ . '/../../class/phpformbuilder/mailer/phpmailer/src/PHPMailer.php';
require_once __DIR__ . '/../../class/phpformbuilder/mailer/phpmailer/src/SMTP.php';
require_once __DIR__ . '/../../conf/conf.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Function to send confirmation email
function sendConfirmationEmail($data)
{
    $mail = new PHPMailer(true);
    error_log("Sending confirmation email to " . $data['email'] . " with subject " . 'Workshop Registration Confirmation - Lionmarks Training');

    // Set up debug logging to file
    $debugLogFile = __DIR__ . '/logs/phpmailer_debug.log';

    // Create logs directory if it doesn't exist
    if (!file_exists(__DIR__ . '/logs')) {
        mkdir(__DIR__ . '/logs', 0755, true);
    }

    try {
        // Server settings
        $mail->isSMTP();
        $mail->Host       = SMTP_HOST;
        $mail->SMTPAuth   = true;
        $mail->Username   = SMTP_USERNAME;
        $mail->Password   = SMTP_PASSWORD;
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
        $mail->Port       = SMTP_PORT;

        // Enable debug output but save to file instead of displaying
        $mail->SMTPDebug = 2; // Enable verbose debug output
        $mail->Debugoutput = function ($str, $level) use ($debugLogFile) {
            file_put_contents($debugLogFile, date('Y-m-d H:i:s') . " [Level $level]: $str\n", FILE_APPEND);
        };

        // Timeout settings to prevent hanging
        $mail->Timeout = 30;
        $mail->SMTPKeepAlive = false;

        // Character encoding
        $mail->CharSet = 'UTF-8';
        $mail->Encoding = 'base64';

        // Recipients
        $mail->setFrom(address: 'admin@lionmark.com.sg', name: 'Lionmarks Training');
        $mail->addAddress(address: $data['email'], name: $data['firstName'] . ' ' . $data['lastName']);
        $mail->addReplyTo(address: 'admin@lionmark.com.sg', name: 'Lionmarks Training');

        // Content
        $mail->isHTML(isHtml: true);
        $mail->Subject = 'Workshop Registration Confirmation - Lionmarks Training';

        $html = file_get_contents(__DIR__ . '/templates/register-confirmation.html');
        $html = str_replace('{{firstName}}', $data['firstName'], $html);
        $html = str_replace('{{lastName}}', $data['lastName'], $html);
        $html = str_replace('{{email}}', $data['email'], $html);
        $html = str_replace('{{countryCode}}', $data['countryCode'], $html);
        $html = str_replace('{{phone}}', $data['phone'], $html);
        $html = str_replace('{{workshop}}', $data['workshop'], $html);
        $html = str_replace('{{registrationDate}}', $data['registrationDate'], $html);
        $html = str_replace('{{status}}', $data['status'], $html);
        $html = str_replace('{{notes}}', $data['notes'], $html);

        $mail->Body = $html;
        // Plain text alternative for email clients that don't support HTML
        $mail->AltBody = "Registration Confirmed!\n\n"
            . "Thank you for registering with Lionmarks Training\n\n"
            . "Registration Details:\n"
            . "Name: " . $data['firstName'] . ' ' . $data['lastName'] . "\n"
            . "Email: " . $data['email'] . "\n"
            . "Phone: " . $data['countryCode'] . ' ' . $data['phone'] . "\n"
            . "Workshop: " . ($data['workshop'] ?? 'Not selected') . "\n\n"
            . "Important Note:\n"
            . "We will contact you regarding a $30 refundable deposit.\n"
            . "This deposit will be returned upon course completion.\n\n"
            . "(c) 2025 Lionmarks Training. All rights reserved.";

        $mail->send();
        error_log("Email sent successfully to " . $data['email']);

        // Log success to debug file as well
        file_put_contents($debugLogFile, date('Y-m-d H:i:s') . " [SUCCESS]: Email sent to " . $data['email'] . "\n", FILE_APPEND);

        return true;
    } catch (Exception $e) {
        $errorMsg = "Email Error: " . $e->getMessage() . " | SMTP Error: " . $mail->ErrorInfo;
        error_log($errorMsg);

        // Log error to debug file as well
        file_put_contents($debugLogFile, date('Y-m-d H:i:s') . " [ERROR]: " . $errorMsg . "\n", FILE_APPEND);

        return false;
    }
}
