<?php
include_once '../../php/check.php';
include '../../php/navbar.php';
check();
check_activity();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Report</title>
    <link rel="shortcut icon" href="../../assets/images/logo.png">
    <link rel="stylesheet" href="../../css/bootstrap.rtl.min.css">
    <link rel="stylesheet" href="../../css/all.min.css">
    <link rel="stylesheet" href="../../css/Advisor/report.css?v=<?php echo time(); ?>">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@200;300;400;500&display=swap" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body>
    <?php echo generateNavbar($links = array(
        array("label" => "التقارير", "url" => "#"),
        array("label" => "الطلاب", "url" => "student.php"),
        array("label" => "الرئيسية", "url" => "home.php")
    ), "مرشد"); ?>
    <div class="landing">
        <div class="container">
            <div class="row shadow-lg p-3 mb-4 bg-body rounded">
                <div class="col">
                    <ul class="nav nav-tabs" dir="rtl" id="myTab" role="tablist">
                        <li class="nav-item" role="presentation">
                            <input type="radio" class="btn-check" id="report" name="report" autocomplete="off" data-bs-toggle="tab" data-bs-target="#report-pane" role="tab" aria-controls="report-pane" aria-selected="true">
                            <label class="nav-link btn btn-outline-primary border-primary nav-button-primary me-1 rounded-0 rounded-top" for="report">التقارير</label>
                        </li>
                    </ul>
                    <div class="tab-content" id="myTabContent">
                        <div class="tab-pane fade" id="report-pane" role="tabpanel" aria-labelledby="report" tabindex="0">
                            <div class="accordion mt-2" id="accordionExample">
                                <div class="accordion-item">
                                    <?php
                                    $student = getStudent($conn);
                                    if ($student != null) {
                                        foreach ($student as $s) {

                                            $to = $s['email'];
                                            echo '<h2 class="accordion-header" id="heading' . $s['u_id'] . '" data-u-id="' . $s['u_id'] . '">
                                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                            data-bs-target="#collapse' . $s['u_id'] . '"  aria-expanded="false" aria-controls="collapse' . $s['u_id'] . '" data-u-id="' . $s['u_id'] . '">
                                            ' . $s['name'] . '
                                        </button>
                                                </h2>
                                    <div id="collapse' . $s['u_id'] . '" class="accordion-collapse collapse" aria-labelledby="heading' . $s['u_id'] . '"
                                        data-bs-parent="#accordionExample">
                                        <div class="accordion-body px-3">
                                            <div class="container text-center"  dir="rtl">
                                                <div class="row">
                                                    <div class="col">
                                                        <span class="icon-reduis"><img class="icon-1" src="../../assets/images/plan.png"></span>
                                                        <div class="my-3 animation"><i class="fa-solid fa-angles-left color-icon"></i><button> الخطة الدراسية </button></div>
                                                    </div>
                                                    <div class="col">
                                                        <a href="Forms/academic-advisor.php">
                                                            <span class="icon-reduis"><img class="icon-1" src="../../assets/images/academic-advisor.png"></span>
                                                            <div class="my-3 animation"><i class="fa-solid fa-angles-left color-icon"></i><button> الإرشاد الأكاديمي </button></div>
                                                        </a>
                                                    </div>
                                                    <div class="col">
                                                        <a href="Forms/suggestCourse.php">
                                                            <span class="icon-reduis"><img class="icon-1" src="../../assets/images/suggest-course.png"></span>
                                                            <div class="my-3 animation"><i class="fa-solid fa-angles-left color-icon"></i><button> توصيات تسجيل مواد </button></div>
                                                        </a>
                                                        </div>
                                                    <div class="col">
                                                        <a href="Forms/individual-encounters.php">
                                                            <span class="icon-reduis"><img class="icon-1" src="../../assets/images/individual-encounters.png"></span>
                                                            <div class="my-3 animation"><i class="fa-solid fa-angles-left color-icon"></i><button> اللقاءات الفردية </button></div>
                                                        </a>
                                                        </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col">
                                                        <span class="icon-reduis"><img class="icon-1" src="../../assets/images/help.png"></span>
                                                        <div class="my-3 animation"><i class="fa-solid fa-angles-left color-icon"></i><button> التعثر الدراسي </button></div>
                                                    </div>
                                                    <div class="col">
                                                        <span class="icon-reduis"><img class="icon-1" src="../../assets/images/help.png"></span>
                                                        <div class="my-3 animation"><i class="fa-solid fa-angles-left color-icon"></i><button> استمارة الطلبة الموهوبين </button></div>
                                                    </div>
                                                    <div class="col">
                                                        <a href="Forms/student-status.php">
                                                            <span class="icon-reduis"><img class="icon-1" src="../../assets/images/student-status.png"></span>
                                                            <div class="my-3 animation"><i class="fa-solid fa-angles-left color-icon"></i><button> تحويل حالة الطالب </button></div>
                                                        </a>
                                                        </div>
                                                    <div class="col">
                                                        <a href="Forms/annual-report.php">
                                                            <span class="icon-reduis"><img class="icon-1" src="../../assets/images/annual-report.png"></span>
                                                            <div class="my-3 animation"><i class="fa-solid fa-angles-left color-icon"></i><button> التقرير السنوي </button></div>
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    ';
                                        }
                                    } else {
                                    }
                                    ?>
                                </div>
                            </div>
                        </div>
                    </div>
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