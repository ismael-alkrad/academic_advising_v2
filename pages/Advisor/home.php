<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <link rel="stylesheet" href="../../css/bootstrap.rtl.min.css">
    <link rel="stylesheet" href="../../css/all.min.css">
    <link rel="stylesheet" href="../../css/home.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@200;300;400;500&display=swap" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

</head>

<body>
    <nav class="navbar navbar-expand-lg shadow-lg p-1 mb-5 bg-body rounded position-sticky top-0">
        <div class="container">
            <button id="log-out" class="navbar fs-6 d-flex justify-content-center text-center" style="color: #ffffff;" href="#">تسجيل
                خروج <i class="fa-solid fa-arrow-right-from-bracket px-1" style="color: #ffffff;"></i></button>
            <div>
                <div class="navbar navbar-collapse me-auto ">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                            <a class="nav-link" href="#"><span>المزيد</span></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#"><span>التقارير</span></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#"><span>الطلاب</span></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active" href="#"><span>الرئيسية</span></a>
                        </li>
                    </ul>
                    <span>الإرشاد الأكاديمي</span>
                    <img height="70px" src="../../assets/images/logo.png">
                </div>
            </div>
        </div>
    </nav>
    <div class="landing">
        <div class="container text-center">
            <div class="row">
                <div class="col-6 pg-color shadow-lg p-3 mb-4 bg-body rounded">
                    <span class="icon-reduis"><img class="icon-1" src="../../assets/images/form.png"></span>
                    <h2 class="p-3">نماذج</h2>
                    <p>
                        ملء استمارات الإرشاد الأكاديمي التي تحتوي على معلومات الطالب ، ونسخة من الخطة الدراسية ،
                        والجدول
                        الزمني للمواد المسجلة للفصل الدراسي الحالي.</p>
                    <button>عرض النماذج</button>
                </div>
                <div class="col-4 pg-grid-4 text-start position-absolute top-50 translate-middle-x">
                    <h1 class="p-3">مقدمة في الإرشاد الأكاديمي</h1>
                    <p class="mb-5">تعتبر عملية الإرشاد الأكاديمي جزءًا أساسيًا من الرحلة الأكاديمية للطالب. يتمثل دور
                        المرشد
                        الأكاديمي في مساعدة الطالب في تطوير وتنفيذ خطة تعليمية تلبي أهداف الطالب الأكاديمية
                        والمهنية.
                    </p>
                    <button><i class="fa-solid fa-angles-left ps-2"></i>اقرأ أكثر</button>
                </div>
            </div>
            <div class="row">
                <div class="col-4 pg-grid-2 shadow-lg p-2 mb-5 bg-body rounded"><span class="icon-reduis"><img class="icon-1" src="../../assets/images/report.png"></span>
                    <h2 class="p-3">التقارير</h2>
                    <p class="mb-5">عرض التقرير التفصيلي عن عملية الإرشاد الأكاديمي خلال الفصل الدراسي.</p>
                    <button>عرض التقارير</button>
                </div>
                <div class="col-4 pg-grid-3 shadow-lg p-2 mb-5 bg-body rounded"><span class="icon-reduis"><img class="icon-1" src="../../assets/images/Schedule.png"></span>
                    <h2 class="p-3">جدول</h2>
                    <p class="mb-5">الوصول إلى الخطة الدراسية للطالب والجدول الزمني للمواد المقدمة.</p>
                    <button>عرض الجدول الزمني</button>
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
                        timer: 1500,
                    });
                }



            }
        });
    });
</script>

</html>