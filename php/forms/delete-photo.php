<?php
include_once '../connect.php';
session_start();
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get the database connection from the parameter

    // Get the filename from the database
    $stmt = $conn->prepare("SELECT filepath FROM photos WHERE u_id = ?");
    $stmt->bindParam(1, $_SESSION['username']);
    $stmt->execute();
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    $filename = $row['filepath'];

    // Delete the file from the folder
    if (file_exists($filename)) {
        unlink($filename);
    }

    // Delete the record from the database
    $stmt = $conn->prepare("DELETE FROM photos WHERE u_id = ?");
    $stmt->bindParam(1, $_SESSION['username']);
    $stmt->execute();

    // Return success response
    echo json_encode(array('status' => 'success'));
    exit;
}
