<?php
include_once '../../php/check.php';

include '../../php/navbar.php';

check_activity();
check();

$id = $_SESSION['username'];
$data = getStudentById($conn, $id);
$colleges = getColleges($conn);
echo "<pre>";
// print_r(getCoursesByCollegeId($conn, $_SESSION['college_id']));
echo "</pre>";

$student_info = getStudentData($conn, $id) ?? [];
?>

<!DOCTYPE html>


<html lang="ar">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Home</title>
    <link rel="shortcut icon" href="../../assets/images/logo.png">
    <link rel="stylesheet" href="../../css/bootstrap.rtl.min.css" />
    <link rel="stylesheet" href="../../css/all.min.css" />
    <link rel="stylesheet" href="../../css/Student/edit-info.css?v=<?php echo time(); ?>" />
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@200;300;400;500&display=swap" rel="stylesheet" />
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body style="margin-top: -15px;">
    <?php echo generateNavbar($links = array(

        array("label" => "الرئيسية", "url" => "student.php")
    ), "طالب"); ?>
    <div class="landing">
        <div class="container">
            <!----------------------------------------- start Undergraduate student information ------------------------------------>
            <form id="student-information">
                <div class="row">
                    <div class="col align-self-center shadow-lg p-3 mb-4 bg-body rounded">
                        <div class="row">
                            <div class="col">
                                <label for="inputcollege" class="form-label text-start">الكلية</label>
                                <select id="inputcollege" name="college" class="form-select">
                                    <option value="<?php echo $student_info['college'] ?? ""; ?>"><?php echo $student_info['college'] ?? "-- اختر الكلية --"; ?></option>

                                </select>
                                <div id="college-error" class="text-danger"></div>
                            </div>
                            <div class="col">
                                <label for="inputdepartment" class="form-label text-start">القسم</label>
                                <select id="inputdepartment" name="department" class="form-select">
                                    <option value="<?php echo $student_info['department'] ?? ""; ?>"><?php echo $student_info['department'] ?? "-- اختر القسم --"; ?></option>

                                </select>
                                <div id="department-error" class="text-danger"></div>
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col">
                                <label for="inputyear" class="form-label text-start">العام الجامعي</label>
                                <select id="inputyear" name="year" class="form-select">
                                    <option value="<?php echo $student_info['year'] ?? ""; ?>"><?php echo $student_info['year'] ?? "-- اختر العام الجامعي --"; ?></option>
                                    <?php
                                    $startYear = 2019;
                                    $endYear = 2030;
                                    for ($i = $startYear; $i <= $endYear; $i++) {
                                        $nextYear = $i + 1;
                                        echo "<option value=\"$i/$nextYear\">$i/$nextYear</option>";
                                    }
                                    ?>
                                </select>
                                <div id="year-error" class="text-danger"></div>
                            </div>
                            <div class="col">
                                <label for="inputblock" class="form-label text-start">الفصل الدراسي</label>
                                <select id="inputblock" name="semyster" class="form-select">
                                    <option value="<?php echo $student_info['semester'] ?? ""; ?>"><?php echo $student_info['semester'] ?? "-- اختر الفصل الجامعي --"; ?></option>
                                    <option value="الأول">الأول</option>
                                    <option value="الثاني">الثاني</option>
                                    <option value="صيفي">صيفي</option>
                                </select>
                                <div id="semyster-error" class="text-danger"></div>
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col">
                                <label for="inputid" class="form-label text-start">الرقم الجامعي</label>
                                <input id="inputid" name="u_id" class="form-control" type="text" maxlength="10" value="<?php echo $data['u_id'] ?? ''; ?>" />
                                <div id="id-error" class="text-danger"></div>
                            </div>
                            <div class="col">
                                <label for="inputblock" class="form-label text-start">سنة الالتحاق بالجامعة</label>
                                <select id="inputblock" name="u_year" class="form-select">
                                    <option value="<?php echo $student_info['u_year'] ?? ""; ?>"><?php echo $student_info['u_year'] ?? "-- اختر سنة الالتحاق --"; ?></option>

                                    <?php
                                    $currentYear = date("Y");
                                    for ($i = $currentYear; $i >= 2019; $i--) {
                                        echo "<option value=\"$i\">$i</option>";
                                    }
                                    ?>
                                </select>
                                <div id="u-year-error" class="text-danger"></div>
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col">
                                <label for="inputname_ar" class="form-label text-start">اسم الطالب باللغة العربية</label>
                                <input id="inputname_ar" name="ar-name" class="form-control" type="text" value="<?php echo $student_info['ar_name'] ?? ''; ?>" />
                                <div id="ar-name-error" class="text-danger"></div>
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col">
                                <label for="inputname_en" class="form-label text-start">اسم الطالب باللغة الإنجليزية</label>
                                <input id="inputname_en" name="en-name" class="form-control" type="text" value="<?php echo $student_info['en_name'] ?? ''; ?>" />
                                <div id="en-name-error" class="text-danger"></div>
                            </div>
                        </div>

                    </div>
                </div>
            </form>
            <div class="d-flex justify-content-center">
                <button id="save" class="button-style fs-6 d-flex justify-content-center align-items-center text-center" style="color: #ffffff">
                    حفظ
                    <i class="fa-solid fa-floppy-disk ps-1" style="color: #ffffff"></i>
                </button>
            </div>
            <!----------------------------------------- End Undergraduate student information ------------------------------------>

            <!----------------------------------------- start Student personal information ------------------------------------>
            <form id="personal-information">
                <div class="row">
                    <div class="col align-self-center shadow-lg p-3 mb-4 bg-body rounded">
                        <input id="inputid" name="u_id" class="form-control" type="hidden" maxlength="10" value="<?php echo $data['u_id'] ?? ''; ?>" />
                        <div class="row">
                            <div class="col">
                                <label for="inputaddress" class="form-label d-flex justify-content-center">عنوان الطالب</label>
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col">
                                <label for="inputregion" class="form-label text-start">المدينة</label>
                                <input type="text" class="form-control" name="region" value="<?php echo $student_info['region'] ?? ''; ?>">
                                <small id="region-error" class="text-danger"></small>
                            </div>
                            <div class="col">
                                <label for="inputphone_house" class="form-label text-start">رقم هاتف (المنزل)</label>
                                <input class="form-control" type="phone" id="inputphone_house" name="phone_house" value="<?php echo $student_info['phone_house'] ?? ''; ?>" pattern="[0-9]{3}-[0-9]{3}-[0-9]{4}" maxlength="12" required />
                                <small id="phone-house-error" class="text-danger"></small>

                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col">
                                <label for="inputcity" class="form-label text-start">الدولة</label>
                                <select id="inputcity" class="form-select" name="city">
                                    <?php
                                    $selected_city = $student_info['city'] ?? "";
                                    $cities = array("سوريا", "الأردن", "العراق", "فلسطين", "لبنان");
                                    $cities = array_diff($cities, array($selected_city)); // remove selected city from array
                                    echo "<option value=\"$selected_city\">$selected_city</option>"; // display selected city
                                    foreach ($cities as $city) {
                                        echo "<option value=\"$city\">$city</option>";
                                    }
                                    ?>
                                </select>
                                <small id="city-error" class="text-danger"></small>
                            </div>
                            <div class="col">
                                <label for="inputphone_person" class="form-label text-start">رقم هاتف (خلوي)</label>
                                <input class="form-control" type="phone" id="inputphone_person" name="phone_person" value="<?php echo $student_info['phone_person'] ?? ''; ?>" pattern="[0-9]{3}-[0-9]{3}-[0-9]{4}" maxlength="12" required />
                                <small id="phone-person-error" class="text-danger"></small>

                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col">
                                <label for="inputemail" class="form-label text-start">البريد الإلكتروني</label>
                                <input id="inputemail" class="form-control" type="email" value="<?php echo $student_info['email'] ?? ''; ?>" style="direction: rtl; text-align: right" name="email" />
                                <small id="email-error" class="text-danger"></small>
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col">
                                <label for="inputplace_birth" class="form-label text-start">
                                    مكان الولادة
                                </label>
                                <select id="inputplace_birth" name="place_birth" class="form-select">
                                    <option value="<?php echo $student_info['place_birth'] ?? ""; ?>"><?php echo $student_info['place_birth'] ?? "الأردن"; ?></option>
                                    <option selected>الاردن</option>
                                    <option>سوريا</option>
                                    <option>فلسطين</option>
                                    <option>لبنان</option>
                                    <option>السعودية</option>
                                    <option>الامارات</option>
                                    <option>الكويت</option>
                                    <option>قطر</option>
                                    <option>البحرين</option>
                                    <option>العراق</option>
                                    <option>مصر</option>
                                    <option>اليمن</option>
                                    <option>عمان</option>
                                </select>
                                <small id="birth-error" class="text-danger"></small>
                            </div>
                            <div class="col">
                                <label for="inputbirth" class="form-label text-start">
                                    تاريخ الولادة
                                </label>
                                <input id="inputbirth" name="birth" class="form-control icon-left" value="<?php echo $student_info['birth_date'] ?? ''; ?>" type="date" />
                                <small id="age-error" class="text-danger"></small>

                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col">
                                <label for="inputstatus" class="form-label text-start">
                                    الحالة الاجتماعية
                                </label>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="status" id="inputstatus1" value="اعزب" />
                                    <label class="form-check-label" for="inputstatus1">اعزب</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="status" id="inputstatus2" value="متزوج" />
                                    <label class="form-check-label" for="inputstatus2">متزوج</label>
                                </div>
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col">
                                <label for="inputgender" class="form-label text-start">
                                    الجنس
                                </label>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="gender" id="inputgender1" value="ذكر" />
                                    <label class="form-check-label" for="inputgender1">ذكر</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="gender" id="inputgender2" value="انثى" />
                                    <label class="form-check-label" for="inputgender2">انثى</label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
            <div class="d-flex justify-content-center">
                <button id="save-per" class="button-style fs-6 d-flex justify-content-center align-items-center text-center" style="color: #ffffff">
                    حفظ
                    <i class="fa-solid fa-floppy-disk ps-1" style="color: #ffffff"></i>
                </button>
            </div>
            <!----------------------------------------- End Student personal information ------------------------------------>

            <!----------------------------------------- start Student Practical experience ------------------------------------>
            <form id="practical-experience">
                <input id="inputid" name="u_id" class="form-control" type="hidden" maxlength="10" value="<?php echo $data['u_id'] ?? ''; ?>" />
                <div class="row">
                    <div class="col align-self-center shadow-lg p-3 mb-4 bg-body rounded">
                        <div class="row">
                            <div class="col">
                                <label for="inputexpereance" class="form-label d-flex justify-content-center">
                                    الخبرات العملية
                                </label>
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col">
                                <label for="inputcompany_name" class="form-label text-start">
                                    اسم المؤسسة التي يعمل بها حالي
                                </label>
                                <input id="inputcompany_name" value="<?php echo $student_info['company_name'] ?? ''; ?>" class="form-control" type="text" name="company_name" />
                            </div>
                            <div class="col">
                                <label for="inputjop_name" class="form-label text-start">
                                    الوظيفة التي تعمل بها حاليا
                                </label>
                                <input id="inputjop_name" class="form-control" value="<?php echo $student_info['jop_name'] ?? ''; ?>" type="text" name="job_name" />
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col" id="inputContainer_expereance">
                                <label for="inputexpereance_jop" class="form-label text-start">
                                    خبرات عملية
                                </label>
                                <div class="input-group mb-3">
                                    <span class="input-group-text" id="basic-addon1">1</span>
                                    <input id="inputexpereance_jop" type="text" class="form-control" placeholder="Practical experiences" aria-label="Practical experiences" aria-describedby="basic-addon1" name="experience_job1" />
                                </div>
                            </div>
                            <div>
                                <button type="button" id="addInputBtn_expereance" class="button-style">
                                    إضافة حقل إدخال
                                </button>
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col" id="inputContainer_certificate">
                                <label for="inputcertificate" class="form-label text-start">
                                    الشهادات التي حصل عليها الطالب (شهادات تدريبية، أكاديمية،
                                    جوائز، مشاركات علمية) ترفق (إن وجدت).
                                </label>
                                <div class="input-group mb-3">
                                    <span class="input-group-text" id="basic-addon1">1</span>
                                    <input id="inputcertificate" type="text" class="form-control" placeholder="certificate" aria-label="certificate" aria-describedby="basic-addon1" name="certificate1" />
                                </div>
                            </div>
                            <div>
                                <button type="button" id="addInputBtn_certificate" class="button-style">
                                    إضافة حقل إدخال
                                </button>
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col" id="inputContainer_activities">
                                <label for="inputactivities" class="form-label text-start">
                                    أي فعاليات أو نشاطات أخرى شارك فيها الطالب
                                </label>
                                <div class="input-group mb-3">
                                    <span class="input-group-text" id="basic-addon1">1</span>
                                    <input id="inputactivities" name="activities1" type="text" class="form-control" placeholder="activities" aria-label="activities" aria-describedby="basic-addon1" />
                                </div>
                            </div>
                            <div>
                                <button type="button" id="addInputBtn_activities" class="button-style">
                                    إضافة حقل إدخال
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
            <div class="d-flex justify-content-center">
                <button id="save-pra" class="button-style fs-6 d-flex justify-content-center align-items-center text-center" style="color: #ffffff">
                    حفظ
                    <i class="fa-solid fa-floppy-disk ps-1" style="color: #ffffff"></i>
                </button>
            </div>
            <!----------------------------------------- End Student Practical experience ------------------------------------>
        </div>

        <button id="finish" class="button-style floating-button">إنهاء</button>
    </div>
    <script src="../../js/bootstrap.bundle.min.js"></script>
    <script src="../../js/all.min.js"></script>
</body>

<!----------------------------------------- start Format Input Phone House ------------------------------------>
<script>
    $(document).ready(function() {
        $('#finish').click(function() {
            // Show confirmation dialog

            Swal.fire({
                title: 'هل أنت متأكد أنك تريد المغادرة؟',
                text: 'قد لا يتم حفظ تغييراتك.',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'نعم، غادر!',
                cancelButtonText: 'لا، ابقى'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        type: "Post",
                        url: "../../php/forms/finish.php",
                        data: {
                            'finish': 'finish'
                        },
                        beforeSend: function() {},
                        complete: function() {
                            // stopPreloader();
                        },
                        success: function(result) {
                            console.log(result);
                            Swal.fire({
                                icon: 'success',
                                title: 'تم تسجيل المعلومات بنجاح',
                                showConfirmButton: false,
                                timer: 1500
                            });
                            setTimeout(function() {
                                window.location.href = 'student.php';
                            }, 1500);
                        },
                    });
                }
            });
        });
    });
</script>
<script>
    document
        .getElementById("inputphone_house")
        .addEventListener("input", function(event) {
            let input = event.target;
            let inputValue = input.value.replace(/\D/g, ""); // يتم استخدام \D لإزالة أي شيء غير أرقام
            let formattedValue = "";
            if (inputValue.length > 10) {
                inputValue = inputValue.slice(0, 10); // يتم قص القيمة إلى 10 أرقام فقط
            }
            for (let i = 0; i < inputValue.length; i++) {
                if (i === 3 || i === 6) {
                    formattedValue += "-";
                }
                formattedValue += inputValue[i];
            }
            input.value = formattedValue;
        });
</script>
<!----------------------------------------- End Format Input Phone House ------------------------------------>

<!----------------------------------------- start Format Input Phone Person ------------------------------------>
<script>
    document
        .getElementById("inputphone_person")
        .addEventListener("input", function(event) {
            let input = event.target;
            let inputValue = input.value.replace(/\D/g, ""); // يتم استخدام \D لإزالة أي شيء غير أرقام
            let formattedValue = "";
            if (inputValue.length > 10) {
                inputValue = inputValue.slice(0, 10); // يتم قص القيمة إلى 10 أرقام فقط
            }
            for (let i = 0; i < inputValue.length; i++) {
                if (i === 3 || i === 6) {
                    formattedValue += "-";
                }
                formattedValue += inputValue[i];
            }
            input.value = formattedValue;
        });
</script>
<!----------------------------------------- End Format Input Phone Person ------------------------------------>

<!----------------------------------------- start Add Input expereance------------------------------------>
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
<!----------------------------------------- End Add Input expereance ------------------------------------>

<!----------------------------------------- start Add Input certificate ------------------------------------>
<script>
    var counter_certificate = 1;

    document
        .getElementById("addInputBtn_certificate")
        .addEventListener("click", function() {
            // إنشاء العنصر الجديد
            counter_certificate++;
            var newInputGroup = document.createElement("div");
            newInputGroup.className = "input-group mb-3"; // تعيين الكلاس المطلوب

            var newSpan = document.createElement("span");
            newSpan.className = "input-group-text";
            newSpan.id = "basic-addon" + counter_certificate;
            newSpan.innerText = counter_certificate; // تعيين الرقم الجديد للعنصر span

            var newInput = document.createElement("input");
            newInput.type = "text"; // يمكنك تعديل نوع الحقل إلى النوع المطلوب
            newInput.className = "form-control"; // تعيين الكلاس المطلوب
            newInput.placeholder = "certificate";
            newInput.ariaLabel = "certificate";
            newInput.name = "certificate" + counter_certificate;
            newInput.ariaDescribedBy = "basic-addon" + counter_certificate;

            // إضافة العناصر الجديدة إلى العنصر الأب
            newInputGroup.appendChild(newSpan);
            newInputGroup.appendChild(newInput);

            // إضافة العنصر الأب إلى الصفحة
            document
                .getElementById("inputContainer_certificate")
                .appendChild(newInputGroup);
        });
</script>
<!----------------------------------------- End Add Input certificate ------------------------------------>

<!----------------------------------------- start Add Input activities ------------------------------------>
<script>
    var counter_activities = 1;

    document
        .getElementById("addInputBtn_activities")
        .addEventListener("click", function() {
            // إنشاء العنصر الجديد
            counter_activities++;
            var newInputGroup = document.createElement("div");
            newInputGroup.className = "input-group mb-3"; // تعيين الكلاس المطلوب

            var newSpan = document.createElement("span");
            newSpan.className = "input-group-text";
            newSpan.id = "basic-addon" + counter_activities;

            newSpan.innerText = counter_activities; // تعيين الرقم الجديد للعنصر span

            var newInput = document.createElement("input");
            newInput.type = "text"; // يمكنك تعديل نوع الحقل إلى النوع المطلوب
            newInput.className = "form-control"; // تعيين الكلاس المطلوب
            newInput.placeholder = "activities";
            newInput.ariaLabel = "activities";
            newInput.name = "activities" + counter_activities;
            newInput.ariaDescribedBy = "basic-addon" + counter_activities;

            // إضافة العناصر الجديدة إلى العنصر الأب
            newInputGroup.appendChild(newSpan);
            newInputGroup.appendChild(newInput);

            // إضافة العنصر الأب إلى الصفحة
            document
                .getElementById("inputContainer_activities")
                .appendChild(newInputGroup);
        });
</script>
<!----------------------------------------- End Add Input activities ------------------------------------>

<!----------------------------------------- start Add data to database ------------------------------------>
<script>
    $("#save").on("click", function(e) {
        e.preventDefault();
        // validate form inputs
        var college = $('#inputcollege').val();
        var department = $('#inputdepartment').val();
        var year = $('#inputyear').val();
        var semyster = $('#inputblock').val();
        var u_id = $('#inputid').val();
        var u_year = $('#inputblock').val();
        var ar_name = $('#inputname_ar').val();
        var en_name = $('#inputname_en').val();

        // check if inputs are valid
        var isValid = true;
        if (college === '') {
            $('#inputcollege').css('border-color', 'red');
            $('#college-error').text('الرجاء إختيار كلية');
            isValid = false;
        } else {
            $('#inputcollege').css('border-color', '');
            $('#college-error').text('');
        }

        if (department === '') {
            $('#inputdepartment').css('border-color', 'red');
            $('#department-error').text('الرجاء إختيار القسم');
            isValid = false;
        } else {
            $('#inputdepartment').css('border-color', '');
            $('#department-error').text('');
        }

        if (year === '') {
            $('#inputyear').css('border-color', 'red');
            $('#year-error').text('الرجاء إختيار العام');
            isValid = false;
        } else {
            $('#inputyear').css('border-color', '');
            $('#year-error').text('');
        }

        if (semyster === '') {
            $('#inputblock').css('border-color', 'red');
            $('#semyster-error').text('الرجاء إختيار الفصل الدراسي');
            isValid = false;
        } else {
            $('#inputblock').css('border-color', '');
            $('#semyster-error').text('');
        }

        if (u_id === '') {
            $('#inputid').css('border-color', 'red');
            $('#id-error').text('الارجاء ادخال الرقم الجامعي القصير');
            isValid = false;
        } else {
            $('#inputid').css('border-color', '');
            $('#id-error').text('');
        }

        if (u_year === '') {
            $('#inputblock').css('border-color', 'red');
            $('#u-year-error').text('الرجاء أدخال سنة الإلتحاق بالجامعة');
            isValid = false;
        } else {
            $('#inputblock').css('border-color', '');
            $('#u-year-error').text('');
        }

        if (ar_name === '') {
            $('#inputname_ar').css('border-color', 'red');
            $('#ar-name-error').text('يرجى إدخال الإسم بالعربية');
            isValid = false;
        } else {
            $('#inputname_ar').css('border-color', '');
            $('#ar-name-error').text('');
        }

        if (en_name === '') {
            $('#inputname_en').css('border-color', 'red');
            $('#en-name-error').text('يرجى إدخال الإسم بالإنجليزية');
            isValid = false;
        } else {
            $('#inputname_en').css('border-color', '');
            $('#en-name-error').text('');
        }

        // additional validation can be added for specific inputs
        // for example, checking that u_id is a valid student ID number

        // if all inputs are valid, submit the form
        if (isValid) {
            var formData = $("#student-information").serialize();
            // console.log(decodeURIComponent(formData.split("&")));

            $.ajax({
                type: "Post",
                url: "../../php/forms/inserts/insertInfo.php",
                data: formData,
                beforeSend: function() {},
                complete: function() {
                    // stopPreloader();
                },
                success: function(result) {
                    console.log(result);
                    Swal.fire({
                        position: "center",
                        icon: "success",
                        title: "تم حفظ المعلومات بنجاح",
                        showConfirmButton: false,
                        allowOutsideClick: false,
                        timer: 1500,
                    });
                },
            });
        }

    });
</script>
<!----------------------------------------- End Add data to database ------------------------------------>

<!----------------------------------------- start Format Input Phone Person ------------------------------------>

<script>
    $("#save-per").on("click", function(e) {
        e.preventDefault();
        var address = $('#inputaddress').val();
        var region = $('#inputregion').val();
        var phone_house = $('#inputphone_house').val();
        var phone_person = $('#inputphone_person').val();
        var email = $('#inputemail').val();
        var birth = $('#inputbirth').val();
        var isValid = true;

        if (region === '') {
            $('#inputregion').css('border-color', 'red');
            $('#region-error').text('يرجى إدخال المدينة');
            isValid = false;
        } else {
            $('#inputregion').css('border-color', '');
            $('#region-error').text('');
        }

        if (phone_house === '') {
            $('#inputphone_house').css('border-color', 'red');
            $('#phone-house-error').text('يرجى إدخال رقم هاتف المنزل');
            isValid = false;
        } else if (!phone_house.match(/[0-9]{3}-[0-9]{3}-[0-9]{4}/)) {
            $('#inputphone_house').css('border-color', 'red');
            $('#phone-house-error').text('يرجى إدخال رقم هاتف المنزل بالتنسيق الصحيح (xxx-xxx-xxxx)');
            isValid = false;
        } else {
            $('#inputphone_house').css('border-color', '');
            $('#phone-house-error').text('');
        }

        if (phone_person === '') {
            $('#inputphone_person').css('border-color', 'red');
            $('#phone-person-error').text('يرجى إدخال رقم الهاتف الخلوي');
            isValid = false;
        } else if (!phone_person.match(/[0-9]{3}-[0-9]{3}-[0-9]{4}/)) {
            $('#inputphone_person').css('border-color', 'red');
            $('#phone-person-error').text('يرجى إدخال رقم الهاتف الخلوي بالتنسيق الصحيح (xxx-xxx-xxxx)');
            isValid = false;
        } else {
            $('#inputphone_person').css('border-color', '');
            $('#phone-person-error').text('');
        }

        if (email === '') {
            $('#inputemail').css('border-color', 'red');
            $('#email-error').text('يرجى إدخال البريد الإلكتروني');
            isValid = false;
        } else {
            $('#inputemail').css('border-color', '');
            $('#email-error').text('');
        }

        if (birth === '') {
            $('#inputbirth').css('border-color', 'red');
            $('#birth-error').text('يرجى إدخال تاريخ الولادة');
            isValid = false;
        } else {
            $('#inputbirth').css('border-color', '');
            $('#birth-error').text('');
        }
        var dob = new Date($('#inputbirth').val());
        var today = new Date();
        var age = today.getFullYear() - dob.getFullYear();
        var month = today.getMonth() - dob.getMonth();
        if (month < 0 || (month === 0 && today.getDate() < dob.getDate())) {
            age--;
        }

        if (age < 18) {
            $('#inputbirth').css('border-color', 'red');
            $('#age-error').text('You must be 18 years or older to submit this form');
            isValid = false;
        } else {
            $('#inputbirth').css('border-color', '');
            $('#age-error').text('');
        }
        // if all inputs are valid, submit the form
        if (isValid) {
            var formData = $("#personal-information").serialize();
            console.log(decodeURIComponent(formData.split("&")));

            $.ajax({
                type: "Post",
                url: "../../php/forms/inserts/insertPer.php",
                data: formData,
                beforeSend: function() {},
                complete: function() {
                    // stopPreloader();
                },
                success: function(result) {
                    console.log(result);
                    Swal.fire({
                        position: "center",
                        icon: "success",
                        title: "تم حفظ المعلومات بنجاح",
                        showConfirmButton: false,
                        allowOutsideClick: false,
                        timer: 1500,
                    });
                },
            });
        }
    });
</script>
<!----------------------------------------- End Format Input Phone Person ------------------------------------>

<!----------------------------------------- start Format Input Phone ------------------------------------>
<script>
    $("#save-pra").on("click", function(e) {
        e.preventDefault();
        var formData = $("#practical-experience").serialize();
        console.log(decodeURIComponent(formData.split("&")));

        $.ajax({
            type: "Post",
            url: "../../php/forms/inserts/insertpra.php",
            data: formData,
            beforeSend: function() {},
            complete: function() {
                // stopPreloader();
            },
            success: function(result) {
                console.log(result);
                Swal.fire({
                    position: "center",
                    icon: "success",
                    title: "تم حفظ المعلومات بنجاح",
                    showConfirmButton: false,
                    allowOutsideClick: false,
                    timer: 1500,
                });
            },
        });
    });
</script>
<!----------------------------------------- End Format Input Phone ------------------------------------>

<!----------------------------------------- start  Log out ------------------------------------>
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
<!----------------------------------------- End  Log out ------------------------------------>

<!----------------------------------------- start  Log out ------------------------------------>
<script>
    $(document).ready(function() {
        // bind change event to college dropdown
        $('#inputcollege').change(function() {
            // get selected college id
            var collegeId = $(this).find(':selected').attr('id').replace('college_', '');

            // send AJAX request to get departments for selected college
            $.ajax({
                url: '../../php/get_department.php',
                method: 'POST',
                data: {
                    college_id: collegeId
                },
                dataType: 'json',
                success: function(data) {
                    console.log(collegeId);
                    console.log(data);
                    $('#inputdepartment').empty();
                    // add new options based on result from server
                    $.each(data, function(key, value) {
                        $('#inputdepartment').append('<option value="' + value.name + '">' + value.name + '</option>');
                    });
                },
                error: function(xhr, status, error) {
                    // display error message if request fails
                    $('#department-error').text('Error loading departments: ' + error);
                }
            });
        });
    });
</script>

</html>