<?php
include_once '../../php/check.php';
include '../../php/navbar.php';
check_activity();
check();

$colleges = getColleges($conn);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Remove Student</title>
    <link rel="shortcut icon" href="../../assets/images/logo.png">
    <link rel="stylesheet" href="../../css/bootstrap.rtl.min.css">
    <link rel="stylesheet" href="../../css/all.min.css">
    <link rel="stylesheet" href="../../css/Admin/dell-users.css?v=<?php echo time(); ?>">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@200;300;400;500&display=swap" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body>
    <?php echo generateNavbar($links = array(

        array("label" => "الرئيسية", "url" => "advisor.php")
    ), "مدير الموقع"); ?>
    <div class="landing">
        <div class="container">
            <div class="row shadow-lg p-3 mb-4 bg-body rounded" id="student-info">
                <div>
                    <h2> إضافة طلاب للدكتور <?php echo getFnameByUid(
                                                $conn,
                                                $_GET['user']
                                            ); ?>
                    </h2>
                </div>
                <div class="col">
                    <table id="students-add-table" class="table table-striped text-center" dir="rtl">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">رقم الطالب</th>
                                <th scope="col">اسم الطالب</th>
                                <th scope="col">ايميل الطالب</th>
                                <th scope="col"> اضافة </th>
                            </tr>
                        </thead>
                        <tbody></tbody>
                    </table>
                    <button class="btn btn-outline-primary" id="get-table-data-btn" type="button">أضف الطلاب</button>
                </div>
            </div>
            <div class="row shadow-lg p-3 mb-4 bg-body rounded">
                <div class="col">
                    <table id="students-table" class="table table-striped text-center" dir="rtl">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">رقم الطالب</th>
                                <th scope="col">اسم الطالب</th>
                                <th scope="col">ايميل الطالب</th>
                                <th scope="col"> حذف </th>
                            </tr>
                        </thead>
                        <tbody></tbody>
                    </table>
                </div>
            </div>
        </div>
        <input type="hidden" id="user" name="" value="<?php echo $_GET['user'] ?>">
    </div>
    <script src="../../js/bootstrap.bundle.min.js"></script>
    <script src="../../js/all.min.js"></script>
</body>