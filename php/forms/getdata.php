<?php

include_once '../functions.php';

$data = getStudentById(
    $conn,
    $_POST['id']
);
echo json_encode($data);
