<?php
    require('../core/validate/change-password.php');

    $getUserData = $globalclass->selectAll('username','tbluser',$_SESSION['admin']); 
    $getSession = $globalclass->getSession($_SESSION['admin']);

	if(isset($_SESSION['admin']))
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
    <title>Change Password</title>

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
                <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light"></span> Change Password</h4>
                <div class="row">
                    <?php
                        echo ErrorMessage();
                        echo SuccessMessage();
                    ?>
                    <div class="col-md-5">
                        <div class="card mb-4">
                            <h5 class="card-header fw-bold">Change Password</h5>
                            <div class="card-body">
                                <form method="POST" >
                                    <div class="row">
                                        <div class="col-md-12 mb-3">
                                            <label for="defaultFormControlInput" class="form-label">Old Password</label>
                                            <input type="password" class="form-control" id="defaultFormControlInput" name="old-password" placeholder="Enter Old Password" aria-describedby="defaultFormControlHelp" required/>
                                        </div>
                                        <div class="col-md-12 mb-3">
                                            <label for="defaultFormControlInput" class="form-label">New Password</label>
                                            <input type="password" class="form-control" id="defaultFormControlInput" name="new-password" placeholder="Enter New Password" aria-describedby="defaultFormControlHelp" required/>
                                        </div>
                                        <div class="col-md-12 mb-3">
                                            <label for="defaultFormControlInput" class="form-label">Confirm New Password</label>
                                            <input type="password" class="form-control" id="defaultFormControlInput" name="cnew-password" placeholder="Confirm New Password" aria-describedby="defaultFormControlHelp" required/>
                                        </div>
                                        <div class="mb-3">
                                            <button class="btn btn-primary " name="btn-change-password" type="submit">Change Password</button>
                                            <a href="dashboard" class="btn btn-danger ">Back</a>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>


                    <div class="col-md-7">
                        <div class="card mb-4">
                            <h5 class="card-header fw-bold">Change Picture</h5>
                            <div class="card-body">
                                <form method="POST" enctype="multipart/form-data">
                                    <div class="row">
                                        <div class="col-md-12 mb-3">
                                            <img src="../core/assets/users-pic/<?php echo $getUserData->picture; ?>" alt="User Picture" class="rounded-circle" height="100px" width="100px" />
                                        </div>
                                        <div class="col-md-12 mb-3">
                                            <label for="formFile" class="form-label">Profile Image</label>
                                            <input class="form-control" name="user-img" accept=".png, .jpg" type="file" id="formFile" />
                                        </div>
                                        <div class="mb-3">
                                            <button class="btn btn-primary " name="btn-change-pic" type="submit">Update</button>
                                            <a href="dashboard" class="btn btn-danger ">Back</a>
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

            <div class="content-backdrop fade"></div>
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
