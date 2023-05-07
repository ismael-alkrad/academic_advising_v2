<?php

require_once '../../functions.php';
$difficulty = $_POST['type-1'];
$attendance = $_POST['type-2'];
$teaching_methods = $_POST['type-3'];
$exam_anxiety = $_POST['type-4'];
$family_problems = $_POST['type-5'];
$university_environment = $_POST['type-6'];
$high_course_load = $_POST['type-7'];
$disinterest_in_major = $_POST['type-8'];
$working_while_studying = $_POST['type-9'];
$financial_issues = $_POST['type-10'];
$long_commute = $_POST['type-11'];
$choosing_bad_friends = $_POST['type-12'];
$lack_of_time_for_studying = $_POST['type-13'];
$other_reasons = $_POST['other_reasonsdd'];
$proposed_solutions = $_POST['proposed_solutions'];


$u_id = $_POST['student'];
$a_username = $_POST['advisor'];

$sql = "INSERT INTO academic_failures 
        (difficulty, attendance, teaching_methods, exam_anxiety, family_problems, university_environment, high_course_load, disinterest_in_major, working_while_studying, financial_issues, long_commute, choosing_bad_friends, lack_of_time_for_studying, other_reasons, proposed_solutions, u_id, a_username) 
        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

$stmt = $conn->prepare($sql);
$stmt->bindParam(1, $difficulty);
$stmt->bindParam(2, $attendance);
$stmt->bindParam(3, $teaching_methods);
$stmt->bindParam(4, $exam_anxiety);
$stmt->bindParam(5, $family_problems);
$stmt->bindParam(6, $university_environment);
$stmt->bindParam(7, $high_course_load);
$stmt->bindParam(8, $disinterest_in_major);
$stmt->bindParam(9, $working_while_studying);
$stmt->bindParam(10, $financial_issues);
$stmt->bindParam(11, $long_commute);
$stmt->bindParam(12, $choosing_bad_friends);
$stmt->bindParam(13, $lack_of_time_for_studying);
$stmt->bindParam(14, $other_reasons);
$stmt->bindParam(15, $proposed_solutions);
$stmt->bindParam(16, $u_id);
$stmt->bindParam(17, $a_username);

if ($stmt->execute()) {
    echo "success";
} else {
    echo "Error: " . $stmt->errorInfo()[2];
}
