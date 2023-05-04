<?php

include_once '../../functions.php';

if (!empty($_POST['department'])) {
    $data = getAllCourses($conn, $_POST['college'], $_POST['department']);
} else {
    $data = getAllCourses($conn, $_POST['college']);
}

// header('Content-Type: application/json'); // set the response header to indicate JSON data
// echo json_encode($data); // encode the data as JSON and output it
echo $data;
