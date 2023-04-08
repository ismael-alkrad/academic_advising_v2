<?php
$to = $_POST['recipient'];
$subject = $_POST['subject'];
$message = $_POST['massage'];
$headers = "From: sender@example.com\r\n";
$headers .= "Reply-To: sender@example.com\r\n";
$headers .= "Content-Type: text/html\r\n";

if (mail($to, $subject, $message, $headers)) {
    echo "success";
} else {
    echo "error";
}
