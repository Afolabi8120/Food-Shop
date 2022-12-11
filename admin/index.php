<?php
    require('../core/init.php');
    
    $getUserData = $globalclass->selectAll('username','tbluser',$_SESSION['username']); 
    $getSession = $globalclass->getSession($_SESSION['username']);

	if(isset($_SESSION['username']))
    {
        if($_SESSION['session_id'] !== $getSession->session){
            header('location: ../index');
        }
        else {
            if($getUserData->usertype == "Admin" || $getUserData->usertype == "Super Admin"){
                header('location: dashboard');
            }else{
                header('location: ../index');
            }
        }
    }else{
        header('location: ../index');
    }
?>