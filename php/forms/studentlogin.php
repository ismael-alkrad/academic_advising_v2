<?php
include_once '../functions.php';

if (isset($_POST['username']) && isset($_POST['password'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    if (studentLogin($conn, $username, $password)) {

        $_SESSION['username'] = $username;
        echo 'success';
    } else {
        echo 'Invalid username or password';
    }
}
