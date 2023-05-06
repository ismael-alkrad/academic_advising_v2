<?php
include_once '../../../php/check.php';

include '../../../php/navbar.php';

check();

check_activity();
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
    <link rel="stylesheet" href="../../../css/Student/Forms/academic-failure.css?v=<?php echo time(); ?>" />
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
                        <th scope="row">الاسم</th>
                        <td>Mark</td>
                    </tr>
                    <tr>
                        <th scope="row">الرقم الجامعي</th>
                        <td>Jacob</td>
                    </tr>
                    <tr>
                        <th scope="row"> الفصل الدراسي / العام الجامعي للطالب </th>
                        <td>Larry the Bird</td>
                    </tr>
                    <tr>
                        <th scope="row"> المعدل التراكمي </th>
                        <td>Jacob</td>
                    </tr>
                </tbody>
            </table>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th scope="col">العبارات</th>
                        <th scope="col" class="text-center">موافق</th>
                        <th scope="col" class="text-center">غير موافق</th>
                        <th scope="col" class="text-center">لا أعرف</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <th scope="row">صعوبة المواد الدراسية</th>
                        <td><input class="form-check-input" type="radio" name="type-1" id="radio-agree-1"></td>
                        <td><input class="form-check-input" type="radio" name="type-1" id="radio-notAgree-1"></td>
                        <td><input class="form-check-input" type="radio" name="type-1" id="radio-notKnow-1"></td>
                    </tr>
                    <tr>
                        <th scope="row">الغياب المتكرر عن المحاضرات</th>
                        <td><input class="form-check-input" type="radio" name="type-2" id="radio-agree-2"></td>
                        <td><input class="form-check-input" type="radio" name="type-2" id="radio-notAgree-2"></td>
                        <td><input class="form-check-input" type="radio" name="type-2" id="radio-notKnow-2"></td>
                    </tr>
                    <tr>
                        <th scope="row">عدم مناسبة أساليب التدريس</th>
                        <td><input class="form-check-input" type="radio" name="type-3" id="radio-agree-3"></td>
                        <td><input class="form-check-input" type="radio" name="type-3" id="radio-notAgree-3"></td>
                        <td><input class="form-check-input" type="radio" name="type-3" id="radio-notKnow-3"></td>
                    </tr>
                    <tr>
                        <th scope="row"> التوتر والخوف من الامتحانات </th>
                        <td><input class="form-check-input" type="radio" name="type-4" id="radio-agree-4"></td>
                        <td><input class="form-check-input" type="radio" name="type-4" id="radio-notAgree-4"></td>
                        <td><input class="form-check-input" type="radio" name="type-4" id="radio-notKnow-4"></td>
                    </tr>
                    <tr>
                        <th scope="row"> مشاكل أسرية </th>
                        <td><input class="form-check-input" type="radio" name="type-5" id="radio-agree-5"></td>
                        <td><input class="form-check-input" type="radio" name="type-5" id="radio-notAgree-5"></td>
                        <td><input class="form-check-input" type="radio" name="type-5" id="radio-notKnow-5"></td>
                    </tr>
                    <tr>
                        <th scope="row"> عدم التأقلم مع البيئة الجامعية </th>
                        <td><input class="form-check-input" type="radio" name="type-6" id="radio-agree-6"></td>
                        <td><input class="form-check-input" type="radio" name="type-6" id="radio-notAgree-6"></td>
                        <td><input class="form-check-input" type="radio" name="type-6" id="radio-notKnow-6"></td>
                    </tr>
                    <tr>
                        <th scope="row"> عدد الساعات المسجلة في الفصل الدراسي عال </th>
                        <td><input class="form-check-input" type="radio" name="type-7" id="radio-agree-7"></td>
                        <td><input class="form-check-input" type="radio" name="type-7" id="radio-notAgree-7"></td>
                        <td><input class="form-check-input" type="radio" name="type-7" id="radio-notKnow-7"></td>
                    </tr>
                    <tr>
                        <th scope="row"> عدم رغبتي في التخصص </th>
                        <td><input class="form-check-input" type="radio" name="type-8" id="radio-agree-8"></td>
                        <td><input class="form-check-input" type="radio" name="type-8" id="radio-notAgree-8"></td>
                        <td><input class="form-check-input" type="radio" name="type-8" id="radio-notKnow-8"></td>
                    </tr>
                    <tr>
                        <th scope="row"> أعمل أثناء التحاقي بالجامعة </th>
                        <td><input class="form-check-input" type="radio" name="type-9" id="radio-agree-9"></td>
                        <td><input class="form-check-input" type="radio" name="type-9" id="radio-notAgree-9"></td>
                        <td><input class="form-check-input" type="radio" name="type-9" id="radio-notKnow-9"></td>
                    </tr>
                    <tr>
                        <th scope="row"> عدم القدرة على تأمين تكاليف الدراسة </th>
                        <td><input class="form-check-input" type="radio" name="type-10" id="radio-agree-10"></td>
                        <td><input class="form-check-input" type="radio" name="type-10" id="radio-notAgree-10"></td>
                        <td><input class="form-check-input" type="radio" name="type-10" id="radio-notKnow-10"></td>
                    </tr>
                    <tr>
                        <th scope="row"> المسافة التي أقطعها للوصول للجامعة طويلة </th>
                        <td><input class="form-check-input" type="radio" name="type-11" id="radio-agree-11"></td>
                        <td><input class="form-check-input" type="radio" name="type-11" id="radio-notAgree-11"></td>
                        <td><input class="form-check-input" type="radio" name="type-11" id="radio-notKnow-11"></td>
                    </tr>
                    <tr>
                        <th scope="row"> عدم اختيار الأصدقاء الجيدين </th>
                        <td><input class="form-check-input" type="radio" name="type-12" id="radio-agree-12"></td>
                        <td><input class="form-check-input" type="radio" name="type-12" id="radio-notAgree-12"></td>
                        <td><input class="form-check-input" type="radio" name="type-12" id="radio-notKnow-12"></td>
                    </tr>
                    <tr>
                        <th scope="row"> لا أجد الوقت للدراسة </th>
                        <td><input class="form-check-input" type="radio" name="type-13" id="radio-agree-13"></td>
                        <td><input class="form-check-input" type="radio" name="type-13" id="radio-notAgree-13"></td>
                        <td><input class="form-check-input" type="radio" name="type-13" id="radio-notKnow-13"></td>
                    </tr>
                </tbody>
            </table>
            <div>
                <div class="col" id="inputContainer_expereance">
                    <label class="form-label text-start">
                        هل هنالك أسباب أخرى؟ (حددها)
                    </label>
                    <div class="input-group mb-3">
                        <span class="input-group-text" id="basic-addon1">1</span>
                        <input id="inputexpereance_jop" type="text" class="form-control" placeholder="Practical experiences" aria-label="Practical experiences" aria-describedby="basic-addon1" name="experience_job1" />
                    </div>
                </div>
                <button type="button" id="addInputBtn_expereance" class="button-style">
                    إضافة حقل إدخال
                </button>
            </div>
            <div>
                <div class="col mt-3" id="">
                    <label class="form-label text-start">
                        هل هنالك حلول مقترحة؟ (حددها )
                    </label>
                    <div class="form-floating mb-3">
                        <textarea class="form-control" placeholder="Leave a comment here" id="floatingTextarea" maxlength="2000"></textarea>
                        <label for="floatingTextarea">الحلول</label>
                    </div>
                </div>
            </div>
            <div class="save-responsive d-flex justify-content-center mt-4">
                <button id="save-pra" class="button-style fs-6 d-flex justify-content-center align-items-center text-center" style="color: #ffffff;  margin-bottom: 20px;">
                    حفظ
                    <i class="fa-solid fa-floppy-disk ps-1" style="color: #ffffff;"></i>
                </button>
            </div>
        </div>
    </div>

    <script src="../../../js/bootstrap.bundle.min.js"></script>
    <script src="../../../js/all.min.js"></script>
</body>

<script>
    var counter_expereance = 1;

    document
        .getElementById("addInputBtn_expereance")
        .addEventListener("click", function() {
            // إنشاء العنصر الجديد
            counter_expereance++;
            var newInputGroup = document.createElement("div");
            newInputGroup.className = "input-group mb-3"; // تعيين الكلاس المطلوب

            var newSpan = document.createElement("span");
            newSpan.className = "input-group-text";
            newSpan.id = "basic-addon" + counter_expereance;
            newSpan.innerText = counter_expereance; // تعيين الرقم الجديد للعنصر span

            var newInput = document.createElement("input");
            newInput.type = "text"; // يمكنك تعديل نوع الحقل إلى النوع المطلوب
            newInput.className = "form-control"; // تعيين الكلاس المطلوب
            newInput.placeholder = "Practical experiences";
            newInput.ariaLabel = "Practical experiences";
            newInput.name = "experience_jobs" + counter_expereance;
            newInput.ariaDescribedBy = "basic-addon" + counter_expereance;

            // إضافة العناصر الجديدة إلى العنصر الأب
            newInputGroup.appendChild(newSpan);
            newInputGroup.appendChild(newInput);

            // إضافة العنصر الأب إلى الصفحة
            document
                .getElementById("inputContainer_expereance")
                .appendChild(newInputGroup);
        });
</script>