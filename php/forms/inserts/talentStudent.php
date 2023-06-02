<?php
include_once '../../functions.php';
$advisor = array_pop($_POST);
$talents = $_POST;

insertTalents($talents, $conn,$advisor);
