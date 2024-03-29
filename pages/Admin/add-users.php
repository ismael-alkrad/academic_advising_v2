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
    <title>Add Student</title>
    <link rel="shortcut icon" href="../../assets/images/logo.png">
    <link rel="stylesheet" href="../../css/bootstrap.rtl.min.css">
    <link rel="stylesheet" href="../../css/all.min.css">
    <link rel="stylesheet" href="../../css/Admin/add-users.css?v=<?php echo time(); ?>">
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
                    $("#students-add-table tbody").empty();
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
                            // Create a new row for the student info
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
                                // Add a remove button to the new row
                                var removeButton = $("<button>").html("<img src='../../assets/images/advisor/remove.png'>");
                                removeButton.on("click", function() {
                                    // Move the row back to the original table
                                    row.show();
                                    // Remove the remove button from the row
                                    studentRow.find("td:last-child").empty();
                                    // Remove the row from the new table
                                    studentRow.remove();
                                });
                                studentRow.append($("<td>").append(removeButton));
                                // Add the new row to the table
                                $("#students-add-table tbody").append(studentRow);
                                // Hide the row in the original table
                                row.hide();
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
            url: "../../php/forms/assign_student.php",
            data: {
                tableData: tableData,
                id: user
            },
            success: function(response) {
                console.log(response);
                if (response === "success") {
                    Swal.fire({
                        title: 'Success',
                        text: "تم اضافة الطلاب بنجاح ",
                        icon: 'success',
                        allowOutsideClick: false,
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


<script>
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