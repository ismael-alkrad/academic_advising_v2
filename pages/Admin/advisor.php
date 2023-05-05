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
    <title>Student</title>
    <link rel="shortcut icon" href="../../assets/images/logo.png">
    <link rel="stylesheet" href="../../css/bootstrap.rtl.min.css">
    <link rel="stylesheet" href="../../css/all.min.css">
    <link rel="stylesheet" href="../../css/Admin/advisor.css?v=<?php echo time(); ?>">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@200;300;400;500&display=swap" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body>
    <?php echo generateNavbar($links = array(

        array("label" => "الرئيسية", "url" => "#")
    ), "مدير الموقع"); ?>
    <div class="landing">
        <div class="container text-center">
            <div class="row row-size shadow-lg p-3 mb-4 bg-body rounded">
                <div class="col responsive-sm border-start mt-5 pt-2">
                </div>
                <div class="col">
                    <h1>قائمة المرشدين</h1>
                    <div class="accordion" id="accordionExample">
                        <div class="accordion-item">
                            <?php
                            $student = getAdvisors($conn);
                            // echo "<pre>";
                            // print_r($student);
                            // echo "</pre>";
                            if ($student != null) {
                                foreach ($student as $s) {
                                    $to = $s['email'];
                                    echo '<h2 class="accordion-header" id="heading' . $s['username'] . '" data-username="' . $s['username'] . '">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#collapse' . $s['username'] . '"  aria-expanded="false" aria-controls="collapse' . $s['username'] . '" data-username="' . $s['username'] . '">
                                    ' . $s['fname'] . '
                                </button>
                            </h2>
                            <div id="collapse' . $s['username'] . '" class="accordion-collapse collapse" aria-labelledby="heading' . $s['username'] . '"
                                data-bs-parent="#accordionExample">
                                <div class="accordion-body px-3">
                                    <div class="container text-center">
                                        <div class="row">
                                            <div class="col">
                                                <span class="icon-reduis-message"><button data-bs-toggle="modal" data-bs-target="#exampleModal' . $s['username'] . '"><img class="icon-1" src="../../assets/images/chat.png"></button></span>
                                                <div class="my-3 animation"><i class="fa-solid fa-angles-left color-icon"></i><button data-bs-toggle="modal" data-bs-target="#exampleModal' . $s['username'] . '"> ارسال رسالة </button></div>
                                            </div>
                                            <div class="col">
                                                <span class="icon-reduis-printer"><button onclick="printTable()"><img class="icon-1" src="../../assets/images/printer.png"></button></span>
                                                <div class="my-3 animation"><i class="fa-solid fa-angles-left color-icon"></i><button onclick="printTable()"> طباعة </button></div>
                                            </div>
                                            <div class="col">
                                                <span class="icon-reduis-add"><a href="users.php?user=' . $s['username'] . '"><button><img class="icon-1" src="../../assets/images/add-user.png"></button></span>
                                                <div class="my-3 animation"><i class="fa-solid fa-angles-left color-icon"></i></a><a href="users.php?user=' . $s['username'] . '"> اضافة </a></div>
                                            </div> 
                                            <div class="col">
                                                <span class="icon-reduis-delete"><a href="users.php?user=' . $s['username'] . '"><button><img class="icon-1" src="../../assets/images/add-user.png"></button></span>
                                                <div class="my-3 animation"><i class="fa-solid fa-angles-left color-icon"></i></a><a href="users.php?user=' . $s['username'] . '"> حذف </a></div>
                                            </div> 
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <!-- --------------------------------------------------Modal Send Message---------------------------------------------------------------------- -->
                            
                        <div class="modal fade" id="exampleModal' . $s['username'] . '" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
    function printTable() {
        var contentsToPrint = $('.col.border-start').html();
        var printWindow = window.open('', 'PrintWindow');
        printWindow.document.write('<html><head><title>Print</title></head><body>' + contentsToPrint + '</body></html>');
        printWindow.document.close();
        printWindow.focus();
        printWindow.print();
        printWindow.close();
    }
</script>
<script>
    $(document).ready(function() {
        $('.accordion-header').on('click', function() {
            var username = $(this).data('username');

            $.ajax({
                type: "POST",
                url: "../../php/forms/getData/get_student_by_advisor.php",
                data: {
                    id: username
                },
                beforeSend: function() {
                    $('.col.border-start').html(
                        '<div class="d-flex justify-content-center"><div class="spinner-border" role="status"><span class="sr-only">Loading...</span></div></div>'
                    );
                },
                success: function(result) {
                    console.log(result);

                    try {
                        var data = JSON.parse(result);
                        if (data !== null && data.length > 0) {
                            // The data is not empty, so do something with it
                            $('.col.border-start').empty();
                            var table = $('<table>').addClass(
                                'table table-striped table-hover table-bordered').attr(
                                'dir', 'rtl');
                            var tbody = $('<tbody>').appendTo(table);

                            $('<tr>').append($('<th>').text('الرقم الجامعي')).append($('<th>')
                                    .text('الاسم')).append($('<th>').text('البريد الإلكتروني'))
                                .appendTo(tbody);

                            $.each(data, function(index, value) {
                                $('<tr>').append($('<td>').text(value.u_id)).append($(
                                    '<td>').text(value.name)).append($('<td>').text(
                                    value.email)).appendTo(tbody);
                            });

                            $('.col.border-start').append($('<h2>').text('بيانات الطلاب'))
                                .append(table);
                        } else {
                            // The data is empty, so show a message to the user or do nothing
                            $('.col.border-start').text('No data found');
                        }
                    } catch (error) {
                        $('.col.border-start').html(
                            '<div class="justify-content-center"><h3> لم يقم الطالب بتعبئة بياناته بعد </h3><br><h3>أخطر الطالب برسالة</h3></div>'
                        );
                    }

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
            var emailEditor = $(this).data('email');
            var formData = $(this).closest('.modal-content').find('.mail-form').serialize();
            formData += '&recipient=' + emailEditor;
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
                            allowOutsideClick: false,
                            timer: 1500,
                        });
                    } else {
                        $modalContent.find('.mail-form')[0].reset(); // 
                        Swal.fire({
                            position: "center",
                            icon: "error",
                            title: "حدث خطأ ما",
                            showConfirmButton: false,
                            allowOutsideClick: false,
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