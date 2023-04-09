<?php
// print_r($_POST);
include_once 'functions.php';

if (isset($_POST)) {

    $collegeId = $_POST['college_id'];
    $stmt = $conn->prepare("SELECT id, name FROM majors  WHERE college_id = :college_id");
    $stmt->bindParam(":college_id", $collegeId);
    // execute statement
    $stmt->execute();
    // fetch all rows as associative array
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    // encode result as JSON and return
    echo json_encode($result);
}
