<?php
include_once '../../functions.php';

if (isset($_POST)) {

    if (insertOrUpdatePracticalExperience($conn, $_POST)) {
        echo 'success';
    } else {
        echo 'error';
    }
}
