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
    <link rel="stylesheet" href="../../css/bootstrap.rtl.min.css">
    <link rel="stylesheet" href="../../css/all.min.css">
    <link rel="stylesheet" href="../../css/student.css?v=<?php echo time(); ?>">
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
                        <ul class="navbar-nav position-absolute top-0 start-0 pt-3 mt-5 mx-4 d-sm-block d-md-block d-lg-none">
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
                        </ul>
                    </div>
                </div>
            </div>
            <img class="position-absolute top-0 end-0 d-sm-block d-md-block d-lg-none mx-4" height="45px" src="../../assets/images/logo.png">
        </div>
    </nav>
    <div class="landing">
        <div class="container text-center">
            <div class="row row-size shadow-lg p-3 mb-4 bg-body rounded">
                <div class="col border-start ms-5">

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
                                    <h5 class="modal-title" style="margin-left:300px;" id="exampleModalLabel">إرسال بريد إلكتروني</h5>
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
            // console.log('u_id:', u_id);
            // var $content = $('.col.border-start.ms-5');
            // $content.html('New content for u_id ' + u_id + ' goes here');

            $.ajax({
                type: "Post",
                url: "../../php/forms/getdata.php",
                data: {
                    id: u_id
                },

                beforeSend: function() {
                    $('.col.border-start.ms-5').html('<div class="spinner-border text-primary" role="status"><span class="visually-hidden">Loading...</span></div>');
                },
                complete: function() {

                },

                success: function(result) {
                    var data = JSON.parse(result);
                    $('.col.border-start.ms-5').empty();

                    // Create the table
                    var table = $('<table>').addClass('table table-striped table-hover table-bordered text-right').attr('dir', 'rtl');
                    var tbody = $('<tbody>').appendTo(table);

                    // Add rows for each field
                    $.each(data, function(key, value) {
                        if (key === 'id') {
                            $('<tr>').append($('<td>').text('رقم الطالب')).append($('<td>').text(value)).appendTo(tbody);
                        } else if (key === 'u_id') {
                            $('<tr>').append($('<td>').text('الرقم الجامعي')).append($('<td>').text(value)).appendTo(tbody);
                        } else if (key === 'name') {
                            $('<tr>').append($('<td>').text('الاسم')).append($('<td>').text(value)).appendTo(tbody);
                        } else if (key === 'email') {
                            $('<tr>').append($('<td>').text('البريد الإلكتروني')).append($('<td>').text(value)).appendTo(tbody);
                        } else if (key === 'phone') {
                            $('<tr>').append($('<td>').text('رقم الهاتف')).append($('<td>').text(value)).appendTo(tbody);
                        } else if (key === 'department') {
                            $('<tr>').append($('<td>').text('القسم')).append($('<td>').text(value)).appendTo(tbody);
                        } else if (key === 'major') {
                            $('<tr>').append($('<td>').text('التخصص')).append($('<td>').text(value)).appendTo(tbody);
                        } else if (key === 'advisor') {
                            $('<tr>').append($('<td>').text('المشرف الأكاديمي')).append($('<td>').text(value)).appendTo(tbody);
                        }
                    });

                    // Add the table to the DOM
                    $('.col.border-start.ms-5').append(table);
                },

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