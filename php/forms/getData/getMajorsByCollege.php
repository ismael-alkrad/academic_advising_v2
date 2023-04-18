<?php

include_once '../../functions.php';

$data = getMajorsByCollege(
    $conn,
    6
);
echo ($data);
