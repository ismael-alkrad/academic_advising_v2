<?php
include_once '../../php/check.php';
include '../../php/navbar.php';
check();
check_activity();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Report</title>
    <link rel="shortcut icon" href="../../assets/images/logo.png">
    <link rel="stylesheet" href="../../css/bootstrap.rtl.min.css">
    <link rel="stylesheet" href="../../css/all.min.css">
    <link rel="stylesheet" href="../../css/Advisor/report.css?v=<?php echo time(); ?>">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@200;300;400;500&display=swap" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body>
    <?php echo generateNavbar($links = array(
        array("label" => "التقارير", "url" => "#"),
        array("label" => "الطلاب", "url" => "student.php"),
        array("label" => "الرئيسية", "url" => "home.php")
    )); ?>
    <div class="landing">
        <div class="container">
            <div class="row shadow-lg p-3 mb-4 bg-body rounded">
                <div class="col">
                    <ul class="nav nav-tabs" dir="rtl" id="myTab" role="tablist">
                        <li class="nav-item" role="presentation">
                            <input type="radio" class="btn-check" id="report" name="report" autocomplete="off" data-bs-toggle="tab" data-bs-target="#report-pane" role="tab" aria-controls="report-pane" aria-selected="true">
                            <label class="nav-link btn btn-outline-primary border-primary nav-button-primary me-1 rounded-0 rounded-top" for="report">التقارير</label>
                        </li>
                        <li class="nav-item" role="presentation">
                            <input type="radio" class="btn-check" id="complete-report" name="report" autocomplete="off" data-bs-toggle="tab" data-bs-target="#complete-report-pane" role="tab" aria-controls="complete-report-pane" aria-selected="false">
                            <label class="nav-link btn btn-outline-success border-success nav-button-success me-1 rounded-0 rounded-top" for="complete-report">مكتمل</label>
                        </li>
                        <li class="nav-item" role="presentation">
                            <input type="radio" class="btn-check" id="incomplete-report" name="report" autocomplete="off" data-bs-toggle="tab" data-bs-target="#incomplete-report-pane" role="tab" aria-controls="incomplete-report-pane" aria-selected="false">
                            <label class="nav-link btn btn-outline-warning border-warning nav-button-warning rounded-0 rounded-top" for="incomplete-report">غير مكتمل</label>
                        </li>
                    </ul>
                    <div class="tab-content" id="myTabContent">
                        <div class="tab-pane fade" id="report-pane" role="tabpanel" aria-labelledby="report" tabindex="0">
                            <div class="accordion mt-2" id="accordionExample">
                                <div class="accordion-item">
                                    <?php
                                    $student = getStudent($conn);
                                    if ($student != null) {
                                        foreach ($student as $s) {
                                            $to = $s['email'];
                                            echo '<h2 class="accordion-header" id="heading' . $s['u_id'] . '" data-u-id="' . $s['u_id'] . '">
                                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                            data-bs-target="#collapse' . $s['u_id'] . '"  aria-expanded="false" aria-controls="collapse' . $s['u_id'] . '" data-u-id="' . $s['u_id'] . '">
                                            ' . $s['name'] . '
                                        </button>
                                    </h2>
                                    <div id="collapse' . $s['u_id'] . '" class="accordion-collapse collapse" aria-labelledby="heading' . $s['u_id'] . '"
                                        data-bs-parent="#accordionExample">
                                        <div class="accordion-body px-3">
                                            <div class="container">
                                                <div class="row">
                                                    <div class="col">
                                                        <form>
                                                            <table class="table table-striped" dir="rtl">
                                                                <thead>
                                                                    <tr>
                                                                        <th scope="col">الكلية</th>
                                                                        <td>تكنولوجيا المعلومات</td>
                                                                        <th scope="col">القسم</th>
                                                                        <td>هندسة البرمجيات</td>
                                                                        <td class="ms-1"><button><img src="../../assets/images/advisor/checkmark.png"></button></td>
                                                                        <td><button><img src="../../assets/images/advisor/warning.png"></button></td>
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                    <tr>
                                                                        <th scope="row">العام الحامعي</th>
                                                                        <td> 2022/2023 </td>
                                                                        <th> الفصل الدراسي </th>
                                                                        <td> الثاني </td>
                                                                        <td class="ms-1"><button><img src="../../assets/images/advisor/checkmark.png"></button></td>
                                                                        <td><button><img src="../../assets/images/advisor/warning.png"></button></td>
                                                                    </tr>
                                                                    <tr>
                                                                        <th scope="row">الرقم الحامعي</th>
                                                                        <td> AC0109 </td>
                                                                        <th>  سنة الالتحاق بالجامعة </th>
                                                                        <td> 2019 </td>
                                                                        <td class="ms-1"><button><img src="../../assets/images/advisor/checkmark.png"></button></td>
                                                                        <td><button><img src="../../assets/images/advisor/warning.png"></button></td>
                                                                    </tr>
                                                                    <tr>
                                                                        <th scope="row">اسم الطالب باللغة العربية</th>
                                                                        <td colspan="3">اسماعيل عماد الكراد</td>
                                                                        <td class="ms-1"><button><img src="../../assets/images/advisor/checkmark.png"></button></td>
                                                                        <td><button><img src="../../assets/images/advisor/warning.png"></button></td>
                                                                    </tr>
                                                                    <tr>
                                                                        <th scope="row">اسم الطالب باللغة الانجليزية</th>
                                                                        <td colspan="3"> Ismael Emad Alkrad </td>
                                                                        <td class="ms-1"><button><img src="../../assets/images/advisor/checkmark.png"></button></td>
                                                                        <td><button><img src="../../assets/images/advisor/warning.png"></button></td>
                                                                    </tr>
                                                                    <tr>
                                                                        <th class="text-center" scope="row" colspan= "6"> عنوان الطالب </th>
                                                                    </tr>
                                                                    <tr>
                                                                        <th scope="row"> المدينة </th>
                                                                        <td> عمان </td>
                                                                        <th> رقم هاتف (المنزل) </th>
                                                                        <td> 079-758-8413 </td>
                                                                        <td class="ms-1"><button><img src="../../assets/images/advisor/checkmark.png"></button></td>
                                                                        <td><button><img src="../../assets/images/advisor/warning.png"></button></td>
                                                                    </tr>
                                                                    <tr>
                                                                        <th scope="row"> الدولة </th>
                                                                        <td> الأردن </td>
                                                                        <th> رقم هاتف (خلوي) </th>
                                                                        <td> 079-758-8413 </td>
                                                                        <td class="ms-1"><button><img src="../../assets/images/advisor/checkmark.png"></button></td>
                                                                        <td><button><img src="../../assets/images/advisor/warning.png"></button></td>
                                                                    </tr>
                                                                    <tr>
                                                                        <th scope="row"> البريد الإلكتروني </th>
                                                                        <td colspan="3"> Esmaelalkrad0@gmail.com </td>
                                                                        <td class="ms-1"><button><img src="../../assets/images/advisor/checkmark.png"></button></td>
                                                                        <td><button><img src="../../assets/images/advisor/warning.png"></button></td>
                                                                    </tr>
                                                                    <tr>
                                                                        <th scope="row"> مكان الولادة </th>
                                                                        <td> سوريا </td>
                                                                        <th> تاريخ الولادة </th>
                                                                        <td> 11/1/2001 </td>
                                                                        <td class="ms-1"><button><img src="../../assets/images/advisor/checkmark.png"></button></td>
                                                                        <td><button><img src="../../assets/images/advisor/warning.png"></button></td>
                                                                    </tr>
                                                                    <tr>
                                                                        <th scope="row"> الحالة الاجتماعية  </th>
                                                                        <td colspan="3"> اعزب </td>
                                                                        <td class="ms-1"><button><img src="../../assets/images/advisor/checkmark.png"></button></td>
                                                                        <td><button><img src="../../assets/images/advisor/warning.png"></button></td>
                                                                    </tr>
                                                                    <tr>
                                                                        <th scope="row">  الجنس  </th>
                                                                        <td colspan="3"> ذكر </td>
                                                                        <td class="ms-1"><button><img src="../../assets/images/advisor/checkmark.png"></button></td>
                                                                        <td><button><img src="../../assets/images/advisor/warning.png"></button></td>
                                                                    </tr>
                                                                    <tr>
                                                                        <th class="text-center" scope="row" colspan= "6">  الخبرات العملية </th>
                                                                    </tr>
                                                                    <tr>
                                                                        <th scope="row"> اسم المؤسسة التي يعمل بها حالي  </th>
                                                                        <td> Sync-Fast </td>
                                                                        <th>  الوظيفة التي تعمل بها حاليا </th>
                                                                        <td> Front-End & Systems Analyst </td>
                                                                        <td class="ms-1"><button><img src="../../assets/images/advisor/checkmark.png"></button></td>
                                                                        <td><button><img src="../../assets/images/advisor/warning.png"></button></td>
                                                                    </tr>
                                                                    <tr>
                                                                        <th scope="row" colspan= "6">  خبرات عملية </th>
                                                                    </tr>
                                                                    <tr>
                                                                        <th scope="row"> 1 </th>
                                                                        <td colspan= "3"> System Academic Advisor </td>
                                                                        <td class="ms-1"><button><img src="../../assets/images/advisor/checkmark.png"></button></td>
                                                                        <td><button><img src="../../assets/images/advisor/warning.png"></button></td>
                                                                    </tr>
                                                                    <tr>
                                                                        <th scope="row"> 2 </th>
                                                                        <td colspan= "3"> System Course File </td>
                                                                        <td class="ms-1"><button><img src="../../assets/images/advisor/checkmark.png"></button></td>
                                                                        <td><button><img src="../../assets/images/advisor/warning.png"></button></td>
                                                                    </tr>
                                                                    <tr>
                                                                        <th scope="row"> 3 </th>
                                                                        <td colspan= "3"> Data Analyst </td>
                                                                        <td class="ms-1"><button><img src="../../assets/images/advisor/checkmark.png"></button></td>
                                                                        <td><button><img src="../../assets/images/advisor/warning.png"></button></td>
                                                                    </tr>
                                                                    <tr>
                                                                        <th scope="row" colspan= "6">الشهادات التي حصل عليها الطالب (شهادات تدريبية، أكاديمية، جوائز، مشاركات علمية </th>
                                                                    </tr>
                                                                    <tr>
                                                                        <th scope="row"> 1 </th>
                                                                        <td colspan= "3"> لايوجد </td>
                                                                        <td class="ms-1"><button><img src="../../assets/images/advisor/checkmark.png"></button></td>
                                                                        <td><button><img src="../../assets/images/advisor/warning.png"></button></td>
                                                                    </tr>
                                                                    <tr>
                                                                        <th scope="row" colspan= "6"> أي فعاليات أو نشاطات أخرى شارك فيها الطالب </th>
                                                                    </tr>
                                                                    <tr>
                                                                        <th scope="row"> 1 </th>
                                                                        <td colspan= "3"> لايوجد </td>
                                                                        <td class="ms-1"><button><img src="../../assets/images/advisor/checkmark.png"></button></td>
                                                                        <td><button><img src="../../assets/images/advisor/warning.png"></button></td>
                                                                    </tr>
                                                                </tbody>
                                                            </table>
                                                            <div class="row" dir="rtl">
                                                                <div class="col-9">
                                                                    <div class="form-floating" dir="rtl">
                                                                        <textarea class="form-control" placeholder="Leave a comment here" id="floatingTextarea"></textarea>
                                                                        <label for="floatingTextarea">تعليق</label>
                                                                    </div>
                                                                </div>
                                                                <div class="col text-center mt-2">
                                                                    <button type="button" class="btn btn-outline-info">ارسال</button>
                                                                </div>
                                                            </div>
                                                        </form>     
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    ';
                                        }
                                    } else {
                                    }
                                    ?>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="complete-report-pane" role="tabpanel" aria-labelledby="complete-report" tabindex="0">ddddd</div>
                        <div class="tab-pane fade" id="incomplete-report-pane" role="tabpanel" aria-labelledby="incomplete-report" tabindex="0">...</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="../../js/bootstrap.bundle.min.js"></script>
    <script src="../../js/all.min.js"></script>
</body>

</html>