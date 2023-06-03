<?php
include_once '../../../php/check.php';
include '../../../php/navbar.php';
check_activity();
check();
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
    <link rel="stylesheet" href="../../../css/Advisor/Forms/view-annual-report.css?v=<?php echo time(); ?>">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@200;300;400;500&display=swap" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/print-js/1.6.0/print.min.js"></script>

</head>

<body>
    <?php echo generateNavbar($links = array(
        array("label" => "التقارير الطلابية", "url" => "../report.php"),
        array("label" => "الرئيسية", "url" => "../home.php")
    ), getFnameByUid(
        $conn,
        $_SESSION['username']
    ), $logo = "../../../assets/images/logo.png"); ?>
    <div class="landing">
        <div class="container shadow-lg p-3 mb-4 bg-body rounded" dir="rtl">
            <div class="accordion" id="accordion-annual-report">
                <div class="accordion-item">
                    <h2 class="accordion-header" id="headingOne">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="false" aria-controls="collapseOne">
                            2023-2024
                        </button>
                    </h2>
                    <div id="collapseOne" class="accordion-collapse collapse" aria-labelledby="headingOne" data-bs-parent="#accordion-annual-report">
                        <div class="accordion-body px-3">
                            <table class="table">
                                <tbody>
                                    <tr>
                                        <th scope="row">عدد طلبة الإرشاد الأكاديمي</th>
                                        <td>20</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">عدد الطلبة المراجعين من خارج طلبة الإرشاد الأكاديمي</th>
                                        <td>3</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">عدد الطلبة المراجعين</th>
                                        <td>5</td>
                                    </tr>
                                    <tr>
                                        <th scope="row"> المجموع الكلي للطلبة </th>
                                        <td>28</td>
                                    </tr>
                                    <tr>
                                        <th scope="row"> عدد اللقاءات الفردية</th>
                                        <td>7</td>
                                    </tr>
                                    <tr>
                                        <th scope="row"> عدد المتعثرين دراسيا </th>
                                        <td>1</td>
                                    </tr>
                                    <tr>
                                        <th scope="row"> عدد المتعثرين دراسيا المراجعين </th>
                                        <td>3</td>
                                    </tr>
                                    <tr>
                                        <th scope="row"> عدد الحالات المحولة </th>
                                        <td>2</td>
                                    </tr>
                                </tbody>
                            </table>
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
                            <div class="d-flex justify-content-center mt-4">
                                <button id="save4" type="submit" class="button-style fs-6 d-flex justify-content-center align-items-center text-center" style="color: #ffffff;  margin-bottom: 20px;">
                                    طباعة
                                    <i class="ui-button-icon-left ui-icon ui-c fa fa-print white ps-1" style="color: #ffffff;"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="accordion-item">
                    <h2 class="accordion-header" id="headingTwo">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                            2022-2023
                        </button>
                    </h2>
                    <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#accordion-annual-report">
                        <div class="accordion-body">
                            <strong>This is the second item's accordion body.</strong> It is hidden by default, until the collapse plugin adds the appropriate classes that we use to style each element. These classes control the overall appearance, as well as the showing and hiding via CSS transitions. You can modify any of this with custom CSS or overriding our default variables. It's also worth noting that just about any HTML can go within the <code>.accordion-body</code>, though the transition does limit overflow.
                        </div>
                    </div>
                </div>
                <div class="accordion-item">
                    <h2 class="accordion-header" id="headingThree">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                            2021-2022
                        </button>
                    </h2>
                    <div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingThree" data-bs-parent="#accordion-annual-report">
                        <div class="accordion-body">
                            <strong>This is the third item's accordion body.</strong> It is hidden by default, until the collapse plugin adds the appropriate classes that we use to style each element. These classes control the overall appearance, as well as the showing and hiding via CSS transitions. You can modify any of this with custom CSS or overriding our default variables. It's also worth noting that just about any HTML can go within the <code>.accordion-body</code>, though the transition does limit overflow.
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="../../../js/bootstrap.bundle.min.js"></script>
    <script src="../../../js/all.min.js"></script>
</body>