<?php
    include('../core/init.php');

    if(isset($_POST['btn-save-menu'])){ // Save Menu

        $name = $globalclass->validateInput($_POST['name']);
        $price = $globalclass->validateInput($_POST['price']);
        $category = $globalclass->validateInput($_POST['category']);;
        $plate = $globalclass->validateInput($_POST['plate']);
        $status = $globalclass->validateInput($_POST['status']);
        $description = $globalclass->validateInput($_POST['description']);

        $date = date("d M, Y g:i A");

        $image_name = $_FILES['food-img']['name'];
        $target = '../core/assets/menu/' . $_FILES['food-img']['name'];

        if(empty($name) || empty($price) || empty($category) || empty($plate) || empty($status) || empty($description)){
            $_SESSION['ErrorMessage'] = "All fields are required";
            return;
        }
        elseif(!preg_match("/^[a-z A-Z]*$/", $name)){
            // Using regular expression to check if the user inputs a valid name
            $_SESSION['ErrorMessage'] = "Only Alphabet is allowed for the food name field";
            return;
        }
        else if($globalclass->checkIfExist('tblcategory','name',$name) === true){ # to check if name exist
            $_SESSION['ErrorMessage'] = "Food name already exist";
            return;
        }
        else{

           // save menu to database
           $globalclass->create('tblmenu', array('name'=>$name,'price'=>$price,'category_id'=>$category,'plate'=>$plate,'picture'=>$image_name,'status'=>$status,'description'=>$description,'date_added'=>$date));
           move_uploaded_file($_FILES['food-img']['tmp_name'], $target); 
           $_SESSION['SuccessMessage'] = "Menu has been created successfully";
            
        }
        
    }else if(isset($_POST['btn-disable-menu'])){ // Disable Menu
        $menu_id = $_POST['menu_id'];

        if($globalclass->enableUser('tblmenu','status','Not Available',$menu_id)){ 
            $_SESSION['SuccessMessage'] = "Menu has been deactivated successfully";
            return;
        }
    }else if(isset($_POST['btn-enable-menu'])){ // Enable Menu
        $menu_id = $_POST['menu_id'];

        if($globalclass->enableUser('tblmenu','status','Available',$menu_id)){ 
            $_SESSION['SuccessMessage'] = "Menu has been activated successfully";
            return;
        }
    }else if(isset($_POST['btn-delete-menu'])){ // Delete Menu
        $menu_id = $_POST['menu_id'];

        $fetchedimage = $globalclass->fetchByTwoID('picture','id','tblmenu',$menu_id); // get picture name

        $food_pic = $fetchedimage->picture;
        if($img_path = '../core/assets/menu/' . $food_pic){ 
            unlink($img_path); // remove the image base on the one in database
            $globalclass->delete('tblmenu','id',$menu_id); // remove menu from database
            $_SESSION['SuccessMessage'] = "Menu have been removed successfully";
        }

        
        
    }

?>