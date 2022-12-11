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
    <title>Dashboard</title>

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
                    <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light"></span> Menu</h4>
                    
                    <div class="row">
                        <div class="col-md-12">
                        <?php
                            echo ErrorMessage();
                            echo SuccessMessage();
                        ?>
                            <div class="card overflow-hidden mb-4">
                                <h5 class="card-header fw-bold">Our Menu</h5>
                                <div class="card-body">
                                    <div class="row">
                                        <?php foreach($globalclass->selectByOne('tblmenu','status','Available') as $getfood){ ?>
                                        <div class="col-lg-3 col-md-3 mb-4">
                                            <div class="card">
                                                <div class="card-body">
                                                    <div class="card-title d-flex align-items-start justify-content-center">
                                                        <img src="../core/assets/menu/<?php echo $getfood->picture; ?>" alt="food image" class="rounded" width="200px" height="100px" />
                                                    </div>
                                                    <h5 class="card-title fw-bold text-center small"><?php echo $getfood->name; ?></h5>
                                                    <h5 class="card-text text-center mb-3 small"><span class="text-dark fw-bold mb-3 h6">₦ <?php echo $getfood->price; ?></span></h5>
                                                    
                                                    <?php if($getfood->plate > 0): ?>
                                                    <h6 class="card-text small text-center mb-3 "><?php echo $getfood->plate; ?> plates available</h6>
                                                    <?php endif; ?>
                                                    <p class="card-text small text-center mb-3 "><?php echo substr($getfood->description, 0, 30).'....'; ?> </p>
                                                    <form method="POST">
                                                        <input type="hidden" value="<?php echo $getfood->id; ?>" name="food_id" readonly>
                                                        <input type="hidden" value="<?php echo $getUserData->id; ?>" name="user_id" readonly>
                                                        <input type="hidden" value="1" name="qty" readonly>
                                                        <input type="hidden" value="<?php echo $getfood->price; ?>" name="price" readonly>
                                                        <button class="btn btn-dark d-grid w-100" name="btn-order" type="submit" >Order Now</button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                        <?php } ?>
                                        <?php if(!$globalclass->selectByOne('tblmenu','status','Available')): ?>
                                            <h3 class="text-center"><i class="flex-shrink-0 bx bx-sad me-2 " style="font-size: 30px;"></i>Sorry, No Food Is Available Yet</h3>
                                        <?php endif; ?>
                                    </div>
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
