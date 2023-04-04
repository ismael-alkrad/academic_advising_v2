<?php

$host = "localhost";
$dbname = "acadimic_advising";
$username = "root";
$password = "";
$options = [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES => false,
];
$conn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password, $options);
