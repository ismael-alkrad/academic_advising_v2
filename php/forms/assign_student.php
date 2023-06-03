<?php
include_once '../functions.php';
$tableData = $_POST['tableData'];
$new_value = $_POST['id'];

$result = addStudentToAdvisor($tableData, $new_value, $conn);
echo $result;
