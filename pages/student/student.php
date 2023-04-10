<!DOCTYPE html>
<html lang="en">
<?php session_start()   ?>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student</title>
    <link rel="shortcut icon" href="../../assets/images/logo.png">
    <link rel="stylesheet" href="../../css/bootstrap.rtl.min.css">
    <link rel="stylesheet" href="../../css/all.min.css">
    <link rel="stylesheet" href="../../css/Student/student.css?v=<?php echo time(); ?>">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@200;300;400;500&display=swap" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body>
    <nav class="navbar navbar-expand-lg shadow-lg p-1 mb-5 bg-body rounded position-sticky top-0">
        <div class="container position-relative">
            <button id="log-out" class="navbar fs-6 d-flex justify-content-center text-center d-none d-lg-block d-xl-block d-xxl-block" style="color: #ffffff;">تسجيل
                خروج <i class="fa-solid fa-arrow-right-from-bracket px-1" style="color: #ffffff;"></i></button>
            <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight" aria-controls="offcanvasRight" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="navbar collapse navbar-collapse me-auto">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link" href="#"><span>المزيد</span></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#"><span>التقارير</span></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="student.php"><span>الطلاب</span></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="#"><span>الرئيسية</span></a>
                    </li>
                </ul>
                <span class="d-flex flex-column align-items-end ms-2"> الإرشاد الأكاديمي<span>
                        <small class="text-secondary">(طالب)</small>
                    </span></span>
                <img class="d-none d-lg-block d-xl-block d-xxl-block" height="70px" src="../../assets/images/logo.png">
            </div>

            <!-- ------------------------------------Navbar Responsive-------------------------------------------- -->

            <div class="offcanvas offcanvas-start d-sm-block d-md-block d-lg-none" tabindex="-1" id="offcanvasRight" aria-labelledby="offcanvasRightLabel">
                <div class="position-relative">
                    <div class="offcanvas-header">
                        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                        <h1 class="offcanvas-title" id="offcanvasRightLabel">القائمة</h1>
                        <ul class="navbar-nav position-absolute top-0 start-0 pt-3 mt-5 mx-4 d-sm-block d-md-block d-lg-none">
                            <li class="nav-item">
                                <a class="nav-link active" href="#"><span>الرئيسية</span></a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="student.php"><span>الطلاب</span></a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#"><span>التقارير</span></a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#"><span>المزيد</span></a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <img class="position-absolute top-0 end-0 d-sm-block d-md-block d-lg-none mx-4" height="45px" src="../../assets/images/logo.png">
        </div>
    </nav>
    <div class="landing">
        <div class="container px-4 text-center">
            <div class="row gx-5 shadow-lg p-3 mb-5 bg-body rounded">
                <div class="col border-start">
                    <div class="p-3 border-bottom bg-white">
                        <div class="bg-white rounded-circle" style="position: relative; left: 265px; top: 110px; width: 25px; cursor: pointer; z-index: 1;" data-bs-toggle="modal" data-bs-target="#exampleModal"><i class="fa-solid fa-pen-to-square"></i></div>
                        <img class="rounded-circle icon-radius" src="<?php echo $_SESSION['img'] ?>">
                        <div class="mt-1"><label><?php echo $_SESSION['name'] ?></label></div>
                        <div><small><?php echo $_SESSION['username'] ?></small></div>
                        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content">
                                    <div class="modal-header" style="display: flex; flex-direction: row-reverse;">
                                        <h1 class="modal-title fs-5" id="exampleModalLabel">اعدادات الصورة</h1>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="upload-container my-3">
                                            <label for="file-upload">اسحب الصورة هنا أو انقر للتصفح</label>
                                            <input type="file" id="file-upload" accept="Image/*">
                                        </div>
                                        <div>
                                            <button class="button-style rounded bg-secondary text-white" style="width: 75%; height: 40px;">Delete</button>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">الغاء</button>
                                        <button type="button" class="btn btn-primary"> حفظ </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <div class="p-2 bg-white">
                                <table class="table table-bordered border-primary" dir="rtl">
                                    <tbody>
                                        <tr>
                                            <th scope="row">البريد الالكتروني</th>
                                            <td><?php echo $_SESSION['email'] ?></td>
                                        </tr>
                                        <tr>
                                            <th scope="row">رقم الهاتف</th>
                                            <td><?php echo $_SESSION['phone'] ?></td>
                                        </tr>
                                        <tr>
                                            <th scope="row"> الكلية </th>
                                            <td><?php echo $_SESSION['college'] ?></td>
                                        </tr>
                                        <tr>
                                            <th scope="row"> القسم </th>
                                            <td><?php echo $_SESSION['major'] ?></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="p-3 bg-white">
                        <div class="row row-cols-2 row-cols-lg-1 g-3 g-lg-4 justify-content-center">
                            <div class="col">
                                <button class="button-style">
                                    <a>
                                        <div class="p-3 rounded bg-secondary"><i class="fa-solid fa-file" style="color: #ffffff;"></i>
                                            <div class="text-white">
                                                تفريغ خطة الطالب
                                            </div>
                                        </div>
                                    </a>
                                </button>
                            </div>
                            <div class="col">
                                <button class="button-style">
                                    <a href="home.php">
                                        <div class="p-3 rounded bg-secondary"><i class="fa-solid fa-user-pen" style="color: #ffffff;"></i>
                                            <div class="text-white">
                                                تعديل المعلومات
                                            </div>
                                        </div>
                                    </a>
                                </button>
                            </div>
                            <div class="col">
                                <button class="button-style">
                                    <a href="#">
                                        <div class="p-3 rounded bg-secondary"><i class="fa-solid fa-file-signature" style="color: #ffffff;"></i>
                                            <div class="text-white">
                                                المواد المقترحة
                                            </div>
                                        </div>
                                    </a>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div><!----------------------------------------- start  Log out ------------------------------------>
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
    <!----------------------------------------- End  Log out ------------------------------------>

    <script src="../../js/bootstrap.bundle.min.js"></script>
    <script src="../../js/all.min.js"></script>
</body>

</html>