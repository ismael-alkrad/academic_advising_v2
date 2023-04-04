<?php
include_once 'functions.php';

function check()
{
    if (!isset($_SESSION['username'])) {
        header("Location: ../../index.php");
    }
}
function check_activity()
{
    if (isset($_SESSION['LAST_ACTIVITY']) && (time() - $_SESSION['LAST_ACTIVITY'] > 900)) {
        // last request was more than 15 minutes ago
        session_unset();     // unset $_SESSION variable for the run-time 
        session_destroy();   // destroy session data in storage
    }
    $_SESSION['LAST_ACTIVITY'] = time(); // update last activity time stamp
}
