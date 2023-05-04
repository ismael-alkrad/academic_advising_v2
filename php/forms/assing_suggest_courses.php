<?php



include_once '../../php/functions.php';
$data
    = $_POST['tableData'];
// Loop through the array of data and insert each row into the suggestCourses table
try {
    foreach ($data as $row) {
        if (
            addSuggestedCourse($conn, $row[1], $row[0], $row[2], $row[3], $row[4], $_POST['id'])
        ) {
        } else {

            echo "Error adding suggested courses: " . $e->getMessage();
            break;
        }
    }
    echo 'success';
} catch (PDOException $e) {
    // Handle the exception here, e.g. by logging it or displaying an error message to the user
    echo "Error adding suggested courses: " . $e->getMessage();
}
