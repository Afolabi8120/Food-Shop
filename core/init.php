<?php
    include('database/config.php');
    include('classes/GlobalClass.php');

    global $pdo;

    $globalclass = new GlobalClass($pdo);
    
    session_start();

    define("BASE_URL", "http://localhost/pos/");

    function ErrorMessage(){
        if(isset($_SESSION['ErrorMessage'])){
            $output = '<div class = "alert alert-danger" style = "text-align: center;" role = "alert">';
            $output .= htmlentities($_SESSION['ErrorMessage']);
            $output .= '</div>';
            $_SESSION['ErrorMessage'] = null;
            return $output;
        }

    }

    function SuccessMessage(){
        if(isset($_SESSION['SuccessMessage'])){
            $output = '<div class = "alert alert-success" style = "text-align: center;" role = "alert">';
            $output .= htmlentities($_SESSION['SuccessMessage']);
            $output .= '</div>';
            $_SESSION['SuccessMessage'] = null;
            return $output;
        }

    }

    date_default_timezone_set("Africa/Lagos");
    $h = date('G');

    if($h >= 5 && $h <= 11){
        $getdate = "Good Morning";
    }else if($h >= 12 && $h <= 15){
        $getdate = "Good Afternoon";
    }else {
        $getdate = "Good Evening";
    }

    // get store details
    $getstore = $globalclass->selectStore('tblstorename');

    // get the list of those who order (admin)
    $showmessage = $globalclass->getAdminNotification();

?>