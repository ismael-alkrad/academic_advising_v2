<?php
include_once '../../../php/check.php';
include '../../../php/navbar.php';
check_activity();
check(text: "Location: ../../../index.php");
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
    <link rel="stylesheet" href="../../../css/Advisor/Forms/view-report.css?v=<?php echo time(); ?>">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@200;300;400;500&display=swap" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
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
            <div class="row">
                <div>
                    <h2> تقارير الطالب <?php echo getFnameByUid(
                                            $conn,
                                            $_GET['student']
                                        ); ?>
                    </h2>
                </div>
                <div class="col mt-3">
                    <ul class="nav nav-tabs" dir="rtl" id="myTab" role="tablist">
                        <li class="nav-item" role="presentation">
                            <input type="radio" class="btn-check" id="gifted-students" name="report" autocomplete="off" data-bs-toggle="tab" data-bs-target="#gifted-students-pane" role="tab" aria-controls="gifted-students-pane" aria-selected="true">
                            <label class="nav-link btn btn-outline-primary border-primary nav-button-primary me-1 rounded-0 rounded-top" for="gifted-students"> تقرير المواهب </label>
                        </li>
                        <li class="nav-item" role="presentation">
                            <input type="radio" class="btn-check" id="academic-failure" name="report" autocomplete="off" data-bs-toggle="tab" data-bs-target="#academic-failure-pane" role="tab" aria-controls="academic-failure-pane" aria-selected="false">
                            <label class="nav-link btn btn-outline-primary border-primary nav-button-primary me-1 rounded-0 rounded-top" for="academic-failure"> تقرير التعثر الدراسي </label>
                        </li>
                    </ul>
                    <div class="tab-content pt-3" dir="rtl" id="myTabContent">
                        <div class="tab-pane fade" id="gifted-students-pane" role="tabpanel" aria-labelledby="gifted-students" tabindex="0">
                            <table class="table table-bordered">
                                <tbody>
                                    <tr>
                                        <th scope="row">الاسم الرباعي</th>
                                        <td><?php echo getFnameByUid(
                                                $conn,
                                                $_GET['student']
                                            ); ?></td>
                                    </tr>
                                    <tr>
                                        <th scope="row">رقم الهاتف </th>
                                        <td>0791570296</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">البريد الالكتروني</th>
                                        <td><?php echo $_GET['email'] ?></td>
                                    </tr>
                                </tbody>
                            </table>
                            <div class="mt-5">
                                <h4> المواهب التي يتمتع بها الطالب </h4>
                                <div>
                                    <table class="table table-striped text-center">
                                        <thead>
                                            <tr>
                                                <th scope="col">#</th>
                                                <th scope="col">الموهبة</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <th scope="row">1</th>
                                                <td>السباحة</td>
                                            </tr>
                                            <tr>
                                                <th scope="row">2</th>
                                                <td>ركوب الخيل</td>
                                            </tr>
                                            <tr>
                                                <th scope="row">3</th>
                                                <td> كرةالقدم </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-content pt-3" dir="rtl" id="myTabContent">
                        <div class="tab-pane fade" id="academic-failure-pane" role="tabpanel" aria-labelledby="academic-failure" tabindex="0">
                            <table class="table table-bordered">
                                <tbody>
                                    <tr>
                                        <th scope="row">الاسم</th>
                                        <td><?php echo $data['name']; ?></td>
                                    </tr>
                                    <tr>
                                        <th scope="row">الرقم الجامعي</th>
                                        <td><?php echo $data['u_id']; ?></td>
                                    </tr>
                                    <tr>
                                        <th scope="row"> الفصل الدراسي / العام الجامعي للطالب </th>
                                        <td>الأول</td>
                                    </tr>
                                    <tr>
                                        <th scope="row"> المعدل التراكمي </th>
                                        <td>90.8</td>
                                    </tr>
                                </tbody>
                            </table>
                            <table class="table table-bordered position">
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
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                    </tr>
                                </tbody>
                            </table>
                            <div>
                                <div class="col mt-3" id="">
                                    <label class="form-label text-start">
                                        الحلول المقترحة
                                    </label>
                                    <div class="mb-3">

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="../../../js/bootstrap.bundle.min.js"></script>
    <script src="../../../js/all.min.js"></script>
</body>