<?php
include_once 'connect.php';
session_start();
function login(
    $pdo,
    $username,
    $password
) {
    try {
        $stmt = $pdo->prepare("SELECT * FROM users WHERE username = :username AND password = :password AND role='supervisor' ");
        $stmt->execute(array(':username' => $username, ':password' => $password));
        $count = $stmt->rowCount();
        if ($count == 1) {
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            $_SESSION['username'] = $row['username'];
            $_SESSION['role'] = $row['role'];
            $_SESSIOn['email'] = $row['email'];



            return true;
        } else {
            return false;
        }
    } catch (PDOException $e) {
        error_log("Error checking admin login: " . $e->getMessage());
        return false;
    }
}



function getStudent(
    $pdo,

) {
    try {
        $username = $_SESSION['username'];
        $stmt = $pdo->prepare("SELECT * FROM student_info WHERE advisor='$username' ");
        $stmt->execute();
        $count = $stmt->rowCount();
        if ($count > 0) {
            $row = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $row;
        } else {
            return false;
        }
    } catch (PDOException $e) {
        error_log("Error checking admin login: " . $e->getMessage());
        return false;
    }
}


function sendMail(
    $pdo,
    $to,
    $subject,
    $message,
    $from
) {
    // set sender address


    // set additional headers
    $headers = 'From: ' . $from . "\r\n" .
        'Reply-To: ' . $from . "\r\n";

    // send email
    if (mail($to, $subject, $message, $headers)) {
        echo true;
        try {

            $stmt = $pdo->prepare("INSERT INTO mails (to_address,from_address, subject, message) VALUES (?, ?, ?, ?)");
            $stmt->execute([$to, $from, $subject, $message]);
        } catch (PDOException $e) {
            echo 'An error occurred while saving the email to the database: ' . $e->getMessage();
        }
    } else {
        echo 'An error occurred while sending the email.';
    }
}
