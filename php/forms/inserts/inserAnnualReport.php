<?php

include_once '../../functions.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $academic_advising_students = $_POST['academic_advising_students'];
    $external_students = $_POST['external_students'];
    $advised_students = $_POST['advised_students'];
    $total_students = $_POST['total_students'];

    $individual_meetings = $_POST['individual_meetings'];
    $struggling_students = $_POST['struggling_students'];
    $struggling_advised_students = $_POST['struggling_advised_students'];
    $transferred_groups = $_POST['transferred_groups'];

    $sql = "INSERT INTO advising_statistics (academic_advising_students, external_students, advised_students, total_students,individual_meetings, struggling_students, struggling_advised_students, transferred_groups,a_username) VALUES (?, ?, ?, ?, ?, ?, ?, ?,?)";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(1, $academic_advising_students);
    $stmt->bindParam(2, $external_students);
    $stmt->bindParam(3, $advised_students);
    $stmt->bindParam(4, $total_students);
    $stmt->bindParam(5, $individual_meetings);
    $stmt->bindParam(6, $struggling_students);
    $stmt->bindParam(7, $struggling_advised_students);
    $stmt->bindParam(8, $transferred_groups);
    $stmt->bindParam(9, $_SESSION['username']);


    if ($stmt->execute()) {
        echo "success";
    } else {
        echo "خطأ: " . $stmt->errorInfo()[2];
    }
}
