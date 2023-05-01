<?php
include_once '../../php/check.php';
include '../../php/navbar.php';

check();
check_activity(); ?>
<!DOCTYPE html>
<html lang="en">


<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student</title>
    <link rel="shortcut icon" href="../../assets/images/logo.png">
    <link rel="stylesheet" href="../../css/bootstrap.rtl.min.css">
    <link rel="stylesheet" href="../../css/all.min.css">
    <link rel="stylesheet" href="../../css/Student/student.css?v=<?php echo time(); ?>">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@200;300;400;500&display=swap" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.11/cropper.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.11/cropper.min.css" />
</head>

<body>
    <?php echo generateNavbar($links = array(

        array("label" => "الرئيسية", "url" => "#")
    ), "طالب"); ?>
    <div class="landing">
        <div class="container text-center">
            <div class="row-responsive row gx-5 shadow-lg p-3 mb-5 bg-body rounded">
                <div class="col border-responsive">
                    <div class="p-3 border-bottom bg-white">
                        <div class="bg-white rounded-circle" style="position: relative; left: 53%; top: 107px; width: 25px; cursor: pointer;" data-bs-toggle="modal" data-bs-target="#exampleModal"><i class="fa-solid fa-pen-to-square"></i></div>
                        <img class="rounded-circle icon-radius" src="<?php echo getPhotoPathByUser($conn); ?>">
                        <div class="mt-1"><label><?php echo $_SESSION['name'] ?></label></div>
                        <div><small><?php echo $_SESSION['username'] ?></small></div>
                        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content">
                                    <div class="modal-header" style="display: flex; flex-direction: row-reverse;">
                                        <h1 class="modal-title fs-5" id="exampleModalLabel">إعدادات الصورة</h1>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <form id="photo-form" action="">
                                        <div class="modal-body">
                                            <div class="upload-container my-3">
                                                <label for="file-upload">إختر صورة</label>
                                                <input type="file" name="photo" id="file-upload" accept="image/*">
                                            </div>
                                            <div id="photo-cropper"></div>
                                            <hr>
                                            <div id="photo-rev"></div>
                                            <div class="progress my-3">
                                                <div id="upload-progress" class="progress-bar" role="progressbar" style="width: 0%;" aria-valuemin="0" aria-valuemax="100"></div>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">إلغاء</button>
                                            <button type="button" id="save-photo" class="btn btn-primary">حفظ</button>
                                        </div>
                                    </form>
                                    <div id="photo-status"></div> <!-- This is where the error message will be displayed -->
                                </div>
                            </div>
                        </div>
                        <!-- HTML code -->
                        <button type="button" id="delete-image" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#confirm-delete-modal">حذف الصورة</button>

                        <!-- Confirmation modal -->
                        <div class="modal fade" id="confirm-delete-modal" tabindex="-1" aria-labelledby="confirm-delete-modal-label" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content">
                                    <div class="modal-header" style="display: flex; flex-direction: row-reverse;">
                                        <h5 class="modal-title" id="confirm-delete-modal-label">تأكيد</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">

                                        هل أنت متاكد من حذف الصورة؟
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">إالغاء</button>
                                        <button type="button" id="confirm-delete" class="btn btn-danger">حذف</button>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="row">
                        <div class="col">
                            <div class="p-2 bg-white">
                                <table class="table table-bordered border-primary" dir="rtl">
                                    <tbody>
                                        <tr>
                                            <th scope="row">البريد الالكتروني</th>
                                            <td><?php echo $_SESSION['email'] ?></td>
                                        </tr>
                                        <tr>
                                            <th scope="row">رقم الهاتف</th>
                                            <td><?php echo $_SESSION['phone'] ?></td>
                                        </tr>
                                        <tr>
                                            <th scope="row"> الكلية </th>
                                            <td><?php echo $_SESSION['college'] ?></td>
                                        </tr>
                                        <tr>
                                            <th scope="row"> القسم </th>
                                            <td><?php echo $_SESSION['major'] ?></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="p-3 bg-white">
                        <div class="row row-cols-2 row-cols-lg-1 g-3 g-lg-4 justify-content-center">
                            <div class="col">
                                <button class="button-style">
                                    <a>
                                        <div class="p-3 rounded bg-secondary"><i class="fa-solid fa-file" style="color: #ffffff;"></i>
                                            <div class="text-white">
                                                تفريغ خطة الطالب
                                            </div>
                                        </div>
                                    </a>
                                </button>
                            </div>
                            <div class="col">
                                <button class="button-style">
                                    <a href="edit-info.php">
                                        <div class="p-3 rounded bg-secondary"><i class="fa-solid fa-user-pen" style="color: #ffffff;"></i>
                                            <div class="text-white">
                                                تعديل المعلومات
                                            </div>
                                        </div>
                                    </a>
                                </button>
                            </div>
                            <div class="col">
                                <button class="button-style">
                                    <a href="#">
                                        <div class="p-3 rounded bg-secondary"><i class="fa-solid fa-file-signature" style="color: #ffffff;"></i>
                                            <div class="text-white">
                                                المواد المقترحة
                                            </div>
                                        </div>
                                    </a>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div><!----------------------------------------- start  Log out ------------------------------------>
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
    <!----------------------------------------- End  Log out ------------------------------------>

    <script>
        $(document).ready(function() {
            $('#file-upload').change(function() {
                var file_data = $('#file-upload').prop('files')[0];
                var reader = new FileReader();
                reader.onload = function(e) {
                    var img = $('<img>', {
                        src: e.target.result,
                        alt: 'Preview',
                        style: 'max-width: 100%;'
                    });
                    $('#photo-rev').html(img);

                    // Initialize Cropper.js
                    var cropper = new Cropper(img[0], {
                        aspectRatio: 1, // set aspect ratio to 1:1 (square)
                        viewMode: 1, // restrict the crop box to within the container
                        dragMode: 'move', // enable drag mode
                        cropBoxResizable: false, // disable crop box resizing
                        crop: function(e) {
                            // update the image source with the cropped image data
                            var canvas = cropper.getCroppedCanvas({
                                width: 100, // set the output image width to 300px
                                height: 100 // set the output image height to 300px
                            });
                            var cropped_data = canvas.toDataURL(); // get the cropped image data
                            $('#photo-cropper').html(canvas);

                            // Send the AJAX request
                            $('#save-photo').on('click', function() {
                                var form_data = new FormData();
                                form_data.append('photo', cropped_data);
                                var xhr = new XMLHttpRequest();
                                xhr.upload.onprogress = function(e) {
                                    if (e.lengthComputable) {
                                        var percentage = (e.loaded / e.total) * 100;
                                        $('#upload-progress').css('width', percentage + '%').attr('aria-valuenow', percentage);
                                    }
                                };
                                xhr.open('POST', '../../php/forms/save-photo.php');
                                xhr.onload = function() {
                                    if (xhr.status === 200) {
                                        $('#photo-status').html('<div class="alert alert-success" role="alert">تم حفظ الصورة بنجاح!</div>');
                                        setTimeout(function() {
                                            location.reload();
                                        }, 1000);
                                    } else {
                                        $('#photo-status').html('<div class="alert alert-danger" role="alert">هنالك خطأ الرجاء إعادة المحاولة</div>');
                                    }
                                };
                                xhr.send(form_data);
                            });
                        }
                    });
                }
                reader.readAsDataURL(file_data);
            });
        });
    </script>


    <script>
        $(document).ready(function() {
            $('#delete-image').on('click', function() {
                $('#confirm-delete-modal').modal('show');
            });

            $('#confirm-delete').on('click', function() {
                $.ajax({
                    url: '../../php/forms/delete-photo.php',
                    type: 'POST',
                    data: {
                        conn: <?php echo json_encode($conn); ?>
                    },
                    dataType: 'json',
                    success: function(response) {
                        console.log(response);
                        location.reload();
                    },
                    error: function(xhr, status, error) {
                        console.error(xhr.responseText);
                    }
                });
            });
        });
    </script>
    <script src="../../js/bootstrap.bundle.min.js"></script>
    <script src="../../js/all.min.js"></script>
</body>

</html>