<?php
    require('../core/validate/add-order.php');

    $getUserData = $globalclass->selectAll('username','tbluser',$_SESSION['username']); 
    $getSession = $globalclass->getSession($_SESSION['username']);

	if(isset($_SESSION['username']))
    {
        if($_SESSION['session_id'] !== $getSession->session){
            header('location: ../index');
        }
    }else{
        header('location: ../index');
    }


?>
    <!-- Css Link -->
    <?php include_once('../includes/css.php'); ?>
    <title>Cart</title>

  </head>

  <body>
    <!-- Layout wrapper -->
    <div class="layout-wrapper layout-content-navbar">
        <div class="layout-container">
            <!-- Menu -->
            <?php include_once('../includes/sidebar.php'); ?>
            
            <!-- / Menu -->

            <!-- Layout container -->
            <div class="layout-page">

            <!-- Navbar -->
            <?php include_once('../includes/navbar.php'); ?>
            <!-- / Navbar -->

            <!-- Content wrapper -->
            <div class="content-wrapper">
                <!-- Content -->

                <div class="container-xxl flex-grow-1 container-p-y">
                    <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light"></span> Cart</h4>
                    <div class="row">
                        <?php
                            echo ErrorMessage();
                            echo SuccessMessage();
                        ?>
                        <div class="col-md-7">
                            <div class="card mb-4">
                                <h5 class="card-header fw-bold"> 
                                    <span class="text-primary"><?php echo $globalclass->getCartNotification($getUserData->id); ?></span> Food in Cart
                                </h5>
                                <div class="card-body">
                                    <div class="row mb-5">
                                        <?php $i = 1; foreach($globalclass->fetchUserCart($getUserData->id) as $fetchcart){ ?>
                                        <div class="col-md-12">
                                            <div class="card mb-3">
                                                <div class="row g-0 shadow-md">
                                                    <div class="col-md-4">
                                                        <img class="card-img card-img-left" src="../core/assets/menu/<?php echo $fetchcart->picture; ?>" alt="food image" />
                                                    </div>
                                                    <div class="col-md-8">
                                                        <div class="card-body" style="scroll-behavior: auto;">
                                                            <h5 class="card-title fw-bold"><?php echo $fetchcart->name; ?></h5>
                                                            <h6 class="small fw-semibold mt-1"><?php echo "₦ " .$fetchcart->price; ?> x <?php echo $fetchcart->qty; ?> <span class="fw-bold" style="float:right; "><?php echo "₦ " .$fetchcart->total; ?></span></h6>
                                                            <p class="card-text small" style="white-space: normal;">
                                                                <?php echo $fetchcart->description; ?>
                                                            </p>
                                                        </div>
                                                        <form method="POST">
                                                            <!-- remove cart button -->
                                                            <div class="col-md-3 mb-3 m-3" style="float:right;">
                                                                <input type="hidden" value="<?php echo $fetchcart->id; ?>" name="cart_id" readonly>
                                                                <input type="hidden" value="<?php echo $fetchcart->qty; ?>" name="qty" readonly>
                                                                <input type="hidden" value="<?php echo $fetchcart->food_id; ?>" name="food_id" readonly>
                                                                <button class="btn btn-danger btn-sm mb-0"  data-bs-toggle="tooltip" data-bs-offset="0,4" data-bs-placement="top" data-bs-html="true" title="<span>Remove Food</span>" onclick="return confirm('Remove this Item');" name="btn-remove-cart" type="submit"><i class="menu-icon tf-icons bx bx-trash"></i></button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                            <?php } ?>
                                        
                                        <?php if($globalclass->fetchUserCart($getUserData->id)): ?>
                                        <div class="col-md-12 mt-3" style="float: right;">
                                            <label class="fw-semibold h5">Sub Total: <span class="fw-bold" >₦ <?php echo $globalclass->getCartSum($getUserData->id); ?></span></label>
                                        </div>
                                        <?php endif; ?>
                                    </div>

                                    <!-- if cart is empty -->
                                    <?php if(!$globalclass->fetchUserCart($getUserData->id)): ?>
                                        <h5 class="text-center text-dark mt-2"><i class="flex-shrink-0 bx bx-sad me-2 " style="font-size: 30px;"></i>Cart Is Empty</h5>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Billing Address -->
                        <div class="col-md-5">
                            <div class="card mb-4">
                                <h5 class="card-header fw-bold">Billing Address</h5>
                                <div class="card-body">
                                    <form method="POST">
                                        <div class="row">
                                            <div class="col-md-12 mb-3">
                                                <label for="defaultFormControlInput" class="form-label">Name</label>
                                                <input type="text" class="form-control" name="name" id="defaultFormControlInput" placeholder="Enter your Name" aria-describedby="defaultFormControlHelp" />
                                            </div>
                                            <div class="col-md-12 mb-3">
                                                <label for="defaultFormControlInput" class="form-label">Email</label>
                                                <input type="email" class="form-control" name="email" id="defaultFormControlInput" placeholder="Enter your Email" aria-describedby="defaultFormControlHelp" />
                                            </div>
                                            <div class="col-md-12 mb-3">
                                                <label for="defaultFormControlInput" class="form-label">Phone No</label>
                                                <input type="text" name="phone" class="form-control" id="defaultFormControlInput" placeholder="Enter Phone No" aria-describedby="defaultFormControlHelp" />
                                            </div>
                                            <div class="col-md-12 mb-3">
                                                <label for="exampleFormControlTextarea1" class="form-label">Address</label>
                                                <textarea class="form-control" name="address" id="exampleFormControlTextarea1" rows="3" placeholder="Enter Address" ></textarea>
                                            </div>
                                                <label class="text-center fw-bold">OR</label>
                                            <div class="col-md-12 mb-3">
                                                <div class="form-check mt-3 align-center">
                                                    <label class="form-check-label" for="defaultRadio1"> Use my profile details</label>
                                                    <input class="form-check-input" type="radio" value="" id="defaultRadio1" name="user-info"/>
                                                </div>
                                            </div>
                                            <div class="mb-3">
                                                <input type="hidden" value="<?php echo $globalclass->getCartSum($getUserData->id); ?>" name="total" readonly>
                                                <button class="btn btn-dark form-control" name="btn-place-order" type="submit">Place Order</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- / Content -->

                <!-- Footer -->
                <?php include_once('../includes/footer.php'); ?>
                <!-- / Footer -->

                
            </div>
          <!-- Content wrapper -->
        </div>
        <!-- / Layout page -->
      </div>

      <!-- Overlay -->
      <div class="layout-overlay layout-menu-toggle"></div>
    </div>
    <!-- / Layout wrapper -->

    <!-- Core JS -->
    <?php include_once('../includes/js.php'); ?>

  </body>
</html>
