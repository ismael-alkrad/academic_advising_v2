

<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Load the PHPMailer library
require '../../vendor/autoload.php';
require  '../../vendor/phpmailer/phpmailer/src/PHPMailer.php';
require  '../../vendor/phpmailer/phpmailer/src/Exception.php';

// Get the recipient, subject, and message from the POST data
$to = $_POST['recipient'];
$subject = $_POST['subject'];
$message = $_POST['massage'];

// Check if the required fields are not empty
if (empty($to) || empty($subject) || empty($message)) {
    echo "error";
    exit;
}

// Create a new PHPMailer instance
$mail = new PHPMailer(
    true
);

try {
    //Server settings
    $mail->isSMTP();
    $mail->Host       = 'smtp.example.com'; // SMTP server
    $mail->SMTPAuth   = true;
    $mail->Username   = 'user@example.com'; // SMTP username
    $mail->Password   = 'secret';           // SMTP password
    $mail->SMTPSecure = 'tls';
    $mail->Port       = 587;                // TCP port to connect to

    //Recipients
    $mail->setFrom('sender@example.com', 'Sender Name');
    $mail->addAddress($to);     // Add recipient
    $mail->addReplyTo('sender@example.com', 'Sender Name');

    // Attach the static photo
    $photo_path = isset($_POST['photo_path']) ? $_POST['photo_path'] : null;
    if (!empty($photo_path)) {
        $mail->addEmbeddedImage($photo_path, 'photo');
    }

    // Content
    $mail->isHTML(true);
    $mail->Subject = $subject;
    $mail->Body    = $message;
    if (!empty($photo_path)) {
        $mail->Body .= '<br><img src="cid:photo">';
    }

    // Send the email
    $mail->send();
    echo "success";
} catch (Exception $e) {
    echo "error";
}
