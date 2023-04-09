<?php
include_once 'connect.php';
session_start();
function login(
    $pdo,
    $username,
    $password
) {
    try {
        $stmt = $pdo->prepare("SELECT * FROM users WHERE username = :username AND password = :password AND role='supervisor' ");
        $stmt->execute(array(':username' => $username, ':password' => $password));
        $count = $stmt->rowCount();
        if ($count == 1) {
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            $_SESSION['username'] = $row['username'];
            $_SESSION['role'] = $row['role'];
            $_SESSIOn['email'] = $row['email'];



            return true;
        } else {
            return false;
        }
    } catch (PDOException $e) {
        error_log("Error checking admin login: " . $e->getMessage());
        return false;
    }
}

function studentLogin(
    $pdo,
    $username,
    $password
) {
    try {
        $stmt = $pdo->prepare("SELECT * FROM users WHERE username = :username AND password = :password AND role='student' ");
        $stmt->execute(array(':username' => $username, ':password' => $password));
        $count = $stmt->rowCount();
        if ($count == 1) {
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            $_SESSION['username'] = $row['username'];
            $_SESSION['role'] = $row['role'];
            $_SESSIOn['email'] = $row['email'];



            return true;
        } else {
            return false;
        }
    } catch (PDOException $e) {
        error_log("Error checking admin login: " . $e->getMessage());
        return false;
    }
}


function getStudent(
    $pdo,

) {
    try {
        $username = $_SESSION['username'];
        $stmt = $pdo->prepare("SELECT * FROM student_info WHERE advisor='$username' ");
        $stmt->execute();
        $count = $stmt->rowCount();
        if ($count > 0) {
            $row = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $row;
        } else {
            return false;
        }
    } catch (PDOException $e) {
        error_log("Error checking admin login: " . $e->getMessage());
        return false;
    }
}


function sendMail(
    $pdo,
    $to,
    $subject,
    $message,
    $from
) {
    // set sender address


    // set additional headers
    $headers = 'From: ' . $from . "\r\n" .
        'Reply-To: ' . $from . "\r\n";

    // send email
    if (mail($to, $subject, $message, $headers)) {
        echo true;
        try {

            $stmt = $pdo->prepare("INSERT INTO mails (to_address,from_address, subject, message) VALUES (?, ?, ?, ?)");
            $stmt->execute([$to, $from, $subject, $message]);
        } catch (PDOException $e) {
            echo 'An error occurred while saving the email to the database: ' . $e->getMessage();
        }
    } else {
        echo 'An error occurred while sending the email.';
    }
}

function getStudentById(PDO $conn, $u_id)
{
    $stmt = $conn->prepare("SELECT * FROM student_info WHERE u_id = :u_id");
    $stmt->bindValue(':u_id', $u_id);
    $stmt->execute();
    return  $stmt->fetch(PDO::FETCH_ASSOC);
}
function insertFormDataPDO($formDataArray, $pdo)
{
    try {
        // Prepare the SQL statement
        $stmt = $pdo->prepare("INSERT INTO student_information (college, department, year, semester, u_id, u_year, ar_name, en_name) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");

        // Bind the parameters
        $stmt->bindParam(1, $formDataArray['college']);
        $stmt->bindParam(2, $formDataArray['department']);
        $stmt->bindParam(3, $formDataArray['year']);
        $stmt->bindParam(4, $formDataArray['semyster']);
        $stmt->bindParam(5, $formDataArray['u_id']);
        $stmt->bindParam(6, $formDataArray['u_year']);
        $stmt->bindParam(7, $formDataArray['ar-name']);
        $stmt->bindParam(8, $formDataArray['en-name']);

        // Execute the statement
        $stmt->execute();

        // Output success message
        return true;
    } catch (PDOException $e) {
        // Output error message
        echo "Error: " . $e->getMessage();
    }

    // Close the statement
    $stmt = null;
}


function insertPersonalData($formData, $conn)
{
    $sql = "INSERT INTO personal_data (address,u_id, region, phone_house, city, phone_person, email, place_birth, birth_date, status, gender) 
          VALUES (:address,:u_id, :region, :phone_house, :city, :phone_person, :email, :place_birth, :birth, :status, :gender)";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':address', $formData['address']);
    $stmt->bindParam(':u_id', $formData['u_id']);
    $stmt->bindParam(':region', $formData['region']);
    $stmt->bindParam(':phone_house', $formData['phone_house']);
    $stmt->bindParam(':city', $formData['city']);
    $stmt->bindParam(':phone_person', $formData['phone_person']);
    $stmt->bindParam(':email', $formData['email']);
    $stmt->bindParam(':place_birth', $formData['place_birth']);
    $stmt->bindParam(':birth', $formData['birth']);
    $stmt->bindParam(':status', $formData['status']);
    $stmt->bindParam(':gender', $formData['gender']);

    if ($stmt->execute()) {
        return true;
    } else {
        return false;
    }
}
function insertPracticalExperience($conn, $formData)
{
    // Prepare the SQL query
    $sql = "INSERT INTO practical_experience (u_id,expereance, company_name, jop_name, certificate, activities)
          VALUES (:u_id, :expereance, :company_name, :jop_name, :certificate, :activities)";

    // Prepare the PDO statement
    $stmt = $conn->prepare($sql);

    // Bind the parameters to the statement
    $stmt->bindParam(':u_id', $formData['u_id']);

    // Loop through each practical experience input field and concatenate the values into a string
    $expereance = "";
    for ($i = 1; $i <= count($formData) / 2; $i++) {
        if (isset($formData['experience_job' . $i])) {
            $expereance .= $formData['experience_job' . $i] . ", ";
        }
    }
    $expereance = rtrim($expereance, ", ");
    $stmt->bindParam(':expereance', $expereance);

    $stmt->bindParam(':company_name', $formData['company_name']);
    $stmt->bindParam(':jop_name', $formData['job_name']);

    // Loop through each certificate input field and concatenate the values into a string
    $certificate = "";
    for ($i = 1; $i <= count($formData) / 2; $i++) {
        if (isset($formData['certificate' . $i])) {
            $certificate .= $formData['certificate' . $i] . ", ";
        }
    }
    $certificate = rtrim($certificate, ", ");
    $stmt->bindParam(':certificate', $certificate);

    // Loop through each activities input field and concatenate the values into a string
    $activities = "";
    for ($i = 1; $i <= count($formData) / 2; $i++) {
        if (isset($formData['activities' . $i])) {
            $activities .= $formData['activities' . $i] . ", ";
        }
    }
    $activities = rtrim($activities, ", ");
    $stmt->bindParam(':activities', $activities);

    // Execute the statement
    if ($stmt->execute()) {
        return true;
    } else {
        return false;
    }
}


function getMajors($conn)
{
    $sql = "SELECT name FROM majors";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $majors = $stmt->fetchAll(PDO::FETCH_COLUMN, 0);
    return $majors;
}
