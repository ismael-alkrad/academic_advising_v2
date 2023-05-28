<?php
include_once '../../php/check.php';
include '../../php/navbar.php';
check_activity();
check();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <link rel="shortcut icon" href="../../assets/images/logo.png">
    <link rel="stylesheet" href="../../css/bootstrap.rtl.min.css">
    <link rel="stylesheet" href="../../css/all.min.css">
    <link rel="stylesheet" href="../../css/Advisor/home.css?v=<?php echo time(); ?>">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@200;300;400;500&display=swap" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

</head>

<body>
    <?php echo generateNavbar($links = array(
        array("label" => "النماذج", "url" => "report.php"),
        array("label" => "الطلاب", "url" => "student.php"),
        array("label" => "الرئيسية", "url" => "#")
    ), getFnameByUid(
        $conn,
        $_SESSION['username']
    )); ?>
    <div class="landing">
        <div class="container text-center">
            <div class="row">
                <div class="col-6 pg-color shadow-lg mb-4 bg-body rounded">
                    <span class="icon-reduis"><img class="icon-1" src="../../assets/images/form.png"></span>
                    <h2 class="p-3">نماذج</h2>
                    <p>
                        ملء استمارات الإرشاد الأكاديمي التي تحتوي على معلومات الطالب ، ونسخة من الخطة الدراسية ،
                        والجدول
                        الزمني للمواد المسجلة للفصل الدراسي الحالي.</p>
                    <a href="report.php"><button>عرض النماذج</button></a>
                </div>
                <div class="col-4 pg-grid-4 text-start position-absolute top-50 translate-middle-x d-none d-lg-block">
                    <h1 class="p-3">مقدمة في الإرشاد الأكاديمي</h1>
                    <p class="mb-5">تعتبر عملية الإرشاد الأكاديمي جزءًا أساسيًا من الرحلة الأكاديمية للطالب. يتمثل دور
                        المرشد
                        الأكاديمي في مساعدة الطالب في تطوير وتنفيذ خطة تعليمية تلبي أهداف الطالب الأكاديمية
                        والمهنية.
                    </p>
                    <a href="about.php"> <button><i class="fa-solid fa-angles-left ps-2"></i>اقرأ أكثر</button>
                    </a>
                </div>
            </div>
            <div class="row">
                <div class="col-4  pg-grid-2 shadow-lg mb-5 bg-body rounded"><span class="icon-reduis"><img class="icon-1" src="../../assets/images/report.png"></span>
                    <h2 class="p-3"> التقرير السنوي </h2>
                    <p class="mb-5">ملء استمارة التقرير السنوي عن عملية الإرشاد الأكاديمي خلال السنة الدراسية. </p>
                    <a href="annual-report.php"><button>عرض التقرير</button></a>
                </div>
                <div class="col-4 pg-grid-3 shadow-lg mb-5 bg-body rounded"><span class="icon-reduis"><img class="icon-1" src="../../assets/images/Schedule.png"></span>
                    <h2 class="p-3">جدول</h2>
                    <p class="mb-5">الوصول إلى الخطة الدراسية للطالب والجدول الزمني للمواد المقدمة.</p>
                    <button>عرض الجدول الزمني</button>
                </div>
            </div>
        </div>
    </div>
    <script src="../../js/bootstrap.bundle.min.js"></script>
    <script src="../../js/all.min.js"></script>
</body>
<script>
    $("#log-out").click(() => {
        $.ajax({
            url: "../../php/forms/logout.php",
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
                        window.location.href = "../../index.php";
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
            url: "../../php/forms/logout.php",
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
                        window.location.href = "../../index.php";
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

</html>