<?php
include_once '../../../php/check.php';
include '../../../php/navbar.php';
check_activity();

check(text: "Location: ../../../index.php");

// Get the data and the a_username value
$result = getSuggestedCourses($conn, $_SESSION['username']);
$data = $result;

?>
<!DOCTYPE html>
<html lang="en">


<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Suggesting Course</title>
    <link rel="shortcut icon" href="../../../assets/images/logo.png">
    <link rel="stylesheet" href="../../../css/bootstrap.rtl.min.css">
    <link rel="stylesheet" href="../../../css/all.min.css">
    <link rel="stylesheet" href="../../../css/Student/Forms/suggesting-Course.css?v=<?php echo time(); ?>">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@200;300;400;500&display=swap" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.11/cropper.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.11/cropper.min.css" />
</head>

<body>
    <?php echo generateNavbar($links = array(

        array("label" => "الرئيسية", "url" => "../")
    ), "طالب", $logo = "../../../assets/images/logo.png"); ?>
    <div class="landing" dir="rtl">
        <div class="container shadow-lg p-3 mb-5 bg-body rounded text-center">
            <h2 class="text-center text-primary my-4">جدول المقترحات</h2>
            <div class="table-responsive">
                <table class="table table-striped table-hover table-bordered" dir="rtl">
                    <thead dir="rtl" class="bg-primary text-white">
                        <tr>
                            <th>الاسم</th>
                            <th>الرقم</th>
                            <th>القسم</th>
                            <th>الوقت</th>
                            <th>النوع</th>
                            <th>تمت الإقتراح بواسطة</th>
                        </tr>
                    </thead>
                    <tbody dir="rtl">
                        <?php foreach ($data as $row) : ?>
                            <tr>
                                <td><?php echo $row['name']; ?></td>
                                <td><?php echo $row['number']; ?></td>
                                <td><?php echo $row['section']; ?></td>
                                <td><?php echo $row['time']; ?></td>
                                <td><?php echo $row['type']; ?></td>
                                <td><?php echo "الدكتور : " . getFnameByUid($conn, $row['a_username']);  ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div><!----------------------------------------- start  Log out ------------------------------------>
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
    <!----------------------------------------- End  Log out ------------------------------------>



    <script src="../../../js/bootstrap.bundle.min.js"></script>
    <script src="../../../js/all.min.js"></script>
</body>

</html>