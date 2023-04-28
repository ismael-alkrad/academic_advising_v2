<?php
include_once '../functions.php';





$sql = "UPDATE student_info SET its_done = 1 WHERE u_id = :u_id";

// prepare PDO statement
$stmt = $conn->prepare($sql);

// bind parameter
$stmt->bindParam(':u_id',  $_SESSION['username']);
// execute statement
$stmt->execute();

// return success response
echo json_encode(array('status' => 'success'));
exit;
