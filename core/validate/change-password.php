<?php
    include('../core/init.php');

    if(isset($_POST['btn-change-password'])){ // Change Password

        $old_password = $globalclass->validateInput($_POST['old-password']);
        $new_password = $globalclass->validateInput($_POST['new-password']);
        $cnew_password = $globalclass->validateInput($_POST['cnew-password']);

        if(empty($old_password) || empty($new_password) || empty($cnew_password)){
            $_SESSION['ErrorMessage'] = "All fields are required";
            return;
        }elseif($new_password != $cnew_password){
            $_SESSION['ErrorMessage'] = "Both new password did not match";
            return;
        }elseif(strlen($new_password) <= 7){
            $_SESSION['ErrorMessage'] = "Password length must be more than 7 characters";
            return;
        }else{

            $fetchedpassword = $globalclass->fetchByTwoID('password','username','tbluser',$_SESSION['username']);

            if(password_verify($old_password, $fetchedpassword->password)){ // check if password match
                // Hashing the password provided by the user and storing it into a new variable $pass
                $pass = password_hash($new_password, PASSWORD_DEFAULT);

                $getUserData = $globalclass->selectAll('username','tbluser',$_SESSION['username']); 

                $globalclass->update('tbluser', $getUserData->id, array('password'=>$pass));
                $_SESSION['SuccessMessage'] = "Password has been changed successfully";
                return;
                
            }else{
                $_SESSION['ErrorMessage'] = "Old password provided is invalid";
            }
        }
    }elseif(isset($_POST['btn-change-pic'])){ // Change Picture
        $image_name = $_FILES['user-img']['name'];
        $target = '../core/assets/users-pic/' . $_FILES['user-img']['name'];

        $fetchedimage = $globalclass->fetchByTwoID('picture','username','tbluser',$_SESSION['username']); // get picture name

        $users_pic = $fetchedimage->picture;

        if($image_name == null){ // if image name is empty, pass the one fetched from database into the image name
            $newimage = $fetchedimage->picture;
            return;
        }elseif($img_path = '../core/assets/users-pic/' . $users_pic){ 
                unlink($img_path); // remove the image base on the one in database
        }

        $newimage = $image_name; // pass the image name into the new image variable
        $getUserData = $globalclass->selectAll('username','tbluser',$_SESSION['username']); // update image name in database
        move_uploaded_file($_FILES['user-img']['tmp_name'], $target); // move the image into its folder
        $globalclass->update('tbluser', $getUserData->id, array('picture'=>$newimage)); // update image name in database
        $_SESSION['SuccessMessage'] = "Picture has been changed successfully"; // display success message
        return;
    }
?>