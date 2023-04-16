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


            $stmt = $pdo->prepare("SELECT * FROM `student_info` WHERE u_id= :username ");
            $stmt->execute(array(':username' => $username));
            $count = $stmt->rowCount();
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            $_SESSION['username'] = $row['u_id'];
            $_SESSION['name'] = $row['name'];
            $_SESSION['phone'] = $row['phone'];
            $_SESSION['email'] = $row['email'];
            $_SESSION['advisor_id'] = $row['advisor'];
            $_SESSION['major_id'] = $row['major'];
            $_SESSION['college_id'] = $row['college'];
            $_SESSION['img'] = $row['img'];
            $collegeName = getData($pdo, 'colleges', 'id=' . $_SESSION['college_id'])['name'];

            $majorName
                = getData($pdo, 'majors', 'id=' . $_SESSION['major_id'])['name'];
            $_SESSION['college'] = $collegeName;
            $_SESSION['major'] = $majorName;



            return true;
        } else {
            return false;
        }
    } catch (PDOException $e) {
        error_log("Error checking admin login: " . $e->getMessage());
        return false;
    }
}

function adminLogin(
    $pdo,
    $username,
    $password
) {
    try {
        $stmt = $pdo->prepare("SELECT * FROM users WHERE username = :username AND password = :password AND role='admin' ");
        $stmt->execute(array(':username' => $username, ':password' => $password));
        $count = $stmt->rowCount();
        if ($count == 1) {
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            $_SESSION['username'] = $row['username'];
            $_SESSION['role'] = $row['role'];
            $_SESSIOn['email'] = $row['email'];
            return true;
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

function getAdvisors(
    $pdo,

) {
    try {
        $username = $_SESSION['username'];
        $stmt = $pdo->prepare("SELECT * FROM users WHERE role='supervisor' ");
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
function getStudentByAdvisor(
    $pdo,
    $advisor

) {
    try {

        $stmt = $pdo->prepare("SELECT * FROM student_info WHERE advisor='$advisor' ");
        $stmt->execute();
        $count = $stmt->rowCount();
        if ($count > 0) {
            $row = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return json_encode($row);
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
function insertOrUpdateFormDataPDO($formDataArray, $pdo)
{
    $u_id = $formDataArray['u_id'];

    try {
        // Check if a row with the given u_id exists in the table
        $stmt = $pdo->prepare("SELECT COUNT(*) FROM student_information WHERE u_id = ?");
        $stmt->execute([$u_id]);
        $row_count = $stmt->fetchColumn();

        if ($row_count > 0) {
            // If a row exists, update the data
            $stmt = $pdo->prepare("UPDATE student_information SET college=?, department=?, year=?, semester=?, u_year=?, ar_name=?, en_name=?, its_done=true WHERE u_id=?");
        } else {
            // If no row exists, insert new data
            $stmt = $pdo->prepare("INSERT INTO student_information (college, department, year, semester, u_id, u_year, ar_name, en_name, its_done) VALUES (?, ?, ?, ?, ?, ?, ?, ?, true)");
        }

        // Bind the parameters
        $stmt->execute([$formDataArray['college'], $formDataArray['department'], $formDataArray['year'], $formDataArray['semyster'], $formDataArray['u_year'], $formDataArray['ar-name'], $formDataArray['en-name'], $u_id]);

        // Output success message
        return true;
    } catch (PDOException $e) {
        // Output error message
        echo "Error: " . $e->getMessage();
    }

    // Close the statement
    $stmt = null;
}
function insertOrUpdatePersonalData($formData, $conn)
{
    $u_id = $formData['u_id'];

    try {
        $stmt = $conn->prepare("SELECT COUNT(*) FROM personal_data WHERE u_id = ?");
        $stmt->execute([$u_id]);
        $row_count = $stmt->fetchColumn();

        $sql = ($row_count > 0) ? "UPDATE personal_data SET  region=:region, phone_house=:phone_house, city=:city, phone_person=:phone_person, email=:email, place_birth=:place_birth, birth_date=:birth, status=:status, gender=:gender, its_done=true WHERE u_id=:u_id" : "INSERT INTO personal_data (u_id, region, phone_house, city, phone_person, email, place_birth, birth_date, status, gender, its_done) VALUES (:u_id, :region, :phone_house, :city, :phone_person, :email, :place_birth, :birth, :status, :gender,true)";

        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':u_id', $u_id);
        $stmt->bindParam(':region', $formData['region']);
        $stmt->bindParam(':phone_house', $formData['phone_house']);
        $stmt->bindParam(':city', $formData['city']);
        $stmt->bindParam(':phone_person', $formData['phone_person']);
        $stmt->bindParam(':email', $formData['email']);
        $stmt->bindParam(':place_birth', $formData['place_birth']);
        $stmt->bindParam(':birth', $formData['birth']);
        $stmt->bindParam(':status', $formData['status']);
        $stmt->bindParam(':gender', $formData['gender']);

        return $stmt->execute();
    } catch (PDOException $e) {
        // Output error message
        echo "Error: " . $e->getMessage();
        return false;
    }
}
function insertOrUpdatePracticalExperience($conn, $formData)
{
    $u_id = $formData['u_id'];

    try {
        // Check if a row with the given u_id exists in the table
        $stmt = $conn->prepare("SELECT COUNT(*) FROM practical_experience WHERE u_id = ?");
        $stmt->execute([$u_id]);
        $row_count = $stmt->fetchColumn();

        if ($row_count > 0) {
            // If a row exists, update the data
            $sql = "UPDATE practical_experience SET company_name=:company_name, jop_name=:jop_name, certificate=:certificate, activities=:activities, experience_job=:experience_job, its_done=true WHERE u_id=:u_id";
        } else {
            // If no row exists, insert new data
            $sql = "INSERT INTO practical_experience (u_id, company_name, jop_name, certificate, activities, experience_job, its_done) VALUES (:u_id, :company_name, :jop_name, :certificate, :activities, :experience_job, true)";
        }

        // Prepare the PDO statement
        $stmt = $conn->prepare($sql);

        // Bind the parameters to the statement
        $stmt->bindParam(':u_id', $u_id);

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

        // Loop through each experience_job input field and concatenate the values into a string
        $experience_job = "";
        for ($i = 1; $i <= count($formData) / 2; $i++) {
            if (isset($formData['experience_job' . $i])) {
                $experience_job .= $formData['experience_job' . $i] . ", ";
            }
        }
        $experience_job = rtrim($experience_job, ", ");
        $stmt->bindParam(':experience_job', $experience_job);

        // Execute the statement
        return $stmt->execute();
    } catch (PDOException $e) {
        // Output error message
        echo "Error: " . $e->getMessage();
        return false;
    }
}



function getColleges($conn)
{
    $sql = "SELECT * FROM colleges";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $row = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return $row;
}
function getMajorsByCollege($con, $collegeId)
{
    // prepare SQL statement
    $stmt = $con->prepare("SELECT * FROM majors WHERE college_id = :college_id");
    $stmt->bindParam(":college_id", $collegeId);
    // execute statement
    $stmt->execute();
    // fetch all rows as associative array
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    // return result
    return $result;
}


function getData($conn, $table, $where)
{
    $sql = "SELECT * FROM $table WHERE $where";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    return $row;
}
function getStudenData($conn, $u_id)
{
    // Prepare the SQL queries for each table
    $sql2 = "SELECT `id`, `college`, `department`, `year`, `semester`, `u_id`, `u_year`, `ar_name`, `en_name`, `its_done` FROM `student_information` WHERE `u_id` = ?";
    $sql3 = "SELECT `id`, `u_id`, `city`, `region`, `phone_house`, `phone_person`, `email`, `place_birth`, `birth_date`, `status`, `gender`, `its_done` FROM `personal_data` WHERE `u_id` = ?";
    $sql4 = "SELECT `id`, `u_id`, `company_name`, `jop_name`, `experience_job`, `certificate`, `activities`, `its_done` FROM `practical_experience` WHERE `u_id` = ?";
    $sql5 = "SELECT `filepath` FROM `photos` WHERE `u_id` = ?";

    $stmt2 = $conn->prepare($sql2);
    $stmt2->execute([$u_id]);
    $data2 = $stmt2->fetch(PDO::FETCH_ASSOC);

    $stmt3 = $conn->prepare($sql3);
    $stmt3->execute([$u_id]);
    $data3 = $stmt3->fetch(PDO::FETCH_ASSOC);

    $stmt4 = $conn->prepare($sql4);
    $stmt4->execute([$u_id]);
    $data4 = $stmt4->fetch(PDO::FETCH_ASSOC);

    $stmt5 = $conn->prepare($sql5);
    $stmt5->execute([$u_id]);
    $data5 = $stmt5->fetch(PDO::FETCH_ASSOC);

    // Check if any data is found
    if (!$data2 && !$data3 && !$data4 && !$data5) {
        return false;
    }

    // Combine the results from all queries into a single array
    $result = array_merge($data2, $data3, $data4, $data5);

    // Return the data as a JSON-encoded string
    return json_encode($result);
}


function checkifFillInfo($conn)
{
    $sql = "SELECT si.its_done AS si_its_done, pd.its_done AS pd_its_done, pe.its_done AS pe_its_done 
            FROM student_information si 
            JOIN personal_data pd ON si.u_id = pd.u_id 
            JOIN practical_experience pe ON pd.u_id = pe.u_id 
            WHERE si.u_id = :u_id";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':u_id',  $_SESSION['username']);
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);

    if (is_array($result) && $result['si_its_done'] && $result['pd_its_done'] && $result['pe_its_done']) {
        return true;
    } else {
        return false;
    }
}




function getPhotoPathByUser($conn)
{
    // Make sure the $username value is safe to use in a SQL query
    $username = $_SESSION['username'];

    // Prepare and execute the SQL query
    $stmt = $conn->prepare('SELECT filepath FROM photos WHERE u_id = :username');
    $stmt->execute(array(':username' => $username));

    // Get the result from the SQL query
    $result = $stmt->fetch(PDO::FETCH_ASSOC);

    // Return the filepath value, or null if no result was found
    return $result ? $result['filepath'] : $_SESSION['img'];
}



function getStudentData($conn, $u_id)
{
    try {
        // Prepare the SQL query for student_information table
        $stmt = $conn->prepare("SELECT * FROM student_information WHERE u_id = ?");
        $stmt->execute([$u_id]);
        $student_data = $stmt->fetch(PDO::FETCH_ASSOC);

        // Prepare the SQL query for personal_data table
        $stmt = $conn->prepare("SELECT * FROM personal_data WHERE u_id = ?");
        $stmt->execute([$u_id]);
        $personal_data = $stmt->fetch(PDO::FETCH_ASSOC);

        // Prepare the SQL query for practical_experience table
        $stmt = $conn->prepare("SELECT * FROM practical_experience WHERE u_id = ?");
        $stmt->execute([$u_id]);
        $practical_experience = $stmt->fetch(PDO::FETCH_ASSOC);

        // Check if any of the queries returned false
        if ($student_data === false || $personal_data === false || $practical_experience === false) {
            return array(); // Return an empty array
        }

        // Combine the data into a single array and return it
        $data = array_merge($student_data, $personal_data, $practical_experience);
        return $data;
    } catch (PDOException $e) {
        // Output error message
        echo "Error: " . $e->getMessage();
        return array(); // Return an empty array
    }
}

function getCoursesByCollegeId($conn, $collegeId)
{
    try {
        // Prepare the SQL statement
        $stmt = $conn->prepare("SELECT id, name, number, college_id, majors_id FROM courses WHERE college_id = :college_id");

        // Bind the parameters
        $stmt->bindParam(':college_id', $collegeId);

        // Execute the statement
        $stmt->execute();

        // Fetch all the rows as an associative array
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

        // Return the result
        return $result;
    } catch (PDOException $e) {
        // Output error message
        echo "Error: " . $e->getMessage();
        return false;
    }
}
function getStudentInfoByUId($conn, $uId)
{
    try {
        // Prepare the SQL statement
        $stmt = $conn->prepare("SELECT * FROM student_information WHERE u_id = :u_id");

        // Bind the parameters
        $stmt->bindParam(':u_id', $uId);

        // Execute the statement
        $stmt->execute();

        // Fetch the row as an associative array
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        // Return the result
        return $result;
    } catch (PDOException $e) {
        // Output error message
        echo "Error: " . $e->getMessage();
        return false;
    }
}
