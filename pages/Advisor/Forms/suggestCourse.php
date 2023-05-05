<?php
include_once '../../../php/check.php';
include '../../../php/navbar.php';
check(text: "Location: ../../../index.php");
check_activity();

$colleges = getColleges($conn);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Suggest Course</title>
    <link rel="shortcut icon" href="../../../assets/images/logo.png">
    <link rel="stylesheet" href="../../../css/bootstrap.rtl.min.css">
    <link rel="stylesheet" href="../../../css/all.min.css">
    <link rel="stylesheet" href="../../../css/Advisor/Forms/suggestCourse.css?v=<? echo time(); ?>">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@200;300;400;500&display=swap" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body>
    <?php echo generateNavbar($links = array(

        array("label" => "الرئيسية", "url" => "../home.php")
    ), "مدير الموقع", $logo = "../../../assets/images/logo.png"); ?>
    <div class="landing">
        <div class="container">
            <div class="row shadow-lg p-3 mb-4 bg-body rounded" id="student-info">
                <div>
                    <h2> اقتراح مواد للطالب <?php echo getFnameByUid(
                                                $conn,
                                                $_GET['student']
                                            ); ?>
                    </h2>
                </div>
                <div class="col">
                    <table id="courses-add-table" class="table table-striped text-center" dir="rtl">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">رقم المقرر</th>
                                <th scope="col">اسم المقرر</th>
                                <th scope="col"> الشعبة </th>
                                <th scope="col"> وقت المحاضرة </th>
                                <th scope="col"> نوع المادة </th>
                                <th scope="col"> حذف </th>
                            </tr>
                        </thead>
                        <tbody></tbody>
                    </table>
                    <button class="btn btn-outline-primary" id="get-table-data-btn" type="button">أضف الطلاب</button>
                </div>
            </div>
            <div class="row shadow-lg p-3 mb-4 bg-body rounded">
                <div class="row" dir="rtl">
                    <div class="col divider ms-2">
                        <label for="inputcollege" class="form-label text-start">الكلية</label>
                        <select id="inputcollege" name="college" class="form-select box-shadow">
                            <option value="<?php echo $_SESSION['college'] ?? ""; ?>"><?php echo  $_SESSION['college'] ?? "-- اختر الكلية --"; ?></option>
                            <?php foreach ($colleges as $college) { ?>
                                <option value="<?php echo $college['id'] ?>" id="college_<?php echo $college['id'] ?>"><?php echo $college['name'] ?></option>
                            <?php } ?>
                        </select>
                        <div id="college-error" class="text-danger"></div>
                    </div>
                    <div class="col divider">
                        <label for="inputdepartment" class="form-label text-start">القسم</label>
                        <select id="inputdepartment" name="department" class="form-select box-shadow">
                            <option value="<?php echo $_SESSION['major'] ?? ""; ?>"><?php echo $_SESSION['major'] ?? "-- اختر القسم --"; ?></option>
                        </select>
                        <div id="department-error" class="text-danger"></div>
                    </div>
                    <div class="col divider me-3">
                        <button id="search-btn" style="margin-top:31px;" class="btn btn-outline-primary" type="button">بحث</button>
                    </div>
                </div>
                <div class="col text-center">
                    <table id="courses-table" class="table table-striped" dir="rtl">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">رقم المقرر</th>
                                <th scope="col">اسم المقرر</th>
                                <th scope="col"> الشعبة </th>
                                <th scope="col"> وقت المحاضرة </th>
                                <th scope="col"> نوع المادة </th>
                                <th scope="col">إقتراح</th>
                            </tr>
                        </thead>
                        <tbody></tbody>
                    </table>
                </div>
            </div>
        </div>
        <input type="hidden" id="student" name="" value="<?php echo $_GET['student'] ?>">
    </div>
    <script src="../../../js/bootstrap.bundle.min.js"></script>
    <script src="../../../js/all.min.js"></script>
</body>

<script>
    $(document).ready(function() {
        // bind change event to college dropdown
        $('#inputcollege').change(function() {
            // get selected college id
            var collegeId = $(this).find(':selected').attr('id').replace('college_', '');

            // send AJAX request to get departments for selected college
            $.ajax({
                url: '../../../php/get_department.php',
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
                url: "../../../php/forms/getData/get_all_courses.php",
                type: "POST",


                data: {
                    college: college,
                    department: department
                },
                success: function(data) {
                    console.log("Successfully retrieved student data: ", data);

                    // Parse the JSON response
                    try {
                        data = JSON.parse(data);
                        console.log("Successfully retrieved student data: ", data);
                        // Empty the table body
                        $("#courses-table tbody").empty();
                        // Check if the data array is empty
                        if (data.length === 0) {
                            // If it's empty, display a message
                            $("#courses-table tbody").empty();
                            $("#courses-table tbody").append("<tr><td colspan='5'>No data available</td></tr>");
                        } else {
                            // Loop through the data and append a row to the table
                            // for each student
                            $.each(data, function(index, course) {
                                var row = $("<tr>");
                                row.append($("<th>").attr("scope", "row").text(course.id));
                                row.append($("<td>").text(course.number));
                                row.append($("<td>").text(course.name));
                                row.append($("<td>").text(course.section));
                                row.append($("<td>").text(course.time));
                                row.append($("<td>").text(course.type));
                                // Add an event listener to the button
                                var button = $("<button>").html("<img src='../../../assets/images/advisor/add.png'>");
                                button.on("click", function() {
                                    // Create a new row for the course info
                                    var courseRow = $("<tr>");
                                    courseRow.append($("<th>").attr("scope", "row").text(course.id));
                                    courseRow.append($("<td>").text(course.number));
                                    courseRow.append($("<td>").text(course.name));
                                    courseRow.append($("<td>").text(course.section));
                                    courseRow.append($("<td>").text(course.time));
                                    courseRow.append($("<td>").text(course.type));
                                    var removeButton = $("<button>").html("<img src='../../../assets/images/advisor/remove.png'>");
                                    removeButton.on("click", function() {
                                        // Move the row back to the original table
                                        row.show();
                                        // Remove the remove button from the row
                                        courseRow.find("td:last-child").empty();
                                        // Remove the row from the new table
                                        courseRow.remove();
                                    });
                                    courseRow.append($("<td>").append(removeButton));
                                    // Add the new row to the table
                                    $("#courses-add-table tbody").append(courseRow);

                                    // Remove the row from the original table
                                    row.remove();

                                });
                                row.append($("<td>").html(button));
                                $("#courses-table tbody").append(row);
                            });
                        }
                    } catch (e) {
                        console.log("Error retrieving student data:", e);
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
        $("#courses-add-table tbody tr").each(function() {
            var rowData = [];
            $(this).find("td").each(function() {
                // Check if the table cell has a value
                var cellValue = $(this).text().trim();
                if (cellValue) {
                    rowData.push(cellValue);
                }
            });
            // Only add the row data if it has at least one non-empty value
            if (rowData.length > 0) {
                tableData.push(rowData);
            }
        });

        var user = $('#student').val();
        console.log(user);
        // Make an HTTP POST request to the test.php file with the table data as the payload
        $.ajax({
            type: "POST",
            url: "../../../php/forms/assing_suggest_courses.php",
            data: {
                tableData: tableData,
                id: user
            },
            success: function(response) {
                console.log(response);
                if (response === "success") {
                    Swal.fire({
                        title: 'تمت العملية',
                        text: "تم إقتراح المواد بنجاح ",
                        icon: 'success',
                        allowOutsideClick: false,
                        confirmButtonText: 'OK'
                    });
                    $("#courses-add-table tbody").empty();
                    // Display a success message to the user
                } else {
                    console.log('An error occurred while updating the table data');
                    // Display an error message to the user
                }
            }
        });
    });
</script>


<script>
    $("#log-out").click(() => {
        $.ajax({
            url: "../../../php/forms/logout.php",
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
                        window.location.href = "../../../index.php";
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
            url: "../../../php/forms/logout.php",
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
                        window.location.href = "../../../index.php";
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