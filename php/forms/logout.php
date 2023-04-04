<?php

session_start();
if (isset($_SESSION['username'])) {
    session_destroy();
    echo "success";
} else {
    echo "You are not logged in";
}
