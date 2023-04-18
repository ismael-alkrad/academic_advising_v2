<?php
include_once '../../php/check.php';

check();
check_activity();

$colleges = getColleges($conn);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Users</title>
    <link rel="shortcut icon" href="../../assets/images/logo.png">
    <link rel="stylesheet" href="../../css/bootstrap.rtl.min.css">
    <link rel="stylesheet" href="../../css/all.min.css">
    <link rel="stylesheet" href="../../css/Admin/users.css?v=<?php echo time(); ?>">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@200;300;400;500&display=swap" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body>
    <nav class="navbar navbar-expand-lg shadow-lg p-1 mb-5 bg-body rounded position-sticky top-0">
        <div class="container position-relative">
            <button id="log-out" class="navbar button-style fs-6 d-flex justify-content-center text-center d-none d-lg-block d-xl-block d-xxl-block" style="color: #ffffff;">تسجيل
                خروج <i class="fa-solid fa-arrow-right-from-bracket px-1" style="color: #ffffff;"></i></button>
            <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight" aria-controls="offcanvasRight" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="navbar collapse navbar-collapse me-auto">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link" href="#"><span>المزيد</span></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#"><span>التقارير</span></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="#"><span>الطلاب</span></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="home.php"><span>الرئيسية</span></a>
                    </li>
                </ul>
                <span class="d-none d-lg-block d-xl-block d-xxl-block">الإرشاد الأكاديمي</span>
                <img class="d-none d-lg-block d-xl-block d-xxl-block" height="70px" src="../../assets/images/logo.png">
            </div>

            <!-- ------------------------------------Navbar Responsive-------------------------------------------- -->

            <div class="offcanvas offcanvas-start d-sm-block d-md-block d-lg-none" tabindex="-1" id="offcanvasRight" aria-labelledby="offcanvasRightLabel">
                <div class="position-relative">
                    <div class="offcanvas-header">
                        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                        <h1 class="offcanvas-title" id="offcanvasRightLabel">القائمة</h1>
                        <ul dir="rtl" class="navbar-nav position-absolute top-0 start-0 pt-3 mt-5 mx-4 d-sm-block d-md-block d-lg-none">
                            <li class="nav-item">
                                <a class="nav-link" href=""><span>الرئيسية</span></a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link active" href="#"><span>الطلاب</span></a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#"><span>التقارير</span></a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#"><span>المزيد</span></a>
                            </li>
                            <li class="nav-item" id="log-out-custom">
                                <a class="nav-link" href="#"><span> تسجيل الخروج </span></a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <img class="position-absolute top-0 end-0 d-sm-block d-md-block d-lg-none mx-4" height="40px" src="../../assets/images/logo.png">
        </div>
    </nav>
    <div class="landing">
        <div class="container">
            <div class="row shadow-lg p-3 mb-4 bg-body rounded" id="student-info">
                <div class="col">
                    <table id="students-add-table" class="table table-striped" dir="rtl">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">رقم الطالب</th>
                                <th scope="col">اسم الطالب</th>
                                <th scope="col">ايميل الطالب</th>

                            </tr>
                        </thead>
                        <tbody>


                    </table>
                    <button class="btn btn-outline-primary" id="get-table-data-btn" type="button">أضف الطلاب</button>

                </div>
            </div>
            <div class="row shadow-lg p-3 mb-4 bg-body rounded">
                <div class="row" dir="rtl">

                    <div class="col divider">
                        <label for="inputcollege" class="form-label text-start">الكلية</label>
                        <select id="inputcollege" name="college" class="form-select">
                            <option value="<?php echo $_SESSION['college'] ?? ""; ?>"><?php echo  $_SESSION['college'] ?? "-- اختر الكلية --"; ?></option>
                            <?php foreach ($colleges as $college) { ?>
                                <option value="<?php echo $college['id'] ?>" id="college_<?php echo $college['id'] ?>"><?php echo $college['name'] ?></option>
                            <?php } ?>
                        </select>
                        <div id="college-error" class="text-danger"></div>
                    </div>
                    <div class="col divider">
                        <label for="inputdepartment" class="form-label text-start">القسم</label>
                        <select id="inputdepartment" name="department" class="form-select">
                            <option value="<?php echo $_SESSION['major'] ?? ""; ?>"><?php echo $_SESSION['major'] ?? "-- اختر القسم --"; ?></option>

                        </select>
                        <div id="department-error" class="text-danger"></div>
                    </div>
                    <div class="col divider">
                        <label class="ps-2 mb-2 fw-bold">بحث</label>

                        <button id="search-btn" class="btn btn-outline-primary" type="button">بحث</button>

                    </div>
                </div>
                <div class="col text-center">
                    <table id="students-table" class="table table-striped" dir="rtl">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">رقم الطالب</th>
                                <th scope="col">اسم الطالب</th>
                                <th scope="col">ايميل الطالب</th>
                                <th scope="col"> اضافة </th>
                            </tr>
                        </thead>
                        <tbody>


                    </table>
                </div>
            </div>
        </div>
        <input type="hidden" id="user" name="" value="<?php echo $_GET['user'] ?>">
    </div>
    <script src="../../js/bootstrap.bundle.min.js"></script>
    <script src="../../js/all.min.js"></script>
</body>

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
                    $('#inputdepartment').append('<option value="">جميع الاقسام</option>');
                    $.each(data, function(key, value) {
                        $('#inputdepartment').append('<option value="' + value.id + '">' + value.name + '</option>');
                    });
                },
            });
        });
    });

    $(document).ready(function() {
        // bind click event to search button
        $('#search-btn').click(function() {
            // get selected college and department values
            var college = $('#inputcollege').val();
            var department = $('#inputdepartment').val();

            // make AJAX request to get student data with college and department as data
            $.ajax({
                url: "../../php/forms/getData/get_all_student.php",
                type: "POST",
                dataType: "json",

                data: {
                    college: college,
                    department: department
                },
                success: function(data) {
                    console.log("Successfully retrieved student data: ", data);
                    // Parse the JSON response
                    data = JSON.parse(data);
                    // Empty the table body
                    $("#students-add-table tbody").empty();
                    // Check if the data array is empty
                    if (data.length === 0) {
                        // If it's empty, display a message
                        $("#students-add-table tbody").append("<tr><td colspan='5'>No data available</td></tr>");
                    } else {
                        // Loop through the data and append a row to the table
                        // for each student
                        $.each(data, function(index, student) {
                            var row = $("<tr>");
                            row.append($("<th>").attr("scope", "row").text(index + 1));
                            row.append($("<td>").text(student.u_id));
                            row.append($("<td>").text(student.name));
                            row.append($("<td>").text(student.email));
                            // Add an event listener to the button
                            var button = $("<button>").html("<img src='../../assets/images/advisor/add.png'>");
                            button.on("click", function() {
                                // Create a new row for the student info
                                var studentRow = $("<tr>");
                                studentRow.append($("<th>").attr("scope", "row").text(index + 1));
                                studentRow.append($("<td>").text(student.u_id));
                                studentRow.append($("<td>").text(student.name));
                                studentRow.append($("<td>").text(student.email));
                                // Add the new row to the table
                                $("#students-add-table tbody").append(studentRow);
                            });
                            row.append($("<td>").html(button));
                            $("#students-table tbody").append(row);
                        });
                    }
                },

                error: function(jqXHR, textStatus, errorThrown) {
                    console.log("Error retrieving student data: " + textStatus + ", " + errorThrown);
                }
            });
        });
    });
    $("#get-table-data-btn").on("click", function() {
        var tableData = [];
        $("#students-add-table tbody tr").each(function() {
            var rowData = [];
            $(this).find("td").each(function() {
                rowData.push($(this).text());
            });
            tableData.push(rowData);
        });
        console.log(tableData);
        var user = $('#user').val();

        // Make an HTTP POST request to the test.php file with the table data as the payload
        $.ajax({
            type: "POST",
            url: "test.php",
            data: {
                tableData: tableData,
                id: user

            },
            success: function(response) {


                if (response === "success") {

                    Swal.fire({
                        title: 'Success',
                        text: "تم اضافة الطلاب بنجاح ",
                        icon: 'success',
                        confirmButtonText: 'OK'
                    });
                    $("#students-add-table tbody").empty();
                    // Display a success message to the user
                } else {
                    console.log('An error occurred while updating the table data');
                    // Display an error message to the user
                }
            }
        });
    });
</script>



</html>