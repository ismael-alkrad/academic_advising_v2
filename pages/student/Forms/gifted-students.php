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
                        <td>Mark</td>
                    </tr>
                    <tr>
                        <th scope="row">رقم الهاتف </th>
                        <td>Jacob</td>
                    </tr>
                    <tr>
                        <th scope="row">البريد الالكتروني</th>
                        <td>Larry the Bird</td>
                    </tr>
                </tbody>
            </table>
            <div class="div mt-5">
                <h4>نرجو منكم تحديد الموهبة التي تتمتعون بها.</h4>
                <div class="row">
                    <div class="col">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="" id="maps">
                            <label class="form-check-label" for="maps">
                                الخرائط
                            </label>
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="" id="ballet">
                            <label class="form-check-label" for="ballet">
                                الباليه
                            </label>
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="" id="optical-illusion">
                            <label class="form-check-label" for="optical-illusion">
                                الخداع البصري
                            </label>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="" id="Poetry">
                            <label class="form-check-label" for="Poetry">
                                الشعر
                            </label>
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="" id="porcelain">
                            <label class="form-check-label" for="porcelain">
                                الخزف
                            </label>
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="" id="tradition">
                            <label class="form-check-label" for="tradition">
                                تقليد شخصيات
                            </label>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="" id="sculpture">
                            <label class="form-check-label" for="sculpture">
                                النحت
                            </label>
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="" id="impersonation">
                            <label class="form-check-label" for="impersonation">
                                التمثيل
                            </label>
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="" id="Drawing-sand">
                            <label class="form-check-label" for="Drawing-sand">
                                الرسم على الرمال
                            </label>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="" id="Drawing">
                            <label class="form-check-label" for="Drawing">
                                الرسم
                            </label>
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="" id="authorship">
                            <label class="form-check-label" for="authorship">
                                التأليف
                            </label>
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="" id="Educational-films">
                            <label class="form-check-label" for="Educational-films">
                                الأفلام التعليمية
                            </label>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="" id="fiddle">
                            <label class="form-check-label" for="fiddle">
                                العزف
                            </label>
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="" id="oratory">
                            <label class="form-check-label" for="oratory">
                                الخطابة
                            </label>
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="" id="photographer">
                            <label class="form-check-label" for="photographer">
                                التصوير الفوتوغرافي
                            </label>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="" id="singing">
                            <label class="form-check-label" for="singing">
                                الغناء
                            </label>
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="" id="handball">
                            <label class="form-check-label" for="handball">
                                كرة اليد
                            </label>
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="" id="graphic-design">
                            <label class="form-check-label" for="graphic-design">
                                التصميم الجرافيكي
                            </label>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="" id="theater">
                            <label class="form-check-label" for="theater">
                                المسرح
                            </label>
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="" id="basketball">
                            <label class="form-check-label" for="basketball">
                                كرة السلة
                            </label>
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="" id="Video-game-design">
                            <label class="form-check-label" for="Video-game-design">
                                تصميم العاب الفيديو
                            </label>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="" id="embroidery">
                            <label class="form-check-label" for="embroidery">
                                التطريز
                            </label>
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="" id="football">
                            <label class="form-check-label" for="football">
                                كرة القدم
                            </label>
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="" id="Teaching-aids-design">
                            <label class="form-check-label" for="Teaching-aids-design">
                                تصميم الوسائل التعليمية
                            </label>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="" id="Journalism">
                            <label class="form-check-label" for="Journalism">
                                الصحافة
                            </label>
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="" id="Making-magazines">
                            <label class="form-check-label" for="Making-magazines">
                                عمل المجلات
                            </label>
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="" id="Short-films">
                            <label class="form-check-label" for="Short-films">
                                الأفلام السينمائية القصيرة
                            </label>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="" id="chess">
                            <label class="form-check-label" for="chess">
                                الشطرنج
                            </label>
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="" id="Making-leaflets">
                            <label class="form-check-label" for="Making-leaflets">
                                عمل المطويات
                            </label>
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="" id="self-defense">
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
                        <input id="inputexpereance_jop" type="text" class="form-control" placeholder="Practical experiences" aria-label="Practical experiences" aria-describedby="basic-addon1" name="experience_job1" />
                    </div>
                </div>
                <button type="button" id="addInputBtn_expereance" class="button-style">
                    إضافة حقل إدخال
                </button>
            </div>
            <div class="mt-3" id="upload-fields">
                <label class="form-label text-start">
                    كما نرجو تزويدنا بما تتمتعون به من مواهب وأعمال ابداعية موثقة بالصور أو الفيديوهات أو الشهادات
                </label>
                <div class="input-group mb-3">
                    <input type="file" class="form-control" id="file-upload" accept="image/png, image/jpeg, video/mp4">
                </div>
            </div>
            <div>
                <button type=" button" id="add-upload-field" class="button-style">
                    إضافة حقل رفع
                </button>
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

<script>
    const addUploadFieldButton = document.getElementById("add-upload-field");
    const uploadFieldsContainer = document.getElementById("upload-fields");

    addUploadFieldButton.addEventListener("click", () => {
        const fileUploadInput = document.createElement("input");
        fileUploadInput.type = "file";
        fileUploadInput.classList.add("form-control");

        const uploadFieldContainer = document.createElement("div");
        uploadFieldContainer.classList.add("input-group", "mb-3");
        uploadFieldContainer.appendChild(fileUploadInput);

        uploadFieldsContainer.appendChild(uploadFieldContainer);
    });
</script>