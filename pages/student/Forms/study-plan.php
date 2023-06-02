<?php
include_once '../../../php/check.php';
include '../../../php/navbar.php';
check_activity();
check(text: "Location: ../../../index.php");
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
    <link rel="stylesheet" href="../../../css/Advisor/Forms/study-plan.css?v=<?php echo time(); ?>">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@200;300;400;500&display=swap" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>


<body>
    <?php echo generateNavbar($links = array(
        array("label" => "التقارير الطلابية", "url" => "../report.php"),
        array("label" => "الرئيسية", "url" => "../home.php")
    ), getFnameByUid(
        $conn,
        $_SESSION['username']
    ), $logo = "../../../assets/images/logo.png");


    ?>

    <div class="landing">
        <div class="container shadow-lg p-3 mb-4 bg-body rounded" dir="rtl">
            <div class="row">
                <div>
                    <h2> خطة مواد الطالب <?php echo getStudentnameByUid(
                                                $conn,
                                                $_GET['student']
                                            ); ?>
                    </h2>
                </div>
                <div class="col mt-3">
                    <table id="courses-add-table" class="table table-striped text-center" dir="rtl">
                        <thead>
                            <tr>
                                <th scope="col">الحالة</th>
                                <th scope="col">رقم المقرر</th>
                                <th scope="col">اسم المقرر</th>
                                <th scope="col"> عدد الساعات المعتمدة </th>

                            </tr>
                        </thead>
                        <tbody>
                            <?php $courseData = getCourseData($conn, $_GET['student']);
                            if ($courseData) {
                                // Iterate through each course data
                                foreach ($courseData as $course) {
                                    // Access the retrieved data for each course
                                    $courseName = $course['name'];
                                    $courseNumber = $course['number'];
                                    $remainingCourses = $course['remaining_courses'];
                                    $registeredCourses = $course['registered_courses'];
                                    $traversedCourses = $course['traversed_courses'];
                                    $hours
                                        = $course['hours'];
                                    echo '   <tr>';
                                    if ($remainingCourses == 1) {
                                        echo '<td>متبقية</td>';
                                    }

                                    // Check if Registered Courses is 1, if yes, print the first word
                                    if ($registeredCourses == 1) {
                                        echo '<td>مسجلة</td>';
                                    }

                                    // Check if Traversed Courses is 1, if yes, print the first word
                                    if ($traversedCourses == 1) {
                                        echo '<td>مجتازة</td>';
                                    }
                                    echo ' <td> ' . $courseNumber . ' </td>
                                <td> ' .   $courseName . '</td>
                                <td> ' . $hours . ' ساعات   </td>
                            </tr>';
                                    // Use the data as needed

                                }
                            } else {
                                echo "Course data not found.";
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
                <div class="save-responsive d-flex justify-content-center mt-4">
                    <button id="save" type="submit" class="button-style fs-6 d-flex justify-content-center align-items-center text-center" style="color: #ffffff;  margin-bottom: 20px;">
                        طباعة
                        <i class="ui-button-icon-left ui-icon ui-c fa fa-print white ps-1" style="color: #ffffff;"></i>
                    </button>
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