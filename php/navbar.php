<?php
function generateNavbar($link, $text, $logo = "../../assets/images/logo.png")
{
  $links = $link;

  $navbar = '<nav class="navbar navbar-expand-lg shadow-lg p-1 mb-5 bg-body rounded position-sticky top-0">
  <div class="container position-relative">';

  if (isset($_SESSION['username'])) {
    $navbar .= '<button id="log-out" class="navbar fs-6 d-flex justify-content-center text-center d-none d-lg-block d-xl-block d-xxl-block" style="color: #ffffff;">تسجيل خروج <i class="fa-solid fa-arrow-right-from-bracket px-1" style="color: #ffffff;"></i></button>';
  }

  $navbar .= '<button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight" aria-controls="offcanvasRight" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="navbar collapse navbar-collapse me-auto">
    <ul class="navbar-nav me-auto mb-2 mb-lg-0">';

  foreach ($links as $link) {
    $class = ($link["url"] == $_SERVER['PHP_SELF']) ? "active" : "";
    $navbar .= '<li class="nav-item"><a class="nav-link ' . $class . '" href="' . $link["url"] . '"><span>' . $link["label"] . '</span></a></li>';
  }

  $navbar .= '</ul>
    <span class="d-flex flex-column align-items-end ms-2"> الإرشاد الأكاديمي<span>
          <small class="text-secondary">(' . $text . ')</small>
      </span></span>
    <img class="d-none d-lg-block d-xl-block d-xxl-block" height="70px" src="' . $logo . '">
  </div>

  <!-- ------------------------------------Navbar Responsive-------------------------------------------- -->

  <div class="offcanvas offcanvas-start d-sm-block d-md-block d-lg-none" tabindex="-1" id="offcanvasRight" aria-labelledby="offcanvasRightLabel">
    <div class="position-relative">
      <div class="offcanvas-header">
        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        <h1 class="offcanvas-title" id="offcanvasRightLabel">القائمة</h1>
        <ul dir="rtl" class="navbar-nav position-absolute top-0 start-0 pt-3 mt-5 mx-4 d-sm-block d-md-block d-lg-none">';

  foreach ($links as $link) {
    $class = ($link["url"] == $_SERVER['PHP_SELF']) ? "active" : "";
    $navbar .= '<li class="nav-item"><a class="nav-link ' . $class . '" href="' . $link["url"] . '"><span>' . $link["label"] . '</a></li>';
  }

  if (isset($_SESSION['username'])) {
    $navbar .= '<li class="nav-item" id="log-out-res">
<a class="nav-link" ><span> تسجيل الخروج </span></a>
</li>';
  }

  $navbar .= '</ul>

</div>
</div>
  </div>
  <img class="position-absolute top-0 end-0 d-sm-block d-md-block d-lg-none mx-4" height="45px" src="' . $logo . '">
</div>
</nav>';
  return $navbar;
}
