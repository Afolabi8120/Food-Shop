<?php
    require_once('../includes/session.php');

    $_SESSION[] = array();
    session_destroy();
    $_SESSION['SuccessMessage'] = "Logout Successful";
    header('location: ../index');

?>