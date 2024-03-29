<?php
include_once '../../php/check.php';
include '../../php/navbar.php';
include_once '../../php/functions.php';
check_activity();
check();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Individual Encounters </title>
    <link rel="shortcut icon" href="../../assets/images/logo.png">
    <link rel="stylesheet" href="../../css/bootstrap.rtl.min.css">
    <link rel="stylesheet" href="../../css/all.min.css">
    <link rel="stylesheet" href="../../css/Advisor/annual-report.css?v=<?php echo time(); ?>">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@200;300;400;500&display=swap" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body>
    <?php echo generateNavbar($links = array(
        array("label" => "التقارير", "url" => "#"),
        array("label" => "الرئيسية", "url" => "home.php")
    ), getFnameByUid(
        $conn,
        $_SESSION['username']
    ), $logo = "../../assets/images/logo.png"); ?>
    <div class="landing">
        <div class="container shadow-lg p-3 mb-4 bg-body rounded" dir="rtl">
            <h2 class="text-center"> نموذج التقرير السنوي </h2>
            <form>
                <div class="input-group mb-3">
                    <span class="input-group-text" id="inputGroup-sizing-default">عدد طلبة الإرشاد الأكاديمي</span>
                    <input type="text" class="form-control" value="<?php echo countRows($conn, 'student_info', $_SESSION['username']); ?>" name="academic_advising_students" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default" maxlength="2">
                </div>
                <div class="input-group mb-3">
                    <span class="input-group-text" id="inputGroup-sizing-default">عدد الطلبة المراجعين من خارج طلبة الإرشاد الأكاديمي</span>
                    <input type="text" class="form-control" name="external_students" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default" maxlength="3">
                </div>
                <div class="input-group mb-3">
                    <span class="input-group-text" id="inputGroup-sizing-default">عدد الطلبة المراجعين</span>
                    <input type="text" class="form-control" name="advised_students" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default" maxlength="3">
                </div>
                <div class="input-group mb-3">
                    <span class="input-group-text" id="inputGroup-sizing-default"> المجموع الكلي للطلبة </span>
                    <input type="text" class="form-control" name="total_students" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default" maxlength="3">
                </div>


                <div class="input-group mb-3">
                    <span class="input-group-text" id="inputGroup-sizing-default">عدد اللقاءات الفردية</span>
                    <input type="text" class="form-control" name="individual_meetings" value="<?php echo countRow2($conn, 'counseling', $_SESSION['username']); ?>" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default" maxlength="2">
                </div>
                <div class="input-group mb-3">
                    <span class="input-group-text" id="inputGroup-sizing-default">عدد المتعثرين دراسيا</span>
                    <input type="text" class="form-control" name="struggling_students" value="<?php echo countRow2($conn, 'academic_failures', $_SESSION['username']); ?>" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default" maxlength="2">
                </div>
                <div class="input-group mb-3">
                    <span class="input-group-text" id="inputGroup-sizing-default">عدد المتعثرين دراسيا المراجعين</span>
                    <input type="text" class="form-control" name="struggling_advised_students" value="<?php echo countRow2($conn, 'academic_failures', $_SESSION['username']); ?>" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default" maxlength="2">

                </div>

                <div class="input-group mb-3">
                    <span class="input-group-text" id="inputGroup-sizing-default"> عدد الحالات المحولة </span>
                    <input type="text" class="form-control" name="transferred_groups" value="<?php echo countRow2($conn, 'student_status', $_SESSION['username']); ?>" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default" maxlength="2">
                </div>
                <button type="submit" class="btn btn-primary">حفظ البيانات</button>

                <table class="table table-bordered mt-3">
                    <tbody>
                        <tr>
                            <th class="text-center pt-5" scope="row" rowspan="8">سياسة الإرشاد الأكاديمي</th>
                            <th scope="row"> رقم السياسة : </th>
                            <td>AP-16</td>
                        </tr>
                        <tr>
                            <th scope="row">تاريخ الإصدار :</th>
                            <td>9/10/2019</td>
                        </tr>
                        <tr>
                            <th scope="row"> تاريخ المراجعة والتعديل : </th>
                            <td>Larry the Bird</td>
                        </tr>
                        <tr>
                            <th scope="row"> رقم المراجعة والتعديل : </th>
                            <td>Larry the Bird</td>
                        </tr>
                        <tr>
                            <th scope="row"> عدد الصفحات : </th>
                            <td> 1 </td>
                        </tr>
                        <tr>
                            <th scope="row"> تاريخ اعتماد السياسة : </th>
                            <td>Larry the Bird</td>
                        </tr>
                        <tr>
                            <th scope="row">قرار مجلس النوعية وضبط الجودة رقم :</th>
                            <td>2/2 - 2020/2019</td>
                        </tr>
                        <tr>
                            <th scope="row"> قرار مجلس العمداء رقم : </th>
                            <td>Larry the Bird</td>
                        </tr>
                        <tr>
                            <th scope="row" class="text-center"> السياسة </th>
                            <th colspan="2"> متابعة الشؤون الأكاديمية للطلبة، وتقديم خدمة الإرشاد الأكاديمي لهم. </th>
                        </tr>
                        <tr>
                            <th scope="row" class="text-center"> الأهداف </th>
                            <th colspan="2">
                                <div> 1. تقديم خدمة الإرشاد الأكاديمي للطلبة أثناء عملية التسجيل. </div>
                                <div> 2. إرشاد الطلبة فيما يتعلق بتسجيل المواد ضمن خططهم الدراسية </div>
                                <div> 3. متابعة شؤون الطلبة الأكاديمية أثناء الدراسة. </div>
                                <div> 4. متابعة شؤون الطلبة المتعثرين </div>
                                <div> 5. تقديم الاقتراحات والحلول للطلبة </div>
                                <div> 6. توعية الطلبة بالالتزام بالخطط الدراسية. </div>
                            </th>
                        </tr>
                        <tr>
                            <th scope="row" class="text-center"> مسؤولية التطبيق </th>
                            <th colspan="2">
                                <div> عمداء الكليات.</div>
                                <div> رؤساء الأقسام الأكاديمية. </div>
                                <div> المرشدون الأكاديميون في الكليات </div>
                            </th>
                        </tr>
                        <tr>
                            <th scope="row" class="text-center"> العمليات/التشريعات </th>
                            <th colspan="2">
                                <div> نظام منح الدرجات العلمية </div>
                                <div> تعليمات منح الدرجات العلمية </div>
                            </th>
                        </tr>
                        <tr>
                            <th scope="row" class="text-center"> الإجراءات </th>
                            <th colspan="2">
                                <div>16-001-AP متابعة الطلبة خلال الدراسة الجامعية.</div>
                                <div>16-002-AP حفظ قوائم الطلبة عند كل مرشد أكاديمي عضو هيئة تدريس</div>
                                <div>16-003-AP تعريف الطالب بخطته الدراسية</div>
                                <div>16-004-AP توضيح إجراءات تسجيل المواد من داخل الخطة الدراسية للمادة</div>
                                <div>16-005-AP تعريف الطالب بالأنظمة وبتعليمات منح الدرجات العلمية.</div>
                                <div>16-006-AP اقتراح حلول للطلبة المتعثرين</div>
                                <div>16-007-AP حفظ ملف لكل طالب عند المرشد الأكاديمي.</div>
                                <div>16-008-AP متابعة الطلبة المتعثرين.</div>
                            </th>
                        </tr>
                        <tr>
                            <th scope="row" class="text-center"> النماذج المتعلقة </th>
                            <th colspan="2">
                                <div> AP-16-001-F001 نموذج الإرشاد الأكاديمي. </div>
                                <div> AP-16-002-F001 نموذج سجل زيارات الطالب الإرشادية </div>
                                <div> AP-16-003-F001 نموذج متابعة الطلبة المتعثرين </div>
                            </th>
                        </tr>
                    </tbody>
                </table>
                <div class="save-responsive d-flex justify-content-center">
                    <button id="save-pra" class="button-style fs-6 d-flex justify-content-center align-items-center text-center" style="color: #ffffff;  margin-top: 20px;">
                        حفظ
                        <i class="fa-solid fa-floppy-disk ps-1" style="color: #ffffff;"></i>
                    </button>
                </div>
        </div>
    </div>

    <script src="../../js/bootstrap.bundle.min.js"></script>
    <script src="../../js/all.min.js"></script>
</body>

<script>
    // Get the table body and the add button
    const tableBody = document.getElementById("tableBody");
    const addButton = document.getElementById("addInputBtn_activities");

    // Counter to track the number of rows
    let rowCount = 1;

    // Add click event listener to the add button
    addButton.addEventListener("click", function() {
        // Increment the row count
        rowCount++;
        // Create a new row
        const newRow = document.createElement("tr");
        newRow.id = "row-" + rowCount;

        // Create the cells for the new row
        const cell1 = document.createElement("th");
        cell1.setAttribute("scope", "row");
        const input1 = document.createElement("input");
        input1.className = "form-control";
        input1.type = "text";
        input1.placeholder = " اسم الطالب ";
        input1.setAttribute("aria-label", "default input example");
        cell1.appendChild(input1);

        const cell2 = document.createElement("td");
        const input2 = document.createElement("input");
        input2.className = "form-control";
        input2.type = "text";
        input2.placeholder = " الموضوع ";
        input2.setAttribute("aria-label", "default input example");
        cell2.appendChild(input2);

        const cell3 = document.createElement("td");
        const input3 = document.createElement("input");
        input3.className = "form-control";
        input3.type = "text";
        input3.placeholder = " الإجراءات ";
        input3.setAttribute("aria-label", "default input example");
        cell3.appendChild(input3);

        // Add the cells to the new row
        newRow.appendChild(cell1);
        newRow.appendChild(cell2);
        newRow.appendChild(cell3);

        // Add the new row to the table body
        tableBody.appendChild(newRow);
    });
</script>
<script>
    $(document).ready(function() {
        $('form').submit(function(event) {
            // Prevent the form from submitting normally
            event.preventDefault();

            // Get the form data
            var formData = $(this).serialize();

            // Send the data to the server using AJAX
            $.ajax({
                type: 'POST',
                url: '../../php/forms/inserts/inserAnnualReport.php', // Replace with the URL that processes the form data
                data: formData,
                success: function(response) {
                    console.log(response);
                    // Handle the successful response from the server
                    if (response === "success") {
                        Swal.fire({
                            title: 'تمت العملية',
                            text: "تم الحفظ بنجاح ",
                            icon: 'success',
                            allowOutsideClick: false,
                            confirmButtonText: 'OK'
                        });
                        setTimeout(function() {
                            window.location.href = "home.php";


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
                    // Handle any errors that occur during the AJAX request
                    alert('Error submitting form data: ' + textStatus + ' - ' + errorThrown);
                }
            });
        });
    });

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