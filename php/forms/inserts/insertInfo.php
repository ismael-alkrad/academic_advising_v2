<?php
include_once '../../functions.php';

if (isset($_POST)) {

    if (insertFormDataPDO($_POST, $conn)) {
        echo 'success';
    } else {
        echo 'error';
    }
}
