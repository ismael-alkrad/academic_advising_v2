<?php
include_once '../../../php/check.php';

include '../../../php/navbar.php';
check_activity();

check(text: "Location: ../../../index.php");

$id = $_SESSION['username'];
$data = getStudentById($conn, $id);

echo "</pre>";
?>

<!DOCTYPE html>


<html lang="ar">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Gifted Students</title>
    <link rel="shortcut icon" href="../../../assets/images/logo.png">
    <link rel="stylesheet" href="../../../css/bootstrap.rtl.min.css" />
    <link rel="stylesheet" href="../../../css/all.min.css" />
    <link rel="stylesheet" href="../../../css/Student/Forms/gifted-students.css?v=<?php echo time(); ?>" />
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@200;300;400;500&display=swap" rel="stylesheet" />
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body>
    <?php echo generateNavbar($links = array(

        array("label" => "الرئيسية", "url" => "../student.php")
    ), "طالب", $logo = "../../../assets/images/logo.png"); ?>
    <div class="landing" dir="rtl">
        <div class="container shadow-lg p-3 mb-5 bg-body rounded">
            <table class="table table-bordered">
                <tbody>
                    <tr>
                        <th scope="row">الاسم الرباعي</th>
                        <td><?php echo $data['name']; ?></td>
                    </tr>
                    <tr>
                        <th scope="row">رقم الهاتف </th>
                        <td>0791570296</td>
                    </tr>
                    <tr>
                        <th scope="row">البريد الالكتروني</th>
                        <td><?php echo $data['email']; ?></td>
                    </tr>
                </tbody>
            </table>
            <form action="" id="myForm">
                <div class="div mt-5">
                    <h4>نرجو منكم تحديد الموهبة التي تتمتعون بها.</h4>
                    <div class="row">
                        <div class="col">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="الخرائط" name="maps">
                                <label class="form-check-label" for="maps">
                                    الخرائط
                                </label>
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="الباليه" name="ballet">
                                <label class="form-check-label" for="ballet">
                                    الباليه
                                </label>
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="الخداع البصري" name="optical-illusion">
                                <label class="form-check-label" for="optical-illusion">
                                    الخداع البصري
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="الشعر" name="Poetry">
                                <label class="form-check-label" for="Poetry">
                                    الشعر
                                </label>
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="الخزف" name="porcelain">
                                <label class="form-check-label" for="porcelain">
                                    الخزف
                                </label>
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="تقليد شخصيات" name="tradition">
                                <label class="form-check-label" for="tradition">
                                    تقليد شخصيات
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="النحت" name="sculpture">
                                <label class="form-check-label" for="sculpture">
                                    النحت
                                </label>
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="التمثيل" name="impersonation">
                                <label class="form-check-label" for="impersonation">
                                    التمثيل
                                </label>
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="الرسم على الرمال" name="Drawing-sand">
                                <label class="form-check-label" for="Drawing-sand">
                                    الرسم على الرمال
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="الرسم" name="Drawing">
                                <label class="form-check-label" for="Drawing">
                                    الرسم
                                </label>
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="التأليف" name="authorship">
                                <label class="form-check-label" for="authorship">
                                    التأليف
                                </label>
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="الأفلام التعليمية" name="Educational-films">
                                <label class="form-check-label" for="Educational-films">
                                    الأفلام التعليمية
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="العزف" name="fiddle">
                                <label class="form-check-label" for="fiddle">
                                    العزف
                                </label>
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="الخطابة" name="oratory">
                                <label class="form-check-label" for="oratory">
                                    الخطابة
                                </label>
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="التصوير الفوتوغرافي" name="photographer">
                                <label class="form-check-label" for="photographer">
                                    التصوير الفوتوغرافي
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="الغناء" name="singing">
                                <label class="form-check-label" for="singing">
                                    الغناء
                                </label>
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="كرة اليد" name="handball">
                                <label class="form-check-label" for="handball">
                                    كرة اليد
                                </label>
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="التصميم الجرافيكي" name="graphic-design">
                                <label class="form-check-label" for="graphic-design">
                                    التصميم الجرافيكي
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="المسرح" name="theater">
                                <label class="form-check-label" for="theater">
                                    المسرح
                                </label>
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="كرة السلة" name="basketball">
                                <label class="form-check-label" for="basketball">
                                    كرة السلة
                                </label>
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="تصميم العاب الفيديو" name="Video-game-design">
                                <label class="form-check-label" for="Video-game-design">
                                    تصميم العاب الفيديو
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="التطريز" name="embroidery">
                                <label class="form-check-label" for="embroidery">
                                    التطريز
                                </label>
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="كرة القدم" name="football">
                                <label class="form-check-label" for="football">
                                    كرة القدم
                                </label>
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="تصميم الوسائل التعليمية" name="Teaching-aids-design">
                                <label class="form-check-label" for="Teaching-aids-design">
                                    تصميم الوسائل التعليمية
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="الصحافة" name="Journalism">
                                <label class="form-check-label" for="Journalism">
                                    الصحافة
                                </label>
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="عمل المجلات" name="Making-magazines">
                                <label class="form-check-label" for="Making-magazines">
                                    عمل المجلات
                                </label>
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="الأفلام السينمائية القصيرة" name="Short-films">
                                <label class="form-check-label" for="Short-films">
                                    الأفلام السينمائية القصيرة
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="الشطرنج" name="chess">
                                <label class="form-check-label" for="chess">
                                    الشطرنج
                                </label>
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="عمل المطويات" name="Making-leaflets">
                                <label class="form-check-label" for="Making-leaflets">
                                    عمل المطويات
                                </label>
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="فنون القتال والدفاع عن النفس" name="self-defense">
                                <label class="form-check-label" for="self-defense">
                                    فنون القتال والدفاع عن النفس
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
                <div>
                    <div class="col" id="inputContainer_expereance">
                        <label class="form-label text-start">
                            في حال وجود موهبة غير مدرجة يرجى ذكرها ..
                        </label>
                        <div class="input-group mb-3">
                            <span class="input-group-text" id="basic-addon1">1</span>
                            <input name="inputexpereance_jop" type="text" class="form-control" placeholder="Practical experiences" aria-label="Practical experiences" aria-describedby="basic-addon1" name="experience_job1" />
                        </div>
                    </div>

                </div>
                <input type="hidden" id="advisor" name="advisor" value="<?php echo $data['advisor'] ?>">

                <!-- <div class="mt-3" id="upload-fields">
                    <label class="form-label text-start">
                        كما نرجو تزويدنا بما تتمتعون به من مواهب وأعمال ابداعية موثقة بالصور أو الفيديوهات أو الشهادات
                    </label>
                    <div class="input-group mb-3">
                        <input type="file" class="form-control" id="file-upload" accept="image/png, image/jpeg, video/mp4">
                    </div>
                </div> -->
                <div class="save-responsive d-flex justify-content-center mt-4">
                    <button id="save" type="submit" class="button-style fs-6 d-flex justify-content-center align-items-center text-center" style="color: #ffffff;  margin-bottom: 20px;">
                        حفظ
                        <i class="fa-solid fa-floppy-disk ps-1" style="color: #ffffff;"></i>
                    </button>
                </div>
            </form>

        </div>
    </div>

    <script src="../../../js/bootstrap.bundle.min.js"></script>
    <script src="../../../js/all.min.js"></script>
</body>

<script>
    $(document).ready(function() {
        $('#myForm').submit(function(e) {
            e.preventDefault(); // prevent the default form submit behavior
            var formData = $(this).serialize(); // get the form data as a string
            console.log(formData.split('&'));
            $.ajax({
                url: '../../../php/forms/inserts/talentStudent.php', // the URL of the PHP script that will process the data
                type: 'POST',
                data: formData,
                success: function(response) {
                    console.log(response);
                    // handle the response from the server
                    if (response === "success") {
                        Swal.fire({
                            title: 'تمت العملية',
                            text: "تم الحفظ بنجاح ",
                            icon: 'success',
                            allowOutsideClick: false,
                            confirmButtonText: 'OK'
                        });
                        setTimeout(function() {
                            window.location.href = "../student.php";


                        }, 500);

                    } else {

                        Swal.fire({
                            title: 'فشلت العملية',
                            text: "حدث خطأ أثناء الحفظ ",

                            icon: 'error',
                            allowOutsideClick: false,
                            confirmButtonText: 'OK'
                        });

                    }
                },


                error: function(jqXHR, textStatus, errorThrown) {
                    // handle any errors that occur during the AJAX request
                    console.error(errorThrown);
                }
            });
        });
    });
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

</html>