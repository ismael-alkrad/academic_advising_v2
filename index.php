<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Academic Advising</title>
  <link rel="shortcut icon" href="assets/images/logo.png">
  <link rel="stylesheet" href="css/bootstrap.rtl.min.css" />
  <link rel="stylesheet" href="css/all.min.css" />
  <link rel="stylesheet" href="css/login.css?v=<?php echo time(); ?>" />
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
          <span class="d-flex flex-column align-items-end ms-2 d-none d-lg-block"> الإرشاد الأكاديمي</span>
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
          <div class="res_logo d-lg-none"><img height="150px" src="assets/images/logo.png" alt=""></div>
          <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">اسم المستخدم</label>
            <input type="text" name="username" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" />
            <label id="emailHelp" class="form-text">لن نشارك بريدك الإلكتروني أبدًا مع أي شخص آخر
            </label>
          </div>
          <div class="mb-3 position-relative">
            <label for="exampleInputPassword1" class="form-label">كلمة السر</label>
            <input type="password" name="password" class="form-control" id="exampleInputPassword1" />
            <i class="fa-regular fa-eye align-self-center mx-2" aria-hidden="true" id="showPasswordIcon" style="position: absolute; top: 50%; transform: translateY(50%); right: 440px; cursor: pointer;"></i>
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
          <button type="submit" id="admin-login" class="btn btn-primary">
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
  var rememberMeCheckbox = document.getElementById('exampleCheck1');
  rememberMeCheckbox.addEventListener('change', function() {
    if (this.checked) {
      // Checkbox is checked, save the username and password in a cookie
      var username = document.getElementById('exampleInputEmail1').value;
      var password = document.getElementById('exampleInputPassword1').value;
      document.cookie = "username=" + username + ";password=" + password + ";expires=" + new Date(Date.now() + 86400000).toUTCString() + ";path=/";
      console.log(document.cookie);
    } else {
      // Checkbox is not checked, remove the cookie
      document.cookie = "username=;password=;expires=Thu, 01 Jan 1970 00:00:00 UTC;path=/;";
      console.log(document.cookie);
    }
  });
  window.addEventListener('load', function() {
    var cookies = document.cookie.split(';');
    for (var i = 0; i < cookies.length; i++) {
      var cookie = cookies[i].trim();
      if (cookie.startsWith('username=')) {
        // Username cookie exists, fill in the username field
        var username = cookie.substring('username='.length, cookie.length);
        document.getElementById('exampleInputEmail1').value = username;
        console.log(username);
      }
      if (cookie.startsWith('password=')) {
        // Password cookie exists, fill in the password field
        var password = cookie.substring('password='.length, cookie.length);
        document.getElementById('exampleInputPassword1').value = password;
        console.log(password);
      }
    }
  });
</script>
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
            allowOutsideClick: false,
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
            allowOutsideClick: false,
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
        }
      },
    });
  });
</script>
<script>
  $("#admin-login").on("click", function(e) {
    e.preventDefault();

    var formData = $("#login-form-user").serialize();

    $.ajax({
      type: "Post",
      url: "php/forms/admin-login.php",
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
            allowOutsideClick: false,
            timer: 1500,
          });
          setTimeout(function() {
            window.location.href = "pages/Admin/advisor.php";
          }, 1500);
        } else {
          $("#error_login").empty();
          $("#error_login").append(
            "<div class='alert alert-danger d-flex justify-content-end' role='alert'>هنالك خطأ في اسم المستخدم أو كلمة المرور</div>"
          );
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
        $('#showPasswordIcon').toggleClass('fa-regular fa-eye fa-eye-slash');
      }
    });
  });
</script>

</html>