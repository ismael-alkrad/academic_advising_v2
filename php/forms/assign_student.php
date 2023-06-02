<?php
include_once '../functions.php';
$tableData = $_POST['tableData'];
$new_value = $_POST['id'];

$result = updateTableData($tableData, $new_value, $conn);
echo $result;
