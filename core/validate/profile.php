<?php
    include('../core/init.php');

    if(isset($_POST['btn_update_profile'])){ // Update Profile
        $id = $_POST['id'];
        $user_id = $globalclass->validateInput($_POST['user_id']);
        $fullname = $globalclass->validateInput($_POST['fullname']);
        $email = $globalclass->validateInput($_POST['email']);
        $gender = $globalclass->validateInput($_POST['gender']);
        $religion = $globalclass->validateInput($_POST['religion']);
        $mstatus = $globalclass->validateInput($_POST['mstatus']);
        $phone = $globalclass->validateInput($_POST['phone']);
        $dob = $globalclass->validateInput($_POST['dob']);
        $address = $globalclass->validateInput($_POST['address']);

        $fullname = strtoupper($fullname);

        if($globalclass->updateProfile($id,$user_id,$fullname,$email,$gender,$religion,$mstatus,$phone,$dob,$address) === true){ // called from the GlobalClass class
            $_SESSION['SuccessMessage'] = "Details have been updated successfully";
        }
    }else if(isset($_POST['btn-register'])){ // Register

        $username = $globalclass->validateInput($_POST['username']);
        $surname = $globalclass->validateInput($_POST['surname']);
        $othername = $globalclass->validateInput($_POST['othername']);
        $password = $globalclass->validateInput($_POST['password']);
        $cpassword = $globalclass->validateInput($_POST['cpassword']);
        $email = $globalclass->validateInput($_POST['email']);

        $date = date("d M, Y g:i A");

        if(empty($username) || empty($surname) || empty($othername) || empty($email)){
            $_SESSION['ErrorMessage'] = "All fields are required";
            return;
        }
        elseif(!preg_match("/^[a-z A-Z]*$/", $username)){
            // Using regular expression to check if the user inputs a valid name
            $_SESSION['ErrorMessage'] = "Only Alphabet is allowed for the username field";
            return;
        }
        elseif(!preg_match("/^[a-z A-Z]*$/", $surname)){
            // Using regular expression to check if the user inputs a valid name
            $_SESSION['ErrorMessage'] = "Only Alphabet is allowed for the surname field";
            return;
        }
        elseif(!preg_match("/^[a-z A-Z]*$/", $othername)){
            // Using regular expression to check if the user inputs a valid name
            $_SESSION['ErrorMessage'] = "Only Alphabet is allowed for the othername field";
            return;
        }
        elseif($password != $cpassword){
            // checking if the password match
            $_SESSION['ErrorMessage'] = "Both password do not match";
            return;
        }
        else if($globalclass->checkIfExist('tbluser','username',$username) === true){ # to check if username exist
            $_SESSION['ErrorMessage'] = "Username is currently not available";
            return;
        }else if($globalclass->checkIfExist('tbluser','email',$email) === true){ # to check if email exist
            $_SESSION['ErrorMessage'] = "Email address already in use by another user";
            return;
        }
        else{

            $session = session_id(); // generate session for user

            // Hashing the password provided by the user and storing it into a new variable $pass
            $pass = password_hash($password, PASSWORD_DEFAULT);

            // save menu to database
            $globalclass->create('tbluser', array('username'=>$username,'surname'=>$surname,'othername'=>$othername,'password'=>$pass,'email'=>$email,'picture'=>"default.jpg",'usertype'=>'User','status'=>'Active','session'=>"",'reg_date'=>$date));
            $_SESSION['username'] = $username; // store the email into this session
            $_SESSION['session_id'] = session_id(); // generate session for user
            $globalclass->updateSession($username,$_SESSION['session_id']); // update user session in database
            $_SESSION['SuccessMessage'] = "Login Successful";
            header('location: ../users/dashboard'); // redirect to dashboard
            $_SESSION['SuccessMessage'] = "Account has been created successfully";
            
        }
        
    }
?>