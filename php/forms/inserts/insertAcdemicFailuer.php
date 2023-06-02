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

$result = insertAcademicFailure($difficulty, $attendance, $teaching_methods, $exam_anxiety, $family_problems, $university_environment, $high_course_load, $disinterest_in_major, $working_while_studying, $financial_issues, $long_commute, $choosing_bad_friends, $lack_of_time_for_studying, $other_reasons, $proposed_solutions, $u_id, $a_username);
echo $result;
