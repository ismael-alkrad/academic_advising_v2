<?php
include_once '../../php/check.php';

check();
check_activity();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student</title>
    <link rel="shortcut icon" href="../../assets/images/logo.png">
    <link rel="stylesheet" href="../../css/bootstrap.rtl.min.css">
    <link rel="stylesheet" href="../../css/all.min.css">
    <link rel="stylesheet" href="../../css/Advisor/student.css?v=<?php echo time(); ?>">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@200;300;400;500&display=swap" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body>
    <nav class="navbar navbar-expand-lg shadow-lg p-1 mb-5 bg-body rounded position-sticky top-0">
        <div class="container position-relative">
            <button id="log-out" class="navbar button-style fs-6 d-flex justify-content-center text-center d-none d-lg-block d-xl-block d-xxl-block" style="color: #ffffff;">تسجيل
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
                        <a class="nav-link active" href="#"><span>الطلاب</span></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="home.php"><span>الرئيسية</span></a>
                    </li>
                </ul>
                <span class="d-none d-lg-block d-xl-block d-xxl-block">الإرشاد الأكاديمي</span>
                <img class="d-none d-lg-block d-xl-block d-xxl-block" height="70px" src="../../assets/images/logo.png">
            </div>

            <!-- ------------------------------------Navbar Responsive-------------------------------------------- -->

            <div class="offcanvas offcanvas-start d-sm-block d-md-block d-lg-none" tabindex="-1" id="offcanvasRight" aria-labelledby="offcanvasRightLabel">
                <div class="position-relative">
                    <div class="offcanvas-header">
                        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                        <h1 class="offcanvas-title" id="offcanvasRightLabel">القائمة</h1>
                        <ul dir="rtl" class="navbar-nav position-absolute top-0 start-0 pt-3 mt-5 mx-4 d-sm-block d-md-block d-lg-none">
                            <li class="nav-item">
                                <a class="nav-link" href=""><span>الرئيسية</span></a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link active" href="#"><span>الطلاب</span></a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#"><span>التقارير</span></a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#"><span>المزيد</span></a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#"><span> تسجيل الخروج </span></a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <img class="position-absolute top-0 end-0 d-sm-block d-md-block d-lg-none mx-4" height="40px" src="../../assets/images/logo.png">
        </div>
    </nav>
    <div class="landing">
        <div class="container text-center">
            <div class="row row-size shadow-lg p-3 mb-4 bg-body rounded">
                <div class="col responsive-sm border-start mt-5 pt-2">
                </div>
                <div class="col">
                    <h1>قائمة الطلاب</h1>
                    <div class="accordion" id="accordionExample">
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
                                <div class="container text-center">
                                <div class="row">
                                <div class="col">
                                    <span class="icon-reduis"><img class="icon-1" src="../../assets/images/messages.png"></span>
                                    <div class="my-3 animation"><i class="fa-solid fa-angles-left color-icon"></i><button data-bs-toggle="modal" data-bs-target="#exampleModal' . $s['u_id'] . '"> ارسال رسالة </button></div>
                                </div>
                                <div class="col">
                                <span class="icon-reduis"><img class="icon-1" src="../../assets/images/plan.png"></span>
                                <div class="my-3 animation"><i class="fa-solid fa-angles-left color-icon"></i><button>تفريغ خطة الطالب</button></div>
                                </div>
                                <div class="col">
                                <span class="icon-reduis"><img class="icon-1" src="../../assets/images/help.png"></span>
                                <div class="my-3 animation"><i class="fa-solid fa-angles-left color-icon"></i><button>  اقتراح مواد </button></div>
                                </div>
                                </div>
                            </div>
                                </div>
                            </div>
                            <div class="modal fade" id="exampleModal' . $s['u_id'] . '" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content">
                                    <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">إرسال بريد إلكتروني</h5>
                                    <button type="button"  class="btn-close position-absolute top-0 strar-0 my-3" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                <form  class="mail-form ">
                                    <div class="mb-3">
                                        <label for="recipient-name" class="col-form-label position-absolute top-0 start-0" style="margin-right: 20px;">المستلم</label>
                                        <input type="text" name="email" dir="rtl" disabled class="form-control mt-3" id="recipient-name" value="' . $s['email'] . '" placeholder="البريد الإلكتروني للمستلم">
                                    </div>
                                    <div class="mb-3">
                                        <label for="recipient-name" class="col-form-label" style="margin-left: 400px;">الموضوع</label>
                                        <input type="text" name="subject" dir="rtl" class="form-control" id="recipient-subject" placeholder="موضوع الرسالة">
                                    </div>
                                    <div class="mb-3">
                                        <label for="message-text" class="col-form-label" style="margin-left: 415px;">الرسالة</label>
                                        <textarea class="form-control" name="massage" dir="rtl" id="message-text" placeholder="نص الرسالة"></textarea>
                                    </div>
                                </form>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">إلغاء</button>
                                        <button type="button" class="btn btn-primary" data-email="' . $s['email'] . '">إرسال الرسالة</button>
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
    <script src="../../js/bootstrap.bundle.min.js"></script>
    <script src="../../js/all.min.js"></script>
</body>


<script>
    $(document).ready(function() {
        $('.accordion-header').on('click', function() {
            var u_id = $(this).data('u-id');

            $.ajax({
                type: "POST",
                url: "../../php/forms/getData/getstudentinfo.php",
                data: {
                    id: u_id
                },
                beforeSend: function() {
                    $('.col.border-start').html('<div class="d-flex justify-content-center"><div class="spinner-border" role="status"><span class="sr-only">Loading...</span></div></div>');
                },
                success: function(result) {
                    console.log(result);

                    try {
                        var data = JSON.parse(result);
                        if (data !== null && Object.keys(data).length > 0) {
                            // The data is not empty, so do something with it
                            $('.col.border-start').empty();
                            var table = $('<table>').addClass('table table-striped table-hover table-bordered').attr('dir', 'rtl');
                            var tbody = $('<tbody>').appendTo(table);

                            $('<tr>').append($('<th>').text('الحقل')).append($('<th>').text('القيمة')).appendTo(tbody);

                            $.each(data, function(key, value) {
                                if (key === 'u_id') {
                                    $('<tr>').append($('<td>').text('الرقم الجامعي')).append($('<td>').text(value)).appendTo(tbody);
                                } else if (key === 'ar_name') {
                                    $('<tr>').append($('<td>').text('الاسم بالعربي')).append($('<td>').text(value)).appendTo(tbody);
                                } else if (key === 'en_name') {
                                    $('<tr>').append($('<td>').text('الاسم بالإنجليزي')).append($('<td>').text(value)).appendTo(tbody);
                                } else if (key === 'college') {
                                    $('<tr>').append($('<td>').text('الكلية')).append($('<td>').text(value)).appendTo(tbody);
                                } else if (key === 'department') {
                                    $('<tr>').append($('<td>').text('القسم')).append($('<td>').text(value)).appendTo(tbody);
                                } else if (key === 'year') {
                                    $('<tr>').append($('<td>').text('العام الدراسي')).append($('<td>').text(value)).appendTo(tbody);
                                } else if (key === 'semester') {
                                    $('<tr>').append($('<td>').text('الفصل الدراسي')).append($('<td>').text(value)).appendTo(tbody);
                                } else if (key === 'u_year') {
                                    $('<tr>').append($('<td>').text('سنة الالتحاق بالجامعة')).append($('<td>').text(value)).appendTo(tbody);
                                }
                            });

                            $('.col.border-start').append($('<h2>').text('بيانات الطالب')).append(table);
                            var table = $('<table>').addClass('table table-striped table-hover table-bordered').attr('dir', 'rtl');
                            var tbody = $('<tbody>').appendTo(table);

                            $('<tr>').append($('<th>').text('الحقل')).append($('<th>').text('القيمة')).appendTo(tbody);

                            $.each(data, function(key, value) {
                                if (key === 'city') {
                                    $('<tr>').append($('<td>').text('المدينة')).append($('<td>').text(value)).appendTo(tbody);
                                } else if (key === 'region') {
                                    $('<tr>').append($('<td>').text('المنطقة')).append($('<td>').text(value)).appendTo(tbody);
                                } else if (key === 'phone_house') {
                                    $('<tr>').append($('<td>').text('رقم الهاتف الأرضي')).append($('<td>').text(value)).appendTo(tbody);
                                } else if (key === 'phone_person') {
                                    $('<tr>').append($('<td>').text('رقم الهاتف الشخصي')).append($('<td>').text(value)).appendTo(tbody);
                                } else if (key === 'email') {
                                    $('<tr>').append($('<td>').text('البريد الإلكتروني')).append($('<td>').text(value)).appendTo(tbody);
                                } else if (key === 'place_birth') {
                                    $('<tr>').append($('<td>').text('مكان الولادة')).append($('<td>').text(value)).appendTo(tbody);
                                } else if (key === 'birth_date') {
                                    $('<tr>').append($('<td>').text('تاريخ الولادة')).append($('<td>').text(value)).appendTo(tbody);
                                } else if (key === 'status') {
                                    $('<tr>').append($('<td>').text('الحالة الاجتماعية')).append($('<td>').text(value)).appendTo(tbody);
                                } else if (key === 'gender') {
                                    $('<tr>').append($('<td>').text('الجنس')).append($('<td>').text(value)).appendTo(tbody);
                                }
                            });

                            $('.col.border-start').append($('<h2>').text('البيانات الشخصية')).append(table);
                            var table = $('<table>').addClass('table table-striped table-hover table-bordered').attr('dir', 'rtl');
                            var tbody = $('<tbody>').appendTo(table);

                            $('<tr>').append($('<th>').text('الحقل')).append($('<th>').text('القيمة')).appendTo(tbody);

                            $.each(data, function(key, value) {
                                if (key === 'company_name') {
                                    $('<tr>').append($('<td>').text('اسم الشركة')).append($('<td>').text(value)).appendTo(tbody);
                                } else if (key === 'jop_name') {
                                    $('<tr>').append($('<td>').text('اسم الوظيفة')).append($('<td>').text(value)).appendTo(tbody);
                                } else if (key === 'experience_job') {
                                    $('<tr>').append($('<td>').text('خبرة الوظيفية')).append($('<td>').text(value)).appendTo(tbody);
                                } else if (key === 'certificate') {
                                    $('<tr>').append($('<td>').text('الشهادات')).append($('<td>').text(value)).appendTo(tbody);
                                } else if (key === 'activities') {
                                    $('<tr>').append($('<td>').text('الأنشطة الخارجية')).append($('<td>').text(value)).appendTo(tbody);
                                }
                            });

                            $('.col.border-start').append($('<h2>').text('خبرات العمل السابقة')).append(table);
                            // ... the rest of the code to display the table goes here
                        } else {
                            // The data is empty, so show a message to the user or do nothing
                            $('.col.border-start').text('No data found');
                        }
                        // Code to display the table goes here
                    } catch (error) {
                        $('.col.border-start').html('<div class="justify-content-center"><h3> لم يقم الطالب بتعبئة بياناته بعد </h3><br><h3>أخطر الطالب برسالة</h3></div>');
                    }
                    // if (data == null) {
                    //     $('.col.border-start').html('<div class="d-flex justify-content-center"><h3>لا يوجد بيانات</h3></div>');
                    // } else {
                    //     $('.col.border-start').empty();
                    //     var table = $('<table>').addClass('table table-striped table-hover table-bordered').attr('dir', 'rtl');
                    //     var tbody = $('<tbody>').appendTo(table);

                    //     $('<tr>').append($('<th>').text('الحقل')).append($('<th>').text('القيمة')).appendTo(tbody);

                    //     $.each(data, function(key, value) {
                    //         if (key === 'u_id') {
                    //             $('<tr>').append($('<td>').text('الرقم الجامعي')).append($('<td>').text(value)).appendTo(tbody);
                    //         } else if (key === 'ar_name') {
                    //             $('<tr>').append($('<td>').text('الاسم بالعربي')).append($('<td>').text(value)).appendTo(tbody);
                    //         } else if (key === 'en_name') {
                    //             $('<tr>').append($('<td>').text('الاسم بالإنجليزي')).append($('<td>').text(value)).appendTo(tbody);
                    //         } else if (key === 'college') {
                    //             $('<tr>').append($('<td>').text('الكلية')).append($('<td>').text(value)).appendTo(tbody);
                    //         } else if (key === 'department') {
                    //             $('<tr>').append($('<td>').text('القسم')).append($('<td>').text(value)).appendTo(tbody);
                    //         } else if (key === 'year') {
                    //             $('<tr>').append($('<td>').text('العام الدراسي')).append($('<td>').text(value)).appendTo(tbody);
                    //         } else if (key === 'semester') {
                    //             $('<tr>').append($('<td>').text('الفصل الدراسي')).append($('<td>').text(value)).appendTo(tbody);
                    //         } else if (key === 'u_year') {
                    //             $('<tr>').append($('<td>').text('سنة الالتحاق بالجامعة')).append($('<td>').text(value)).appendTo(tbody);
                    //         }
                    //     });

                    //     $('.col.border-start').append($('<h2>').text('بيانات الطالب')).append(table);
                    //     var table = $('<table>').addClass('table table-striped table-hover table-bordered').attr('dir', 'rtl');
                    //     var tbody = $('<tbody>').appendTo(table);

                    //     $('<tr>').append($('<th>').text('الحقل')).append($('<th>').text('القيمة')).appendTo(tbody);

                    //     $.each(data, function(key, value) {
                    //         if (key === 'city') {
                    //             $('<tr>').append($('<td>').text('المدينة')).append($('<td>').text(value)).appendTo(tbody);
                    //         } else if (key === 'region') {
                    //             $('<tr>').append($('<td>').text('المنطقة')).append($('<td>').text(value)).appendTo(tbody);
                    //         } else if (key === 'phone_house') {
                    //             $('<tr>').append($('<td>').text('رقم الهاتف الأرضي')).append($('<td>').text(value)).appendTo(tbody);
                    //         } else if (key === 'phone_person') {
                    //             $('<tr>').append($('<td>').text('رقم الهاتف الشخصي')).append($('<td>').text(value)).appendTo(tbody);
                    //         } else if (key === 'email') {
                    //             $('<tr>').append($('<td>').text('البريد الإلكتروني')).append($('<td>').text(value)).appendTo(tbody);
                    //         } else if (key === 'place_birth') {
                    //             $('<tr>').append($('<td>').text('مكان الولادة')).append($('<td>').text(value)).appendTo(tbody);
                    //         } else if (key === 'birth_date') {
                    //             $('<tr>').append($('<td>').text('تاريخ الولادة')).append($('<td>').text(value)).appendTo(tbody);
                    //         } else if (key === 'status') {
                    //             $('<tr>').append($('<td>').text('الحالة الاجتماعية')).append($('<td>').text(value)).appendTo(tbody);
                    //         } else if (key === 'gender') {
                    //             $('<tr>').append($('<td>').text('الجنس')).append($('<td>').text(value)).appendTo(tbody);
                    //         }
                    //     });

                    //     $('.col.border-start').append($('<h2>').text('البيانات الشخصية')).append(table);
                    //     var table = $('<table>').addClass('table table-striped table-hover table-bordered').attr('dir', 'rtl');
                    //     var tbody = $('<tbody>').appendTo(table);

                    //     $('<tr>').append($('<th>').text('الحقل')).append($('<th>').text('القيمة')).appendTo(tbody);

                    //     $.each(data, function(key, value) {
                    //         if (key === 'company_name') {
                    //             $('<tr>').append($('<td>').text('اسم الشركة')).append($('<td>').text(value)).appendTo(tbody);
                    //         } else if (key === 'jop_name') {
                    //             $('<tr>').append($('<td>').text('اسم الوظيفة')).append($('<td>').text(value)).appendTo(tbody);
                    //         } else if (key === 'experience_job') {
                    //             $('<tr>').append($('<td>').text('خبرة الوظيفية')).append($('<td>').text(value)).appendTo(tbody);
                    //         } else if (key === 'certificate') {
                    //             $('<tr>').append($('<td>').text('الشهادات')).append($('<td>').text(value)).appendTo(tbody);
                    //         } else if (key === 'activities') {
                    //             $('<tr>').append($('<td>').text('الأنشطة الخارجية')).append($('<td>').text(value)).appendTo(tbody);
                    //         }
                    //     });

                    //     $('.col.border-start').append($('<h2>').text('خبرات العمل السابقة')).append(table);
                    //     ss
                    // }


                },
                error: function(xhr, status, error) {
                    console.log(xhr.responseText);
                }
            });
        });
    });
</script>
<script>
    $(document).ready(function() {
        $(document).on('click', '.btn-primary', function() {
            var email = $(this).data('email');
            var formData = $(this).closest('.modal-content').find('.mail-form').serialize();
            formData += '&recipient=' + email;
            var $modalContent = $(this).closest('.modal-content'); // Store the reference to this
            console.log($modalContent.find('.mail-form'));

            $.ajax({
                type: "POST",
                url: "../../php/forms/sendmail.php",
                data: formData,
                success: function(response) {
                    console.log(response);
                    if (response == "success") {
                        // Reset the form after sending the email
                        $modalContent.find('.mail-form')[0].reset(); // Use the variable here
                        Swal.fire({
                            position: "center",
                            icon: "success",
                            title: "تم ارسال الرسالة بنجاح",

                            showConfirmButton: false,
                            timer: 1500,


                        });
                    } else {
                        $modalContent.find('.mail-form')[0].reset(); // 
                        Swal.fire({
                            position: "center",
                            icon: "error",
                            title: "حدث خطأ ما",

                            showConfirmButton: false,
                            timer: 1500,
                        });

                    }
                },
                error: function(xhr, status, error) {
                    alert("Error sending email");
                }
            });
        });
    });
</script>

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