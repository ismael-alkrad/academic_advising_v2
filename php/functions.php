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
            $stmt = $pdo->prepare("UPDATE student_information SET college=?, department=?, year=?, semester=?, u_year=?, ar_name=?, en_name=? WHERE u_id=?");

            // Bind the parameters for update statement
            $stmt->bindParam(1, $formDataArray['college']);
            $stmt->bindParam(
                2,
                $formDataArray['department']
            );
            $stmt->bindParam(3, $formDataArray['year']);
            $stmt->bindParam(4, $formDataArray['semyster']);
            $stmt->bindParam(5, $formDataArray['u_year']);
            $stmt->bindParam(
                6,
                $formDataArray['ar-name']
            );
            $stmt->bindParam(
                7,
                $formDataArray['en-name']
            );
            $stmt->bindParam(
                8,
                $u_id
            );
        } else {
            // If no row exists, insert new data
            $stmt = $pdo->prepare("INSERT INTO student_information (college, department, year, semester, u_id, u_year, ar_name, en_name) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");

            // Bind the parameters for insert statement
            $stmt->bindParam(1, $formDataArray['college']);
            $stmt->bindParam(
                2,
                $formDataArray['department']
            );
            $stmt->bindParam(3, $formDataArray['year']);
            $stmt->bindParam(4, $formDataArray['semyster']);
            $stmt->bindParam(5, $u_id);
            $stmt->bindParam(6, $formDataArray['u_year']);
            $stmt->bindParam(
                7,
                $formDataArray['ar-name']
            );
            $stmt->bindParam(
                8,
                $formDataArray['en-name']
            );
        }

        // Execute the statement
        $stmt->execute();
        // Output success message
        return true;
    } catch (PDOException $e) {
        // Output error message
        echo "Error: " . $e->getMessage();
    }

    // Close the statement
}
function insertOrUpdatePersonalData($formData, $conn)
{
    $u_id = $formData['u_id'];

    try {
        $stmt = $conn->prepare("SELECT COUNT(*) FROM personal_data WHERE u_id = ?");
        $stmt->execute([$u_id]);
        $row_count = $stmt->fetchColumn();

        $sql = ($row_count > 0) ? "UPDATE personal_data SET  region=:region, phone_house=:phone_house, city=:city, phone_person=:phone_person, email=:email, place_birth=:place_birth, birth_date=:birth, status=:status, gender=:gender WHERE u_id=:u_id" : "INSERT INTO personal_data (u_id, region, phone_house, city, phone_person, email, place_birth, birth_date, status, gender) VALUES (:u_id, :region, :phone_house, :city, :phone_person, :email, :place_birth, :birth, :status, :gender,true)";

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
            $sql = "UPDATE practical_experience SET company_name=:company_name, jop_name=:jop_name, certificate=:certificate, activities=:activities, experience_job=:experience_job WHERE u_id=:u_id";
        } else {
            // If no row exists, insert new data
            $sql = "INSERT INTO practical_experience (u_id, company_name, jop_name, certificate, activities, experience_job) VALUES (:u_id, :company_name, :jop_name, :certificate, :activities, :experience_job)";
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
    $sql2 = "SELECT `id`, `college`, `department`, `year`, `semester`, `u_id`, `u_year`, `ar_name`, `en_name` FROM `student_information` WHERE `u_id` = ?";
    $sql3 = "SELECT `id`, `u_id`, `city`, `region`, `phone_house`, `phone_person`, `email`, `place_birth`, `birth_date`, `status`, `gender`  FROM `personal_data` WHERE `u_id` = ?";
    $sql4 = "SELECT `id`, `u_id`, `company_name`, `jop_name`, `experience_job`, `certificate`, `activities` FROM `practical_experience` WHERE `u_id` = ?";
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
    $result = [];
    if ($data2) {
        $result = array_merge($result, $data2);
    }
    if ($data3) {
        $result = array_merge($result, $data3);
    }
    if ($data4) {
        $result = array_merge($result, $data4);
    }
    if ($data5) {
        $result = array_merge($result, $data5);
    }
    if (empty($result)) {
        return false;
    }

    // Return the data as a JSON-encoded string
    return json_encode($result);
}

function checkifFillInfo($conn)
{
    // prepare SQL statement
    $sql = "SELECT its_done FROM student_info WHERE u_id = :u_id";

    // prepare PDO statement
    $stmt = $conn->prepare($sql);

    // bind parameter
    $stmt->bindParam(':u_id',  $_SESSION['username']);
    // execute statement
    $stmt->execute();

    // fetch result
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    $itsDone = $row['its_done'];

    // return true if task is done, false otherwise
    return ($itsDone == 1);
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
function getAllStudent($conn, $college, $major = '')
{
    $sql = "SELECT * FROM student_info WHERE college = :college";
    if (!empty($major)) {
        $sql .= " AND major = :major";
    }
    $stmt = $conn->prepare($sql);

    $stmt->bindValue(':college', $college);
    if (!empty($major)) {
        $stmt->bindValue(':major', $major);
    }
    $stmt->execute();
    return json_encode($stmt->fetchAll(PDO::FETCH_ASSOC));
}




function getFnameByUid($pdo, $u_id)
{
    $stmt = $pdo->prepare("SELECT fname FROM users WHERE username = :u_id");
    $stmt->execute(array(':u_id' => $u_id));
    $result = $stmt->fetch();
    return $result['fname'];
}




function getAllCourses($conn, $college, $major = '')
{
    $sql = "SELECT id, name, number, college_id, majors_id, section, time, type FROM courses WHERE college_id = :college";
    if (!empty($major)) {
        $sql .= " AND majors_id = :major";
    }
    $stmt = $conn->prepare($sql);

    $stmt->bindValue(':college', $college);
    if (!empty($major)) {
        $stmt->bindValue(':major', $major);
    }
    $stmt->execute();
    $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
    if ($data === false) {
        return json_encode(array('error' => 'Database error: ' . $stmt->errorInfo()[2]));
    } else {
        return json_encode($data);
    }
}

function addSuggestedCourse($conn, $name, $number, $section, $time, $type, $suggest_for)
{
    // Prepare the SQL statement
    $stmt = $conn->prepare("INSERT INTO suggestCourses (name, number, section, time, type, suggest_for,a_username) VALUES (?, ?, ?, ?, ?, ?,?)");

    // Bind the values to the parameters in the SQL statement
    $stmt->bindParam(1, $name);
    $stmt->bindParam(2, $number);
    $stmt->bindParam(3, $section);
    $stmt->bindParam(4, $time);
    $stmt->bindParam(5, $type);
    $stmt->bindParam(6, $suggest_for);
    $stmt->bindParam(7, $_SESSION['username']);

    // Execute the SQL statement
    if ($stmt->execute()) {
        return true;
    } else {
        return false;
    }
}


function addCounselingRow(
    $conn,
    $u_id,
    $problem_type,
    $topic,
    $guidance_procedure,
    $recommendations,
    $notes,
    $a_username
) {
    // Prepare the SQL statement
    $stmt = $conn->prepare("INSERT INTO counseling (u_id, problem_type, topic, guidance_procedure, recommendations, notes,a_username) VALUES (?, ?, ?, ?, ?, ?,?)");

    // Bind the values to the parameters in the SQL statement
    $stmt->bindParam(1, $u_id);
    $stmt->bindParam(2, $problem_type);
    $stmt->bindParam(3, $topic);
    $stmt->bindParam(4, $guidance_procedure);
    $stmt->bindParam(5, $recommendations);
    $stmt->bindParam(6, $notes);

    $stmt->bindParam(7, $a_username);

    // Execute the SQL statement
    if ($stmt->execute()) {
        return true;
    } else {
        return false;
    }
}
function insertStudentState($pdo, $problem_type, $subject, $guidance_procedures, $notes, $u_id, $a_username)
{
    $stmt = $pdo->prepare("INSERT INTO student_status (problem_type, subject, guidance_procedures, notes, u_id, a_username) VALUES (:problem_type, :subject, :guidance_procedures, :notes, :u_id, :a_username)");
    $stmt->bindParam(':problem_type', $problem_type);
    $stmt->bindParam(':subject', $subject);
    $stmt->bindParam(':guidance_procedures', $guidance_procedures);
    $stmt->bindParam(':notes', $notes);
    $stmt->bindParam(':u_id', $u_id);
    $stmt->bindParam(':a_username', $a_username);

    if ($stmt->execute()) {
        return true;
    } else {
        return false;
    }
}


function getSuggestedCourses($pdo, $suggestFor,)
{
    // Prepare the SQL query
    $sql = "SELECT `name`, `number`, `section`, `time`, `type`, `suggest_for`, `a_username` FROM `suggestcourses` WHERE `suggest_for` = ?";

    // Prepare the statement
    $stmt = $pdo->prepare($sql);

    // Bind the parameters to the statement
    $stmt->bindParam(1, $suggestFor, PDO::PARAM_STR);


    // Execute the statement
    $stmt->execute();

    // Fetch the result set as an array of associative arrays
    $data = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Return the data array
    return $data;
}
function addAcademicFailure($conn, $difficulty, $attendance, $teaching_methods, $exam_anxiety, $family_problems, $university_environment, $high_course_load, $disinterest_in_major, $working_while_studying, $financial_issues, $long_commute, $choosing_bad_friends, $lack_of_time_for_studying, $other_reasons, $proposed_solutions, $u_id, $a_username)
{
    $stmt = $conn->prepare("INSERT INTO academic_failuer (difficulty, attendance, teaching_methods, exam_anxiety, family_problems, university_environment, high_course_load, disinterest_in_major, working_while_studying, financial_issues, long_commute, choosing_bad_friends, lack_of_time_for_studying, other_reasons, proposed_solutions, u_id, a_username) VALUES (:difficulty, :attendance, :teaching_methods, :exam_anxiety, :family_problems, :university_environment, :high_course_load, :disinterest_in_major, :working_while_studying, :financial_issues, :long_commute, :choosing_bad_friends, :lack_of_time_for_studying, :other_reasons, :proposed_solutions, :u_id, :a_username)");
    $stmt->bindParam(':difficulty', $difficulty);
    $stmt->bindParam(':attendance', $attendance);
    $stmt->bindParam(':teaching_methods', $teaching_methods);
    $stmt->bindParam(':exam_anxiety', $exam_anxiety);
    $stmt->bindParam(':family_problems', $family_problems);
    $stmt->bindParam(':university_environment', $university_environment);
    $stmt->bindParam(':high_course_load', $high_course_load);
    $stmt->bindParam(':disinterest_in_major', $disinterest_in_major);
    $stmt->bindParam(':working_while_studying', $working_while_studying);
    $stmt->bindParam(':financial_issues', $financial_issues);
    $stmt->bindParam(':long_commute', $long_commute);
    $stmt->bindParam(':choosing_bad_friends', $choosing_bad_friends);
    $stmt->bindParam(':lack_of_time_for_studying', $lack_of_time_for_studying);
    $stmt->bindParam(':other_reasons', $other_reasons);
    $stmt->bindParam(':proposed_solutions', $proposed_solutions);
    $stmt->bindParam(':u_id', $u_id);
    $stmt->bindParam(':a_username', $a_username);
    $stmt->execute();
    if (
        $stmt->execute()
    ) {
        return true;
    } else {
        return false;
    }
}
