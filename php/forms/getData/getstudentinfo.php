<?php

include_once '../../functions.php';

$data = getStudenData(
    $conn,
    $_POST['id']
);
echo $data;
