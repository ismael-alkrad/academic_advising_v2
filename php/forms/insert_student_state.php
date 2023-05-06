<?php
// Include the insertFormData function
include_once '../functions.php';

// Get the form data
$student = $_POST['student'];
$type = $_POST['type'];
$subject = $_POST['subject'];
$actions = $_POST['actions'];
$notes = $_POST['notes'];



if (insertStudentState($conn, $type, $subject, $actions, $notes, $student, 'admin')) {
    echo "success";
} else {
    echo "There was an error inserting the data.";
}
