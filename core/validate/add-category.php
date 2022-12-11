<?php
    include('../core/init.php');

    if(isset($_POST['btn-save-category'])){ // Save Category
        
        $catname = $globalclass->validateInput($_POST['name']);

        if(empty($catname)){
            $_SESSION['ErrorMessage'] = "All fields are required";
            return;
        }
        else if(!preg_match("/^[a-z A-Z]*$/", $catname)){
            // Using regular expression to check if the user inputs a valid name
            $_SESSION['ErrorMessage'] = "Only Alphabet is allowed for the category field";
            return;
        }
        else if($globalclass->checkIfExist('tblcategory','name',$catname) === true){ # to check if category name exist
            $_SESSION['ErrorMessage'] = "Category name already exist";
            return;
        }else{  
            // save category name to database
            $globalclass->create('tblcategory', array('name'=>$catname));
            $_SESSION['SuccessMessage'] = "Category added successfully";
            return;
        }
        
    }else if(isset($_POST['btn-delete-menu'])){ // Delete Category
        $cat_id = $_POST['cat_id'];

        if($globalclass->delete('tblcategory','id',$cat_id)){ 
            $_SESSION['SuccessMessage'] = "Category has been removed successfully";
        }else{
            $_SESSION['ErrorMessage'] = "Failed to remove category";
        }
    }

?>