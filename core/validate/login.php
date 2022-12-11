<?php
    include('../core/init.php');

    if(isset($_POST['btn-login'])){
       
        $username = $globalclass->validateInput($_POST['username']);
        $password = $globalclass->validateInput($_POST['password']);

        if(empty($username) || empty($password)){
            $_SESSION['ErrorMessage'] = "All fields are required";
        }else{

            if($globalclass->login($username) === true){ // check if email or username exist
                $getlogin = $globalclass->selectOne('tbluser','username',$username);

                if(password_verify($password, $getlogin->password)){ // check if password match
                    if($getlogin->status == 'Active'){
                        if($getlogin->usertype == 'User'){
                            $_SESSION['username'] = $username; // store the email into this session
                            $_SESSION['session_id'] = session_id(); // generate session for user
                            $globalclass->updateSession($username,$_SESSION['session_id']); // update user session in database
                            $_SESSION['SuccessMessage'] = "Login Successful";
                            header('location: ../users/dashboard'); // redirect to dashboard
                        }else{
                            $_SESSION['admin'] = $username; // store the email into this session
                            $_SESSION['session_id'] = session_id(); // generate session for user
                            $globalclass->updateSession($username,$_SESSION['session_id']); // update user session in database
                            $_SESSION['SuccessMessage'] = "Login Successful";
                            header('location: ../admin/dashboard'); // redirect to dashboard
                        }
                        
                    }elseif($getlogin->status == 'In-active'){
                        $_SESSION['ErrorMessage'] = "Your account has been deactivated, please contact the administrator";
                        return;
                    }
                    
                }else{
                    $_SESSION['ErrorMessage'] = "Password provided is invalid";
                    return;
                }
            }else{
                $_SESSION['ErrorMessage'] = "Invalid details provided";
                return;
            }
        }
    }

?>