<?php
    include('../core/init.php');

    if(isset($_POST['btn-order'])){ // Add Order
        
        $food_id = $globalclass->validateInput($_POST['food_id']);
        $user_id = $globalclass->validateInput($_POST['user_id']);
        $qty = $globalclass->validateInput($_POST['qty']);
        $price = $globalclass->validateInput($_POST['price']);
        $total = $qty * $price;

        if($globalclass->insertToCart($user_id,$food_id,$qty,$price,$total) === true){
            $globalclass->removeFromMenuPlate($food_id); // remove 1 from the number of plate in the table menu
            $_SESSION['SuccessMessage'] = "Food Has Been Added To Cart";
        }else{
            $_SESSION['ErrorMessage'] = "Failed to Add Food";
        }  
        
    }else if(isset($_POST['btn-remove-cart'])){ // Remove Item From Cart
        $cart_id = $_POST['cart_id'];
        $food_id = $_POST['food_id'];
        $qty = $_POST['qty'];

        if($globalclass->delete('tblorder','id',$cart_id)){ 
            $globalclass->addToMenuPlate($food_id,$qty);
            $_SESSION['SuccessMessage'] = "Food Has Been Removed From Cart";
        }else{
            $_SESSION['ErrorMessage'] = "Failed to Remove Food";
        }
    }else if(isset($_POST['btn-place-order'])){ // Place Order
        
        if(isset($_POST['user-info'])){
            $getUserData = $globalclass->selectAll('username','tbluser',$_SESSION['username']);

            $surname = $getUserData->surname;
            $othername = $getUserData->othername;
            $email = $getUserData->email;
            $phone = $getUserData->phone;
            $address = $getUserData->address;

            $order_total = $_POST['total'];

            $orderID = $globalclass->generateOrderID();

            if(empty($order_total) || $order_total == "0" || $order_total == "0.00"){
                $_SESSION['ErrorMessage'] = "Cart Is Empty";
                return;
            }else if(empty($surname) || empty($othername) || empty($email) || empty($address) || empty($phone)){
                $_SESSION['ErrorMessage'] = "You need to set up your profile details before proceeding";
                return;
            }
            else{
                $order_date = date("d M, Y g:i A");
                $fullname = $surname . " " . $othername;

                if($globalclass->updateOrderID($getUserData->id,$orderID) === true){
                    if($globalclass->insertToOrderAddress($getUserData->id,$orderID,$fullname,$email,$phone,$address,$order_total,$order_date) === true){
                        $_SESSION['SuccessMessage'] = "Order has been placed successfully, your Order No. is {$orderID}";
                    }else{
                        $_SESSION['ErrorMessage'] = "Failed to Place Order";
                    }

                } 
            }
        }
        else{

            $fullname = $globalclass->validateInput($_POST['name']);
            $email = $globalclass->validateInput($_POST['email']);
            $phone = $globalclass->validateInput($_POST['phone']);
            $address = $globalclass->validateInput($_POST['address']);
            $order_total = $_POST['total'];

            $orderID = $globalclass->generateOrderID();

            if(empty($order_total) || $order_total == "0" || $order_total == "0.00"){
                $_SESSION['ErrorMessage'] = "Cart Is Empty";
                return;
            }else if(empty($fullname) || empty($email) || empty($address) || empty($phone)){
                $_SESSION['ErrorMessage'] = "All fields are required";
                return;
            }
            else{
                $getUserData = $globalclass->selectAll('username','tbluser',$_SESSION['username']);
                $order_date = date("d M, Y g:i A");

                if($globalclass->updateOrderID($getUserData->id,$orderID) === true){
                    if($globalclass->insertToOrderAddress($getUserData->id,$orderID,$fullname,$email,$phone,$address,$order_total,$order_date) === true){
                        $_SESSION['SuccessMessage'] = "Order has been placed successfully, your Order No. is {$orderID}";
                    }else{
                        $_SESSION['ErrorMessage'] = "Failed to Place Order";
                    }

                } 
            }
        }
         
    }else if(isset($_POST['btn-update-order'])){ // Update Order Status
        $order_number = $_POST['order_id'];
        $status = $_POST['status'];
        $remark = $_POST['remark'];
        $order_date = date("d M, Y g:i A");
        
        if(empty($status)){
            $_SESSION['ErrorMessage'] = "Select a valid Status";
            return;
        }
        else if(!$globalclass->checkIfExist('tblorderaddress','order_id',$order_number)){ // check if the order number exist
            $_SESSION['ErrorMessage'] = "Invalid Order ID";
            return;
        }else{

            if($globalclass->updateOrderStatus($status,$order_number) === true){
                if($globalclass->insertToTrackFood($order_number,$remark,$status,$order_date) === true){
                    $_SESSION['SuccessMessage'] = "Order details has been updated successfully";
                }else{
                    $_SESSION['ErrorMessage'] = "Failed to Update Order Details";
                }

            } 

        }
        
    }

?>