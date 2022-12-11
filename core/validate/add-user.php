<?php
    include('../core/init.php');

    if(isset($_POST['btn-save-user'])){ // Save Menu

        $username = $globalclass->validateInput($_POST['username']);
        $surname = $globalclass->validateInput($_POST['surname']);
        $othername = $globalclass->validateInput($_POST['othername']);
        $gender = $globalclass->validateInput($_POST['gender']);
        $password = $globalclass->validateInput($_POST['password']);
        $cpassword = $globalclass->validateInput($_POST['cpassword']);
        $email = $globalclass->validateInput($_POST['email']);
        $phone = $globalclass->validateInput($_POST['phone']);
        $address = $globalclass->validateInput($_POST['address']);

        $date = date("d M, Y g:i A");

        $image_name = $_FILES['user-img']['name'];
        $target = '../core/assets/users-pic/' . $_FILES['user-img']['name'];

        if(empty($username) || empty($surname) || empty($othername) || empty($email) || empty($phone) || empty($gender)){
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
           $globalclass->create('tbluser', array('username'=>$username,'surname'=>$surname,'othername'=>$othername,'gender'=>$gender,'password'=>$pass,'email'=>$email,'phone'=>$phone,'picture'=>$image_name,'address'=>$address,'usertype'=>'Admin','status'=>'Active','session'=>$session,'reg_date'=>$date));
           move_uploaded_file($_FILES['user-img']['tmp_name'], $target); 
           $_SESSION['SuccessMessage'] = "User Account has been created successfully";
            
        }
        
    }else if(isset($_POST['btn-disable-user'])){ // Disable User
        $user_id = $_POST['user_id'];

        if($globalclass->enableUser('tbluser','status','In-active',$user_id)){ 
            $_SESSION['SuccessMessage'] = "User Account has been deactivated successfully";
        }
    }else if(isset($_POST['btn-enable-user'])){ // Enable User
        $user_id = $_POST['user_id'];

        if($globalclass->enableUser('tbluser','status','Active',$user_id)){ 
            $_SESSION['SuccessMessage'] = "User Account has been activated successfully";
        }
    }else if(isset($_POST['btn-delete-user'])){ // Delete User
        $user_id = $_POST['user_id'];

        $fetchedimage = $globalclass->fetchByTwoID('picture','id','tbluser',$user_id); // get picture name

        $user_pic = $fetchedimage->picture;
        if($img_path = '../core/assets/users-pic/' . $user_pic){ 
            unlink($img_path); // remove the image base on the one in database
            $globalclass->delete('tbluser','id',$user_id); // remove user from database
            $_SESSION['SuccessMessage'] = "User Account have been removed successfully";
        }   
    }else if(isset($_POST['btn-update-profile'])){ // Update User

        $id = $globalclass->validateInput($_POST['user_id']);
        $surname = $globalclass->validateInput($_POST['surname']);
        $othername = $globalclass->validateInput($_POST['othername']);
        $gender = $globalclass->validateInput($_POST['gender']);
        $phone = $globalclass->validateInput($_POST['phone']);
        $address = $globalclass->validateInput($_POST['address']);

        if(empty($surname) || empty($othername) || empty($phone) || empty($gender)){
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
        }else{
            // update user details
            $globalclass->update('tbluser', $id, array('surname'=>$surname,'othername'=>$othername,'gender'=>$gender,'phone'=>$phone,'address'=>$address));
            $_SESSION['SuccessMessage'] = "Profile updated successfully";
            return;
        }

    }

?>