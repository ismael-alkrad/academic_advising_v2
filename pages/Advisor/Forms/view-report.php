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
                    <table id="courses-add-table" class="table table-striped text-center" dir="rtl">
                        <thead>
                            <tr>
                                <th scope="col"> التقرير </th>
                                <th scope="col"> عرض التقرير </th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="pt-3"> تقرير الطلبة الموهوبين </td>
                                <td> <button type="button" class="btn btn-primary">عرض</button> </td>
                            </tr>
                            <tr>
                                <td class="pt-3"> تقرير اسباب التعثر الدراسي </td>
                                <td> <button type="button" class="btn btn-primary">عرض</button> </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <script src="../../../js/bootstrap.bundle.min.js"></script>
    <script src="../../../js/all.min.js"></script>
</body>