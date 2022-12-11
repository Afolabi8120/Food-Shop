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
    <title>Customer</title>

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
                <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light"></span> Customers</h4>

                <div class="row">
                    <div class="col-md-12">
                        <?php
                            echo ErrorMessage();
                            echo SuccessMessage();
                        ?>
                        <div class="card mb-4">
                            <h5 class="card-header fw-bold">Customer(s)</h5>
                            <div class="card-body">
                                <div class="table-responsive text-nowrap">
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Picture</th>
                                                <th>Fullname</th>
                                                <th>Email</th>
                                                <th>Phone No</th>
                                                <th>Status</th>
                                                <th>Reg Date</th>
                                                <th>Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody class="table-border-bottom-0">
                                            <?php $i = 1; foreach($globalclass->selectByOne('tbluser','usertype','User') as $getadmin){ ?>
                                            <tr>
                                                <td><?php echo $i++; ?></td>
                                                <td><img src="../core/assets/users-pic/<?php echo $getadmin->picture; ?>" alt="Avatar" class="rounded-circle avatar avatar-md pull-up" />
                                                </td>
                                                <td><i class="fab fa-angular fa-lg text-danger me-3"></i> <strong><?php echo $getadmin->surname . " " . $getadmin->othername; ?></strong></td>
                                                <td><?php echo $getadmin->email; ?></td>
                                                <td><?php echo $getadmin->phone; ?></td>
                                                <?php if($getadmin->status == "Active"): ?>
                                                    <td><span class="badge bg-success me-1"><?php echo $getadmin->status; ?></span></td>
                                                <td><span class="badge bg-dark me-1"><?php echo $getadmin->reg_date; ?></span></td>
                                                <td>
                                                    <form method="POST">
                                                        <input type="hidden" value="<?php echo $getadmin->id; ?>" name="user_id" readonly>
                                                        <button class="btn btn-warning btn-sm" name="btn-disable-user" onclick="return confirm('Disable this User?');" type="submit"><i class="menu-icon tf-icons bx bx-lock"></i></button>
                                                        <button class="btn btn-danger btn-sm" name="btn-delete-user" onclick="return confirm('Remove this User Account?');" type="submit"><i class="menu-icon tf-icons bx bx-trash"></i></button>
                                                    </form>
                                                </td>
                                                <?php elseif($getadmin->status == "In-active"): ?>
                                                <td><span class="badge bg-danger me-1"><?php echo $getadmin->status; ?></span></td>
                                                <td><span class="badge bg-dark me-1"><?php echo $getadmin->reg_date; ?></span></td>
                                                <td>
                                                    <form method="POST">
                                                        <input type="hidden" value="<?php echo $getadmin->id; ?>" name="user_id" readonly>
                                                        <button class="btn btn-success btn-sm" name="btn-enable-user" onclick="return confirm('Enable this User?');" type="submit"><i class="menu-icon tf-icons bx bx-lock-open"></i></button>
                                                        <button class="btn btn-danger btn-sm" name="btn-delete-user" onclick="return confirm('Remove this User Account?');" type="submit"><i class="menu-icon tf-icons bx bx-trash"></i></button>
                                                    </form>
                                                </td>
                                                <?php endif; ?>
                                            </tr>
                                            <?php } ?>
                                        </tbody>
                                    </table>
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
