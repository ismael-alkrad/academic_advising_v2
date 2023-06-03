<?php

require_once '../functions.php';



$a_username = $_SESSION['username'];
$problem_type = $_POST['type'];
$topic = $_POST['subject'];
$guidance_procedure = $_POST['action'];
$recommendations = $_POST['referral'];
$notes = $_POST['notes'];
$u_id = $_POST['student'];


if (createIndividualMeetings($conn, $u_id, $problem_type, $topic, $guidance_procedure, $recommendations, $notes, $a_username)) {
    echo "success";
} else {
    echo "error";
}
// print_r(
//     $_POST
// );
