<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Academic Advising</title>
  <link rel="stylesheet" href="css/bootstrap.rtl.min.css" />
  <link rel="stylesheet" href="css/all.min.css" />
  <link rel="stylesheet" href="css/login.css" />
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@200;300;400;500&display=swap" rel="stylesheet" />
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

</head>

<body>
  <nav class="navbar navbar-expand-lg shadow-lg p-1 mb-5 bg-body rounded position-sticky top-0">
    <div class="container">
      <span class="navbar fs-1" href="#">تسجيل الدخول</span>
      <div>
        <span class="navbar me-auto">
          <span>الإرشاد الأكاديمي</span>
          <img height="70px" src="assets/images/logo.png" />
        </span>
      </div>
    </div>
  </nav>
  <div class="landing d-flex justify-content-center">
    <div class="row shadow p-3 mb-5 bg-body rounded">
      <div class="col-6 pg-color text-center divider">
        <p>Help Us 24/7</p>
        <p class="fs-1">مرحبًا بعودتك</p>
        <p>دليلك الارشادي في جامعة الاسراء</p>
        <img src="assets/images/logo.png" />
      </div>
      <div class="col-6 pg-color">
        <form id="login-form-user">
          <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">اسم المستخدم</label>
            <input type="text" name="username" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" />
            <label id="emailHelp" class="form-text">لن نشارك بريدك الإلكتروني أبدًا مع أي شخص آخر
            </label>
          </div>
          <div class="mb-3 position-relative">
            <label for="exampleInputPassword1" class="form-label">كلمة السر</label>
            <input type="password" name="password" class="form-control" id="exampleInputPassword1" />
            <i class="fa fa-eye align-self-center mx-2" aria-hidden="true" id="showPasswordIcon" style="position: absolute; top: 50%; transform: translateY(50%); right: 440px; cursor: pointer;"></i>
          </div>
          <div class="mb-3 form-check">
            <input type="checkbox" class="form-check-input" id="exampleCheck1" />
            <label class="form-check-label" for="exampleCheck1">
              ! تذكرني</label>
          </div>
          <div id="error_login">
          </div>
          <button id="button" type="button" class="btn btn-primary">
            تسجيل الدخول كمرشد أكاديمي
          </button>
          <button type="submit" id="student-login" class="btn btn-primary">
            تسجيل الدخول كطالب
          </button>
          <button type="submit" class="btn btn-primary">
            تسجيل الدخول كمدير
          </button>
        </form>
      </div>
    </div>
  </div>
  <script src="js/bootstrap.bundle.min.js"></script>
  <script src="js/all.min.js"></script>
</body>

<script>
  $("#button").on("click", function(e) {
    e.preventDefault();

    var formData = $("#login-form-user").serialize();

    $.ajax({
      type: "Post",
      url: "php/forms/loginform.php",
      data: formData,
      beforeSend: function() {},
      complete: function() {
        // stopPreloader();
        // console.log(formData.split("&"));
      },

      success: function(result) {
        console.log(result);
        if (result === "success") {
          Swal.fire({
            position: "center",
            icon: "success",
            title: "تم تسجيل الدخول بنجاح",
            showConfirmButton: false,
            timer: 1500,
          });
          setTimeout(function() {
            window.location.href = "pages/Advisor/home.php";
          }, 1500);
        } else {
          $("#error_login").empty();
          $("#error_login").append(
            "<div class='alert alert-danger d-flex justify-content-end' role='alert'>هنالك خطأ في اسم المستخدم أو كلمة المرور</div>"
          );
          Swal.fire({
            position: "center",
            icon: "error",
            title: "اسم المستخدم او كلمة المرور غير صحيحة",
            showConfirmButton: false,
            timer: 1500,
          });
        }
      },
    });
  });
</script>
<script>
  $("#student-login").on("click", function(e) {
    e.preventDefault();

    var formData = $("#login-form-user").serialize();

    $.ajax({
      type: "Post",
      url: "php/forms/studentlogin.php",
      data: formData,
      beforeSend: function() {},
      complete: function() {
        // stopPreloader();
        console.log(formData.split("&"));
      },

      success: function(result) {
        console.log(result);
        if (result === "success") {
          Swal.fire({
            position: "center",
            icon: "success",
            title: "تم تسجيل الدخول بنجاح",
            showConfirmButton: false,
            timer: 1500,
          });
          setTimeout(function() {
            window.location.href = "pages/student/home.php";
          }, 1500);
        } else {
          $("#error_login").empty();
          $("#error_login").append(
            "<div class='alert alert-danger d-flex justify-content-end' role='alert'>هنالك خطأ في اسم المستخدم أو كلمة المرور</div>"
          );
          Swal.fire({
            position: "center",
            icon: "error",
            title: "اسم المستخدم او كلمة المرور غير صحيحة",
            showConfirmButton: false,
            timer: 1500,
          });
        }
      },
    });
  });
</script>

<script>
  $(document).ready(function() {
    const passwordInput = $('#exampleInputPassword1');
    $(document).on('click', function(e) {
      if ($(e.target).is('#showPasswordIcon')) {
        const type = passwordInput.attr('type') === 'password' ? 'text' : 'password';
        passwordInput.attr('type', type);
        $('#showPasswordIcon').toggleClass('fa-eye fa-eye-slash');
      }
    });
  });



  //=========================== js ===========================
  // document.addEventListener('DOMContentLoaded', function() {
  //   const passwordInput = document.getElementById('exampleInputPassword1');

  //   document.addEventListener('click', function(e) {
  //     if (e.target.id === 'showPasswordIcon') {
  //       const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
  //       passwordInput.setAttribute('type', type);
  //       const showPasswordIcon = document.getElementById('showPasswordIcon');
  //       showPasswordIcon.classList.toggle('fa-eye');
  //       showPasswordIcon.classList.toggle('fa-eye-slash');
  //     }
  //   });
  // });
</script>

</html>