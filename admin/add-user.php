<?php
    require('../core/validate/add-user.php');

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
    <title>Manage User</title>

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
                <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Users /</span> Add User</h4>
                <div class="row">
                    <div class="col-md-12">
                        <?php
                            echo ErrorMessage();
                            echo SuccessMessage();
                        ?>
                        <div class="card mb-4">
                            <h5 class="card-header fw-bold">Add User</h5>
                            <div class="card-body">
                                <form method="POST" enctype="multipart/form-data">
                                    <div class="row">
                                        <div class="col-md-4 mb-3">
                                            <label for="defaultFormControlInput" class="form-label">Username</label>
                                            <input type="text" class="form-control" name="username" id="defaultFormControlInput" placeholder="Enter your Username" aria-describedby="defaultFormControlHelp" required/>
                                        </div>
                                        <div class="col-md-4 mb-3">
                                            <label for="defaultFormControlInput" class="form-label">Surname</label>
                                            <input type="text" class="form-control" name="surname" id="defaultFormControlInput" placeholder="Enter your Fullname" aria-describedby="defaultFormControlHelp" required/>
                                        </div>
                                        <div class="col-md-4 mb-3">
                                            <label for="defaultFormControlInput" class="form-label">Other Names</label>
                                            <input type="text" class="form-control" name="othername" id="defaultFormControlInput" placeholder="Enter your Fullname" aria-describedby="defaultFormControlHelp" required/>
                                        </div>
                                        <div class="col-md-4 mb-3">
                                            <label for="exampleFormControlSelect1" class="form-label">Gender</label>
                                            <select class="form-select" name="gender" id="exampleFormControlSelect1" aria-label="Default select example" required>
                                            <option selected disabled>Select Gender</option>
                                            <option value="Male">Male</option>
                                            <option value="Female">Female</option>
                                            </select>
                                        </div>
                                        <div class="col-md-4 mb-3">
                                            <label for="defaultFormControlInput" class="form-label">Password</label>
                                            <input type="password" id="password" class="form-control" name="password" placeholder="Enter your password" aria-describedby="password" required/>
                                        </div>
                                        <div class="col-md-4 mb-3">
                                            <label for="defaultFormControlInput" class="form-label">Confirm Password</label>
                                            <input type="password" id="password" class="form-control" name="cpassword" placeholder="Confirm your password" aria-describedby="password" required/>
                                        </div>
                                        <div class="col-md-4 mb-3">
                                            <label for="defaultFormControlInput" class="form-label">Email</label>
                                            <input type="email" class="form-control" name="email" id="defaultFormControlInput" placeholder="Enter your Email" aria-describedby="defaultFormControlHelp" required/>
                                        </div>
                                        <div class="col-md-4 mb-3">
                                            <label for="defaultFormControlInput" class="form-label">Phone No</label>
                                            <input type="text" name="phone" class="form-control" id="defaultFormControlInput" placeholder="Enter Phone No" aria-describedby="defaultFormControlHelp" required/>
                                        </div>
                                        <div class="col-md-4 mb-3">
                                            <label for="formFile" class="form-label">Profile Image</label>
                                            <input class="form-control" name="user-img" type="file" accept=".png, .jpg" id="formFile" required/>
                                        </div>
                                        <div class="col-md-12 mb-3">
                                            <label for="exampleFormControlTextarea1" class="form-label">Address</label>
                                            <textarea class="form-control" name="address" id="exampleFormControlTextarea1" rows="3" placeholder="Enter Address"></textarea>
                                        </div>
                                        <div class="mb-3">
                                            <button class="btn btn-primary " name="btn-save-user" type="submit">Save</button>
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
