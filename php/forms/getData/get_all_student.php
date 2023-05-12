<?php

include_once '../../functions.php';
if (!empty($_POST['department'])) {
    $data = getAllStudentWithoutAdvisor($conn, $_POST['college'], $_POST['department']);
} else {
    $data = getAllStudentWithoutAdvisor($conn, $_POST['college']);
}


echo json_encode($data);
