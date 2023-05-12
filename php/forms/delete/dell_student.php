<?php
include_once '../../../php/connect.php';
$tableData = $_POST['tableData'];
// print_r($tableData);
if (isset($_POST['tableData'])) {
    try {
        foreach ($tableData as $rowData) {
            $u_id = $rowData[0];
            $new_value = $rowData[1];

            $stmt = $conn->prepare("UPDATE student_info SET advisor = 'none' WHERE u_id = :u_id");

            $stmt->bindParam(':u_id', $u_id);
            $stmt->execute();
        }
        echo 'success';
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
} else {
    echo "Error: table data is not set";
}
