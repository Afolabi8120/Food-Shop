<?php
    include('../core/init.php');

    if(isset($_POST['btn-save-storename'])){ // Save Store Info

        $name = $globalclass->validateInput($_POST['name']);
        $email = $globalclass->validateInput($_POST['email']);
        $phone = $globalclass->validateInput($_POST['phone']);
        $address = $globalclass->validateInput($_POST['address']);

        $image_name = $_FILES['logo']['name'];
        $target = '../core/assets/store-logo/' . $_FILES['logo']['name'];

        if(empty($name) || empty($email) || empty($email) || empty($phone) || empty($address)){
            $_SESSION['ErrorMessage'] = "All fields are required";
            return;
        }elseif($image_name == null){ // if image name is empty
            $_SESSION['ErrorMessage'] = "Please upload a logo";
            return;
        }
        else{

            $fetchedimage = $globalclass->selectStore('tblstorename'); // get picture name

            $logo = $fetchedimage->picture;
            if($img_path = '../core/assets/store-logo/' . $logo){ 
                unlink($img_path); // remove the image base on the one in database
                // delete all record stored 
                $globalclass->deleteAll('tblstorename');
            }

           // save store name to database
           $globalclass->create('tblstorename', array('name'=>$name,'email'=>$email,'phone'=>$phone,'picture'=>$image_name,'address'=>$address));
           move_uploaded_file($_FILES['logo']['tmp_name'], $target); 
           $_SESSION['SuccessMessage'] = "Store Details has been set successfully";
            
        }
        
    }

?>