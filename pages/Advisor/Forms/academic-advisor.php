<?php
include_once '../../../php/check.php';
include '../../../php/navbar.php';
check(text: "Location: ../../../index.php");
check_activity();
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
    <link rel="stylesheet" href="../../../css/Advisor/Forms/academic-advisor.css?v=<?php echo time(); ?>">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@200;300;400;500&display=swap" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body>
    <?php echo generateNavbar($links = array(
        array("label" => "الرئيسية", "url" => "../home.php")
    ), "مرشد", $logo = "../../../assets/images/logo.png"); ?>
    <div class="landing">
        <div class="container text-center">
            <div class="row shadow-lg p-3 mb-4 bg-body rounded">
                <div class="row">
                    <div class="col">
                        <div class="ahmad"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <input type="hidden" id="student" name="" value="<?php echo $_GET['student'] ?>">

    <script src="../../../js/bootstrap.bundle.min.js"></script>
    <script src="../../../js/all.min.js"></script>
</body>

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
<script>
    $(document).ready(function() {
        var u_id = $("#student").val();
        console.log(u_id);
        $.ajax({
            type: "POST",
            url: "../../../php/forms/getData/getstudentinfo.php",
            data: {
                id: u_id
            },
            beforeSend: function() {
                $('.ahmad').html('<div class="d-flex justify-content-center"><div class="spinner-border" role="status"><span class="sr-only">Loading...</span></div></div>');
            },
            success: function(result) {
                console.log(result);

                try {
                    var data = JSON.parse(result);
                    if (data !== null && Object.keys(data).length > 0) {
                        console.log(
                            "ajaj"
                        );
                        // The data is not empty, so do something with it
                        $('.ahmad').empty();
                        var img = $('<img>').attr('src', "../" + data.filepath).addClass('mx-auto d-block mt-4 mb-4').addClass('photo rounded-circle');
                        $('.ahmad').append(img);
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

                        $('.ahmad').append($('<h2>').text('بيانات الطالب')).append(table);
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

                        $('.ahmad').append($('<h2>').text('البيانات الشخصية')).append(table);
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

                        $('.ahmad').append($('<h2>').text('خبرات العمل السابقة')).append(table);
                        // ... the rest of the code to display the table goes here
                    } else {
                        // The data is empty, so show a message to the user or do nothing
                        $('.ahmad').text('No data found');
                    }
                    // Code to display the table goes here
                } catch (error) {
                    $('.ahmad').html('<div class="justify-content-center"><h3> لم يقم الطالب بتعبئة بياناته بعد </h3><br><h3>أخطر الطالب برسالة</h3></div>');
                }


            },
            error: function(xhr, status, error) {
                console.log(xhr.responseText);
            }
        });
    });
</script>

</script>