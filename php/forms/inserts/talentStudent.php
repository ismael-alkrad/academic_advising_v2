<?php
include_once '../../functions.php';
$advisor = array_pop($_POST);
$talents = $_POST;

foreach ($talents as &$talent) {
    $talent = filter_var($talent, FILTER_SANITIZE_STRING);
}

// combine talents into a comma-separated string
$talent_string = implode(',', $talents);

// insert talent data into database
$sql = "INSERT INTO talents (talent, u_id, a_username) VALUES (?, ?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bindParam(1, $talent_string);
$stmt->bindParam(2, $_SESSION['username']);
$stmt->bindParam(3, $advisor);

if ($stmt->execute()) {
    echo "success";
} else {
    echo "Error: " . $stmt->errorInfo()[2];
}
