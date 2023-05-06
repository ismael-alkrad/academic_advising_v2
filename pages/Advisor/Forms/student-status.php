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
    <title>Student Status</title>
    <link rel="shortcut icon" href="../../../assets/images/logo.png">
    <link rel="stylesheet" href="../../../css/bootstrap.rtl.min.css">
    <link rel="stylesheet" href="../../../css/all.min.css">
    <link rel="stylesheet" href="../../../css/Advisor/Forms/student-status.css?v=<?php echo time(); ?>">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@200;300;400;500&display=swap" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body>
    <?php echo generateNavbar($links = array(
        array("label" => "التقارير الطلابية", "url" => "#"),
        array("label" => "الرئيسية", "url" => "../home.php")
    ), "مرشد", $logo = "../../../assets/images/logo.png"); ?>
    <div class="landing">
        <div class="container shadow-lg p-3 mb-4 bg-body rounded" dir="rtl">
            <h2> نموذج تحويل حالة الطالب </h2>
            <form>
                <input type="hidden" id="student" name="student" value="<?php echo $_GET['student'] ?>">
                <div class="row">
                    <div class="col">
                        <label> نوع المشكلة : </label>
                    </div>
                    <div class="col">
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="type" id="flexRadioDefault1">
                            <label class="form-check-label" for="flexRadioDefault1">
                                نفسية
                            </label>
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="type" id="flexRadioDefault2">
                            <label class="form-check-label" for="flexRadioDefault2">
                                أكاديمية
                            </label>
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="type" id="flexRadioDefault3">
                            <label class="form-check-label" for="flexRadioDefault3">
                                سلوكية
                            </label>
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="type" id="flexRadioDefault4">
                            <label class="form-check-label" for="flexRadioDefault4">
                                اجتماعية
                            </label>
                        </div>
                    </div>
                </div>

                <div class="row mt-3">
                    <label> الموضوع : </label>
                    <div class="col mt-2">
                        <input class="form-control" type="text" name="subject" placeholder="اكتب هنا الموضوع المراد التحدث عنه بإيجاز" aria-label="default input example" maxlength="500">
                    </div>
                </div>

                <div class="row mt-3">
                    <label> الإجراءات الإرشادية التي اتخذتها الكلية : </label>
                    <div class="col mt-2 form-floating">
                        <textarea class="form-control" name="actions" placeholder="Leave a comment here" id="floatingTextarea" maxlength="2000"></textarea>
                        <label class="ms-3" for="floatingTextarea">الإجراءات</label>
                    </div>
                </div>

                <div class="row mt-3">
                    <label> ملاحظات : </label>
                    <div class="col mt-2 form-floating">
                        <textarea class="form-control" name="notes" placeholder="اكتب هنا الملاحظات" id="floatingTextarea" maxlength="2000"></textarea>
                        <label class="ms-3" for="floatingTextarea"> اكتب هنا الملاحظات </label>
                    </div>
                </div>
            </form>
            <div class="save-responsive d-flex justify-content-center">
                <button id="save" class="button-style fs-6 d-flex justify-content-center align-items-center text-center" style="color: #ffffff;  margin-top: 20px;">
                    حفظ
                    <i class="fa-solid fa-floppy-disk ps-1" style="color: #ffffff;"></i>
                </button>
            </div>
        </div>
    </div>

    <script src="../../../js/bootstrap.bundle.min.js"></script>
    <script src="../../../js/all.min.js"></script>
    <script>
        $(document).ready(function() {
            $("#save").click(function() {
                // Get the form data
                var student = $("#student").val();
                var type = $("input[name='type']:checked").val();
                var subject = $("input[name='subject']").val();
                var actions = $("textarea[name='actions']").val();
                var notes = $("textarea[name='notes']").val();

                // Send the form data using AJAX
                $.ajax({
                    type: "POST",
                    url: "../../../php/forms/insert_student_state.php",
                    data: {
                        student: student,
                        type: type,
                        subject: subject,
                        actions: actions,
                        notes: notes
                    },
                    success: function(response) {
                        console.log(response);
                        if (response === 'success') {
                            Swal.fire({
                                position: "center",
                                icon: "success",
                                title: "تم حفظ اللقاء بنجاح",
                                showConfirmButton: false,
                                allowOutsideClick: false,
                                timer: 1500,
                            });
                            setTimeout(function() {
                                window.location.href = "../report.php";


                            }, 500);



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
                    },
                });
            });
        });
    </script>
</body>