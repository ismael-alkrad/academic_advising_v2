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

function sendMail($pdo, $to, $subject, $message, $from)
{
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

        $sql = ($row_count > 0) ? "UPDATE personal_data SET  region=:region, phone_house=:phone_house, city=:city, phone_person=:phone_person, email=:email, place_birth=:place_birth, birth_date=:birth, status=:status, gender=:gender WHERE u_id=:u_id" : "INSERT INTO personal_data (u_id, region, phone_house, city, phone_person, email, place_birth, birth_date, status, gender) VALUES (:u_id, :region, :phone_house, :city, :phone_person, :email, :place_birth, :birth, :status, :gender)";

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
function getAllStudentWithoutAdvisor($conn, $college, $major = '')
{
    $sql = "SELECT * FROM student_info WHERE college = :college AND Advisor='none'";
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

function uploadPhoto($conn)
{
    if (isset($_POST['photo'])) {
        // Get the file data
        $file_data = $_POST['photo'];

        // Get the filepath of the old photo, if it exists
        $old_filepath = getPhotoPathByUser($conn);

        // If the old photo exists, delete it from the directory
        if ($old_filepath && file_exists($old_filepath)) {
            unlink($old_filepath);
        }

        // Decode the base64-encoded data URI
        $img_data = str_replace('data:image/png;base64,', '', $file_data);
        $img_data = str_replace(' ', '+', $img_data);
        $img_data = base64_decode($img_data);

        // Generate a unique filename for the uploaded photo
        $filename = uniqid() . '.png';

        // Set the file path where the photo will be stored
        $filepath = '../../assets/images/personal-photo/' . $filename;

        // Save the cropped image to the directory
        if (file_put_contents($filepath, $img_data)) {
            // Prepare and execute the SQL query to insert/update the photo record
            $stmt = $conn->prepare("INSERT INTO photos (u_id, name, type, size, filepath) VALUES (?, ?, ?, ?, ?) 
                                    ON DUPLICATE KEY UPDATE name = VALUES(name), type = VALUES(type), size = VALUES(size), filepath = VALUES(filepath)");
            $stmt->bindParam(1, $_SESSION['username']);
            $stmt->bindParam(2, $filename);
            $stmt->bindValue(3, 'image/png');
            $stmt->bindValue(4, filesize($filepath));
            $stmt->bindParam(5, $filepath);
            $stmt->execute();

            // Return a success message
            echo "Photo uploaded successfully!";
        } else {
            // Return an error message
            echo "Error uploading photo. Please try again.";
        }
    }
}

function deletePhoto($conn)
{
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Get the filename from the database
        $stmt = $conn->prepare("SELECT filepath FROM photos WHERE u_id = ?");
        $stmt->bindParam(1, $_SESSION['username']);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        $filename = $row['filepath'];

        // Delete the file from the folder
        if (file_exists($filename)) {
            unlink($filename);
        }

        // Delete the record from the database
        $stmt = $conn->prepare("DELETE FROM photos WHERE u_id = ?");
        $stmt->bindParam(1, $_SESSION['username']);
        $stmt->execute();

        // Return success response
        echo json_encode(array('status' => 'success'));
        exit;
    }
}
function addStudentToAdvisor($tableData, $new_value, $conn)
{

    if (isset($tableData)) {
        try {
            foreach ($tableData as $rowData) {
                $u_id = $rowData[0];

                $stmt = $conn->prepare("UPDATE student_info SET advisor = :new_value WHERE u_id = :u_id");
                $stmt->bindParam(':new_value', $new_value);
                $stmt->bindParam(':u_id', $u_id);
                $stmt->execute();
            }
            return 'success';
        } catch (PDOException $e) {
            return "Error: " . $e->getMessage();
        }
    } else {
        return "Error: table data is not set";
    }
}

function getFnameByUid($pdo, $u_id)
{
    $stmt = $pdo->prepare("SELECT fname FROM users WHERE username = :u_id");
    $stmt->execute(array(':u_id' => $u_id));
    $result = $stmt->fetch();
    return $result['fname'];
}
function getStudentnameByUid($pdo, $u_id)
{
    $stmt = $pdo->prepare("SELECT name FROM student_info WHERE u_id = :u_id");
    $stmt->execute(array(':u_id' => $u_id));
    $result = $stmt->fetch();
    return $result['name'];
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


function createIndividualMeetings(
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


function getStudentInfo($u_id, $pdo)
{
    $query = "SELECT si.ar_name, pd.phone_house, pd.email,semester,u_year
              FROM student_information si
              JOIN personal_data pd ON si.u_id = pd.u_id
              WHERE si.u_id = :u_id";

    $stmt = $pdo->prepare($query);
    $stmt->bindParam(':u_id', $u_id, PDO::PARAM_INT);
    $stmt->execute();

    $result = $stmt->fetch(PDO::FETCH_ASSOC);

    return $result;
}
function getTalents($u_id, $pdo)
{
    $query = "SELECT talent
              FROM talents
              WHERE u_id = :u_id";

    $stmt = $pdo->prepare($query);
    $stmt->bindParam(':u_id', $u_id, PDO::PARAM_STR);
    $stmt->execute();

    $result = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($result) {
        $talents = explode(',', $result['talent']);
        return $talents;
    }
}



function getCourseData($connection, $uId)
{
    // Prepare the SQL query with a parameter for u_id
    $query = "SELECT course_id, remaining_courses, registered_courses, traversed_courses
              FROM studentplan
              WHERE u_id = :uId";

    // Prepare the statement
    $statement = $connection->prepare($query);

    // Bind the parameter value
    $statement->bindParam(':uId', $uId);

    // Execute the query
    $statement->execute();

    // Fetch the data
    $courseData = $statement->fetchAll(PDO::FETCH_ASSOC);

    // Check if the query executed successfully
    if ($courseData) {
        $result = array();
        // Iterate through each row in the result
        foreach ($courseData as $row) {
            // Access the course_id for each row
            $courseId = $row['course_id'];

            // Query the second table based on the course_id
            $secondTableQuery = "SELECT name, number,hours FROM courses WHERE id = :courseId";
            $secondTableStatement = $connection->prepare($secondTableQuery);
            $secondTableStatement->bindParam(':courseId', $courseId);
            $secondTableStatement->execute();
            $secondTableData = $secondTableStatement->fetch(PDO::FETCH_ASSOC);

            // Combine the data from both tables
            $combinedData = array_merge($row, $secondTableData);

            // Add the combined data to the result array
            $result[] = $combinedData;
        }

        // Return the result array
        return $result;
    } else {
        // Query execution failed or no data found
        return null;
    }
}
function getLastInsertedRowFromCounseling($conn, $u_id)
{
    $stmt = $conn->prepare("SELECT * FROM counseling WHERE u_id = ?");
    $stmt->execute([$u_id]);
    $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

    return $rows;
}
function displayStudentStatusRows($conn, $u_id)
{
    $stmt = $conn->prepare("SELECT * FROM student_status WHERE u_id = ?");
    $stmt->execute([$u_id]);
    $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

    return $rows;
}
function deleteStudentFromAdvisor($conn)
{
    if (isset($_POST['tableData'])) {
        try {
            foreach ($_POST['tableData'] as $rowData) {
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
}
function insertAcademicFailure($conn, $difficulty, $attendance, $teaching_methods, $exam_anxiety, $family_problems, $university_environment, $high_course_load, $disinterest_in_major, $working_while_studying, $financial_issues, $long_commute, $choosing_bad_friends, $lack_of_time_for_studying, $other_reasons, $proposed_solutions, $u_id, $a_username)
{


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
        return "success";
    } else {
        return "Error: " . $stmt->errorInfo()[2];
    }
}
function insertTalents($talents, $conn, $advisor)
{
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
}
function prepareAnnualReport($conn)
{
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $academic_advising_students = $_POST['academic_advising_students'];
        $external_students = $_POST['external_students'];
        $advised_students = $_POST['advised_students'];
        $total_students = $_POST['total_students'];

        $individual_meetings = $_POST['individual_meetings'];
        $struggling_students = $_POST['struggling_students'];
        $struggling_advised_students = $_POST['struggling_advised_students'];
        $transferred_groups = $_POST['transferred_groups'];

        // Get the current year
        $current_year = date('Y');

        // Check if statistics for the current year exist in the database
        $sql = "SELECT * FROM advising_statistics WHERE year = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(1, $current_year);
        $stmt->execute();

        $existing_statistics = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($existing_statistics) {
            // Statistics for the current year already exist, update the information
            $sql = "UPDATE advising_statistics SET academic_advising_students = ?, external_students = ?, advised_students = ?, total_students = ?, individual_meetings = ?, struggling_students = ?, struggling_advised_students = ?, transferred_groups = ?, a_username = ? WHERE year = ?";
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
            $stmt->bindParam(10, $current_year);

            if ($stmt->execute()) {
                echo "success";
            } else {
                echo "خطأ في تحديث الإحصائيات: " . $stmt->errorInfo()[2];
            }
        } else {
            // Statistics for the current year don't exist, insert a new row
            $sql = "INSERT INTO advising_statistics (academic_advising_students, external_students, advised_students, total_students, individual_meetings, struggling_students, struggling_advised_students, transferred_groups, a_username, year) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
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
            $stmt->bindParam(10, $current_year);

            if ($stmt->execute()) {
                echo "success";
            } else {
                echo "خطأ في إدراج الإحصائيات: " . $stmt->errorInfo()[2];
            }
        }
    }
}


function createAnnualReport($conn)
{
    $current_year = date('Y');

    $sql = "SELECT * FROM advising_statistics WHERE year = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(1, $current_year);
    $stmt->execute();

    $statistics = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return $statistics;
}
function countRows($conn, $tableName, $condition)
{
    $stmt = $conn->prepare("SELECT COUNT(*) as count FROM $tableName WHERE advisor = :username");
    $stmt->bindParam(':username', $condition);
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);

    return $result['count'];
}

function countRow2($conn, $tableName, $condition)
{
    $stmt = $conn->prepare("SELECT COUNT(*) as count FROM $tableName WHERE a_username = :username");
    $stmt->bindParam(':username', $condition);
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);

    return $result['count'];
}
