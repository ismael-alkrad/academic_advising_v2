<?php

include_once '../../functions.php';

$data = getStudentByAdvisor(
    $conn,
    $_POST['id']
);
echo ($data);
