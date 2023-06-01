<?php
include_once '../../../php/check.php';
include '../../../php/navbar.php';
include
    '../../../php/connect.php';
check_activity();
check(text: "Location: ../../../index.php");


$studentInfo = getStudentInfo($_GET['student'], $conn) ?? array();
$name = $studentInfo['ar_name'] ?? getFnameByUid(
    $conn,
    $_GET['student']
);
$phone = $studentInfo['phone_house'] ?? "    ";
$email = $studentInfo['email'] ?? " ";
$semester = $studentInfo['semester'] ?? " ";
$u_year = $studentInfo['u_year'] ?? " ";



$talents = getTalents($_GET['student'], $conn) ?? array();

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Academic Advisor </title>
    <link rel="shortcut icon" href="../../../assets/images/logo.png">
    <link rel="stylesheet" href="../../../css/bootstrap.rtl.min.css">
    <link rel="stylesheet" href="../../../css/all.min.css">
    <link rel="stylesheet" href="../../../css/Advisor/Forms/view-report.css?v=<?php echo time(); ?>">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@200;300;400;500&display=swap" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/print-js/1.6.0/print.min.js"></script>

</head>


<body>
    <?php echo generateNavbar($links = array(
        array("label" => "التقارير الطلابية", "url" => "../report.php"),
        array("label" => "الرئيسية", "url" => "../home.php")
    ), getFnameByUid(
        $conn,
        $_SESSION['username']
    ), $logo = "../../../assets/images/logo.png"); ?>

    <div class="landing">
        <div class="container shadow-lg p-3 mb-4 bg-body rounded" dir="rtl">
            <div class="row">
                <div>
                    <h2> تقارير الطالب <?php echo getStudentnameByUid(
                                            $conn,
                                            $_GET['student']
                                        ); ?>
                    </h2>
                </div>
                <div class="col mt-3">
                    <ul class="nav nav-tabs" dir="rtl" id="myTab" role="tablist">
                        <li class="nav-item" role="presentation">
                            <input type="radio" class="btn-check" id="gifted-students" name="report" autocomplete="off" data-bs-toggle="tab" data-bs-target="#gifted-students-pane" role="tab" aria-controls="gifted-students-pane" aria-selected="true">
                            <label class="nav-link btn btn-outline-primary border-primary nav-button-primary me-1 rounded-0 rounded-top" for="gifted-students"> تقرير المواهب </label>
                        </li>
                        <li class="nav-item" role="presentation">
                            <input type="radio" class="btn-check" id="academic-failure" name="report" autocomplete="off" data-bs-toggle="tab" data-bs-target="#academic-failure-pane" role="tab" aria-controls="academic-failure-pane" aria-selected="false">
                            <label class="nav-link btn btn-outline-primary border-primary nav-button-primary me-1 rounded-0 rounded-top" for="academic-failure"> تقرير التعثر الدراسي </label>
                        </li>
                        <li class="nav-item" role="presentation">
                            <input type="radio" class="btn-check" id="individual-encounters" name="report" autocomplete="off" data-bs-toggle="tab" data-bs-target="#individual-encounters-pane" role="tab" aria-controls="individual-encounters-pane" aria-selected="false">
                            <label class="nav-link btn btn-outline-primary border-primary nav-button-primary me-1 rounded-0 rounded-top" for="individual-encounters"> تقرير اللقاءات الفردية </label>
                        </li>
                        <li class="nav-item" role="presentation">
                            <input type="radio" class="btn-check" id="student-status" name="report" autocomplete="off" data-bs-toggle="tab" data-bs-target="#student-status-pane" role="tab" aria-controls="student-status-pane" aria-selected="false">
                            <label class="nav-link btn btn-outline-primary border-primary nav-button-primary me-1 rounded-0 rounded-top" for="student-status"> تقرير تحويل حالة الطالب </label>
                        </li>
                    </ul>
                    <div class="tab-content pt-3" dir="rtl" id="myTabContent">
                        <div class="tab-pane fade" id="gifted-students-pane" role="tabpanel" aria-labelledby="gifted-students" tabindex="0">
                            <table class="table table-bordered">
                                <tbody>
                                    <tr>
                                        <th scope="row">الاسم الرباعي</th>
                                        <td><?php echo $name; ?></td>
                                    </tr>
                                    <tr>

                                        <th scope="row">رقم الهاتف </th>
                                        <td><?php echo $phone; ?></td>
                                    </tr>
                                    <tr>
                                        <th scope="row">البريد الالكتروني</th>
                                        <td><?php echo $email; ?></td>
                                    </tr>
                                </tbody>
                            </table>
                            <div class="mt-5">
                                <h4> المواهب التي يتمتع بها الطالب </h4>
                                <div>
                                    <table class="table table-striped text-center">
                                        <thead>
                                            <tr>
                                                <th scope="col">#</th>
                                                <th scope="col">الموهبة</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php

                                            $count = 1;
                                            if (!empty($talents)) {
                                                foreach ($talents as $talent) {

                                                    if ($talent != 'none') {
                                                        echo '  <tr>
                                                <th scope="row">' . $count . '</th>
                                                <td>' . $talent . '</td>
                                            </tr>';
                                                        $count++;
                                                    }
                                                }
                                            } else {
                                                echo "لا يوجد تقارير بعد للطالب : ";
                                                echo getFnameByUid(
                                                    $conn,
                                                    $_GET['student']
                                                );
                                            }

                                            ?>


                                        </tbody>
                                    </table>
                                </div>
                                <div class="row pt-3">
                                    <div class="col">
                                        <div class="save-responsive d-flex justify-content-center mt-4">
                                            <button id="save" type="submit" class="button-style fs-6 d-flex justify-content-center align-items-center text-center" style="color: #ffffff;  margin-bottom: 20px;">
                                                طباعة
                                                <i class="ui-button-icon-left ui-icon ui-c fa fa-print white ps-1" style="color: #ffffff;"></i>
                                            </button>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                    <div class="tab-content pt-3" dir="rtl" id="myTabContent2">
                        <div class="tab-pane fade" id="academic-failure-pane" role="tabpanel" aria-labelledby="academic-failure" tabindex="0">
                            <table class="table table-bordered">
                                <tbody>
                                    <tr>
                                        <th scope="row">الاسم الرباعي</th>
                                        <td><?php echo $name; ?></td>
                                    </tr>

                                    <tr>
                                        <th scope="row">الرقم الجامعي</th>
                                        <td><?php echo $_GET['student'] ?></td>
                                    </tr>
                                    <tr>
                                        <th scope="row"> الفصل الدراسي / العام الجامعي للطالب </th>
                                        <td><?php echo $semester . '/' . $u_year ?></td>
                                    </tr>

                                </tbody>
                            </table>
                            <table class="table table-bordered position">
                                <thead>
                                    <tr>
                                        <th scope="col">العبارات</th>
                                        <th scope="col" class="text-center">الخيار</th>

                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $u_id = $_GET['student'];



                                    try {
                                        // Create a new PDO instance

                                        // Retrieve the u_id from the parameter

                                        // Prepare and execute the SQL query
                                        $sql = "SELECT * FROM academic_failures WHERE u_id = :u_id";
                                        $stmt = $conn->prepare($sql);
                                        $stmt->bindParam(':u_id', $u_id);
                                        $stmt->execute();

                                        // Fetch the data from the query result
                                        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);


                                        // Display the retrieved data
                                        foreach ($result as $row) {
                                            foreach ($row as $column => $value) {
                                                if ($column != 'u_id' && $column != 'a_username' && $column != 'id') {
                                                    $arabicColumn = getArabicColumnName($column); // Function to get Arabic column name
                                                    echo '<tr>
                                                        <th scope="row">' . $arabicColumn . '</th>
                                                        <td class="text-center">' . $row[$column] . '</td>
                                                
                                                    </tr>';
                                                }
                                            }
                                            echo "<br>";
                                        }
                                    } catch (PDOException $e) {
                                        echo "Connection failed: " . $e->getMessage();
                                    }

                                    // Function to map English column names to Arabic
                                    function getArabicColumnName($column)
                                    {
                                        $arabicColumns = array(
                                            'difficulty' => 'صعوبة المواد الدراسية',
                                            'attendance' => 'الغياب المتكرر عن المحاضرات',
                                            'teaching_methods' => 'عدم مناسبة أساليب التدريس',
                                            'exam_anxiety' => 'التوتر والخوف من الامتحانات',
                                            'family_problems' => 'مشاكل أسرية',
                                            'university_environment' => 'عدم التأقلم مع البيئة الجامعية',
                                            'high_course_load' => 'عدد الساعات المسجلة في الفصل الدراسي عال',
                                            'disinterest_in_major' => 'عدم رغبتي في التخصص',
                                            'working_while_studying' => 'أعمل أثناء التحاقي بالجامعة',
                                            'financial_issues' => 'عدم القدرة على تأمين تكاليف الدراسة',
                                            'long_commute' => 'المسافة التي أقطعها للوصول للجامعة طويلة',
                                            'choosing_bad_friends' => 'عدم اختيار الأصدقاء الجيدين',
                                            'lack_of_time_for_studying' => 'لا أجد الوقت للدراسة',
                                            'other_reasons' => 'أسباب أخرى',
                                            'proposed_solutions' => 'حلول مقترحة'
                                        );

                                        return isset($arabicColumns[$column]) ? $arabicColumns[$column] : $column;
                                    }
                                    ?>
                                </tbody>
                            </table>
                            <div class="row pt-3">
                                <div class="col mt-3" id="">
                                    <label class="form-label text-start">
                                        الحلول المقترحة
                                    </label>
                                    <div class="save-responsive d-flex justify-content-center mt-4">
                                        <button id="save2" type="submit" class="button-style fs-6 d-flex justify-content-center align-items-center text-center" style="color: #ffffff;  margin-bottom: 20px;">
                                            طباعة
                                            <i class="ui-button-icon-left ui-icon ui-c fa fa-print white ps-1" style="color: #ffffff;"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="tab-content pt-3" dir="rtl" id="myTabContent3">
                        <div class="tab-pane fade" id="individual-encounters-pane" role="tabpanel" aria-labelledby="individual-encounters" tabindex="0">
                            <?php

                            $rows = getLastInsertedRowFromCounseling(
                                $conn,
                                $_GET['student']
                            );

                            foreach ($rows as $row) {
                                $problem_type = $row['problem_type'];
                                $topic = $row['topic'];
                                $guidance_procedure = $row['guidance_procedure'];
                                $recommendations = $row['recommendations'];
                                $notes = $row['notes'];

                                echo '<div class="row pb-3">';
                                echo '<div class="col">';
                                echo '<label> نوع المشكلة : </label>';
                                echo '<span>' . $problem_type . '</span>';
                                echo '</div>';
                                echo '</div>';

                                echo '<div class="row py-3">';
                                echo '<div class="col">';
                                echo '<label> الموضوع : </label>';
                                echo '<div>' . $topic . '</div>';
                                echo '</div>';
                                echo '</div>';

                                echo '<div class="row py-3">';
                                echo '<div class="col">';
                                echo '<label> الإجراء الإرشادي : </label>';
                                echo '<div>' . $guidance_procedure . '</div>';
                                echo '</div>';
                                echo '</div>';

                                echo '<div class="row py-3">';
                                echo '<div class="col">';
                                echo '<label> التوصيات : </label>';
                                echo '<div> تحويل الحالة الى مركز الإرشاد النفسي والاجتماعي : <label>' . $recommendations . '</label> </div>';
                                echo '</div>';
                                echo '</div>';

                                echo '<div class="row py-3">';
                                echo '<div class="col">';
                                echo '<label> ملاحظات : </label>';
                                echo '<div>' . $notes . '</div>';
                                echo '</div>';
                                echo '</div>';
                                echo "<hr>";
                            }


                            ?>
                            <div class="row pt-3">
                                <div class="col" id="">
                                    <div class="save-responsive d-flex justify-content-center mt-4">
                                        <button id="save3" type="submit" class="button-style fs-6 d-flex justify-content-center align-items-center text-center" style="color: #ffffff;  margin-bottom: 20px;">
                                            طباعة
                                            <i class="ui-button-icon-left ui-icon ui-c fa fa-print white ps-1" style="color: #ffffff;"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-content pt-3" dir="rtl" id="myTabContent4">
                        <div class="tab-pane fade" id="student-status-pane" role="tabpanel" aria-labelledby="student-status" tabindex="0">

                            <?php
                            $rows = displayStudentStatusRows(
                                $conn,
                                $_GET['student']
                            );
                            foreach ($rows as $row) {
                                $problem_type = $row['problem_type'];
                                $subject = $row['subject'];
                                $guidance_procedures = $row['guidance_procedures'];
                                $notes = $row['notes'];
                                $u_id = $row['u_id'];
                                $a_username = $row['a_username'];

                                echo '<div class="row pb-3">';
                                echo '<div class="col">';
                                echo '<label> نوع المشكلة : </label>';
                                echo '<span>' . $problem_type . '</span>';
                                echo '</div>';
                                echo '</div>';

                                echo '<div class="row py-3">';
                                echo '<div class="col">';
                                echo '<label> الموضوع : </label>';
                                echo '<div>' . $subject . '</div>';
                                echo '</div>';
                                echo '</div>';

                                echo '<div class="row py-3">';
                                echo '<div class="col">';
                                echo '<label> الإجراء الإرشادي : </label>';
                                echo '<div>' . $guidance_procedures . '</div>';
                                echo '</div>';
                                echo '</div>';

                                echo '<div class="row py-3">';
                                echo '<div class="col">';
                                echo '<label> ملاحظات : </label>';
                                echo '<div>' . $notes . '</div>';
                                echo '</div>';
                                echo '</div>';
                                echo "<hr>";
                            }
                            ?>

                            <div class="row pt-3">
                                <div class="col" id="">
                                    <div class="save-responsive d-flex justify-content-center mt-4">
                                        <button id="save4" type="submit" class="button-style fs-6 d-flex justify-content-center align-items-center text-center" style="color: #ffffff;  margin-bottom: 20px;">
                                            طباعة
                                            <i class="ui-button-icon-left ui-icon ui-c fa fa-print white ps-1" style="color: #ffffff;"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="../../../js/bootstrap.bundle.min.js"></script>
    <script src="../../../js/all.min.js"></script>

    <script>
        document.getElementById('save').addEventListener('click', function() {
            this.style.visibility = 'hidden';
            window.print();

        });
        document.getElementById('save2').addEventListener('click', function() {
            this.style.visibility = 'hidden';

            window.print();
        });
        document.getElementById('save3').addEventListener('click', function() {
            this.style.visibility = 'hidden';

            window.print();
        });
        document.getElementById('save4').addEventListener('click', function() {
            this.style.visibility = 'hidden';

            window.print();
        });
    </script>

    <script>
        $("#log-out").click(() => {
            $.ajax({
                url: "../../../php/forms/logout.php",
                type: "POST",
                success: function(data) {
                    if (data === 'success') {
                        Swal.fire({
                            position: "center",
                            icon: "success",
                            title: "تم تسجيل الخروج بنجاح",
                            showConfirmButton: false,
                            allowOutsideClick: false,
                            timer: 1500,
                        });
                        setTimeout(function() {
                            window.location.href = "../../../index.php";
                        }, 1500);
                    } else {
                        Swal.fire({
                            position: "center",
                            icon: "error",
                            title: "حدث خطأ ما",
                            showConfirmButton: false,
                            allowOutsideClick: false,
                            timer: 1500,
                        });
                    }
                }
            });
        });
        $("#log-out-res").click(() => {
            $.ajax({
                url: "../../../php/forms/logout.php",
                type: "POST",
                success: function(data) {
                    if (data === 'success') {
                        Swal.fire({
                            position: "center",
                            icon: "success",
                            title: "تم تسجيل الخروج بنجاح",
                            showConfirmButton: false,
                            allowOutsideClick: false,
                            timer: 1500,
                        });
                        setTimeout(function() {
                            window.location.href = "../../../index.php";
                        }, 1500);
                    } else {
                        Swal.fire({
                            position: "center",
                            icon: "error",
                            title: "حدث خطأ ما",
                            showConfirmButton: false,
                            allowOutsideClick: false,
                            timer: 1500,
                        });
                    }
                }
            });
        });
    </script>
</body>

</html>