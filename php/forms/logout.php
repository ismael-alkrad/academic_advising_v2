<?php
session_start();
if (isset($_SESSION['username'])) {
    session_destroy();
    header("Cache-Control: no-cache, no-store, must-revalidate");
    header("Pragma: no-cache");
    header("Expires: 0");
    echo "success";
} else {
    echo "You are not logged in";
}
