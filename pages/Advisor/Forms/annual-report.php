<?php
include_once '../../../php/check.php';
include '../../../php/navbar.php';
check();
check_activity();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Individual Encounters </title>
    <link rel="shortcut icon" href="../../../assets/images/logo.png">
    <link rel="stylesheet" href="../../../css/bootstrap.rtl.min.css">
    <link rel="stylesheet" href="../../../css/all.min.css">
    <link rel="stylesheet" href="../../../css/Advisor/Forms/annual-report.css?v=<?php echo time(); ?>">
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
    ), "مرشد"); ?>
    <div class="landing">
        <div class="container shadow-lg p-3 mb-4 bg-body rounded" dir="rtl">
            <h2 class="text-center"> نموذج التقرير السنوي </h2>
            <form>
                <div class="input-group mb-3">
                    <span class="input-group-text" id="inputGroup-sizing-default">عدد طلبة الإرشاد الأكاديمي</span>
                    <input type="text" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default" maxlength="2">
                </div>
                <div class="input-group mb-3">
                    <span class="input-group-text" id="inputGroup-sizing-default">عدد الطلبة المراجعين من خارج طلبة الإرشاد الأكاديمي</span>
                    <input type="text" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default" maxlength="3">
                </div>
                <div class="input-group mb-3">
                    <span class="input-group-text" id="inputGroup-sizing-default">عدد الطلبة المراجعين</span>
                    <input type="text" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default" maxlength="3">
                </div>
                <div class="input-group mb-3">
                    <span class="input-group-text" id="inputGroup-sizing-default"> المجموع الكلي للطلبة </span>
                    <input type="text" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default" maxlength="3">
                </div>
                <div class="input-group mb-3">
                    <span class="input-group-text" id="inputGroup-sizing-default"> نسبة المراجعين من المجموع الكلي للطلبة </span>
                    <input type="text" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default" maxlength="2">
                </div>
                <div class="input-group mb-3">
                    <span class="input-group-text" id="inputGroup-sizing-default"> عدد اللقاءات الشهرية </span>
                    <input type="text" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default" maxlength="2">
                </div>
                <div class="input-group mb-3">
                    <span class="input-group-text" id="inputGroup-sizing-default">عدد اللقاءات الفردية</span>
                    <input type="text" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default" maxlength="2">
                </div>
                <div class="input-group mb-3">
                    <span class="input-group-text" id="inputGroup-sizing-default">عدد المتعثرين دراسيا</span>
                    <input type="text" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default" maxlength="2">
                </div>
                <div class="input-group mb-3">
                    <span class="input-group-text" id="inputGroup-sizing-default">عدد المتعثرين دراسيا المراجعين</span>
                    <input type="text" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default" maxlength="2">
                </div>
                <div class="input-group mb-3">
                    <span class="input-group-text" id="inputGroup-sizing-default"> نسبة المتعثرين دراسيا المراجعين </span>
                    <input type="text" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default" maxlength="2">
                </div>
                <div class="input-group mb-3">
                    <span class="input-group-text" id="inputGroup-sizing-default"> عدد الجالات المحولة </span>
                    <input type="text" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default" maxlength="2">
                </div>
            </form>
            <div class="row">
                <label> إجراءات الخطة العلاجية للطلبة المتعثرين : </label>
                <div class="col mt-2 form-floating">
                    <textarea class="form-control" placeholder="اكتب هنا الاجراءات" id="floatingTextarea" maxlength="2000"></textarea>
                    <label class="ms-3" for="floatingTextarea"> اكتب هنا الإجراءات </label>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <table class="table table-striped text-center mt-3">
                        <thead>
                            <tr>
                                <th scope="col">الطلبة المراجعين من خارج طلبة الإرشاد الأكاديمي</th>
                                <th scope="col">الموضوع</th>
                                <th scope="col">الإجراءات</th>
                            </tr>
                        </thead>
                        <tbody id="tableBody">
                            <tr id="row-1">
                                <th scope="row"><input class="form-control" type="text" placeholder="اسم الطالب" aria-label="default input example">
                                </th>
                                <td><input class="form-control" type="text" placeholder=" الموضوع " aria-label="default input example">
                                </td>
                                <td><input class="form-control" type="text" placeholder=" الإجراءات " aria-label="default input example">
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <div>
                        <button type="button" id="addInputBtn_activities" class="button-style">
                            إضافة حقل إدخال
                        </button>
                    </div>
                </div>
            </div>
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
                        <th scope="row" rowspan="6" class="text-center"> الأهداف </th>
                        <th colspan="2"> 1. تقديم خدمة الإرشاد الأكاديمي للطلبة أثناء عملية التسجيل. </th>
                    </tr>
                    <tr>
                        <th colspan="2" scope="row">2. إرشاد الطلبة فيما يتعلق بتسجيل المواد ضمن خططهم الدراسية </th>
                    </tr>
                    <tr>
                        <th colspan="2" scope="row">3. متابعة شؤون الطلبة الأكاديمية أثناء الدراسة. </th>
                    </tr>
                    <tr>
                        <th colspan="2" scope="row">4. متابعة شؤون الطلبة المتعثرين </th>
                    </tr>
                    <tr>
                        <th colspan="2" scope="row">5. تقديم الاقتراحات والحلول للطلبة </th>
                    </tr>
                    <tr>
                        <th colspan="2" scope="row">6. توعية الطلبة بالالتزام بالخطط الدراسية. </th>
                    </tr>
                    <tr>
                        <th rowspan="3" scope="row" class="text-center"> مسؤولية التطبيق </th>
                        <th colspan="2">- عمداء الكليات.</th>
                    </tr>
                    <tr>
                        <th colspan="2">- رؤساء الأقسام الأكاديمية. </th>
                    </tr>
                    <tr>
                        <th colspan="2">- المرشدون الأكاديميون في الكليات</th>
                    </tr>
                    <tr>
                        <th scope="row" rowspa></th>
                        <th colspan="2">- المرشدون الأكاديميون في الكليات</th>
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

    <script src="../../../js/bootstrap.bundle.min.js"></script>
    <script src="../../../js/all.min.js"></script>
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