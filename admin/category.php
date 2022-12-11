<?php
    require('../core/validate/add-category.php');

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
    <title>Category</title>

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
                <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light"></span> Add Category</h4>
                <div class="row">
                    <?php
                        echo ErrorMessage();
                        echo SuccessMessage();
                    ?>
                    <div class="col-md-5">
                        <div class="card mb-4">
                            <h5 class="card-header fw-bold">Category</h5>
                            <div class="card-body">
                                <form method="POST" enctype="multipart/form-data">
                                    <div class="row">
                                        <div class="col-md-12 mb-3">
                                            <label for="defaultFormControlInput" name="name" class="form-label">Category Name</label>
                                            <input type="text" class="form-control" id="defaultFormControlInput" name="name" placeholder="E.g Rice..." aria-describedby="defaultFormControlHelp" required/>
                                        </div>
                                        <div class="mb-3">
                                            <button class="btn btn-primary " name="btn-save-category" type="submit">Save</button>
                                            <a href="dashboard" class="btn btn-danger ">Back</a>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>


                    <div class="col-md-7">
                        <div class="card mb-4">
                            <h5 class="card-header fw-bold">All Category</h5>
                            <div class="card-body">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Category Name</th>
                                            <th>Date Created</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                        <tbody class="table-border-bottom-0">
                                            <?php $i = 1; foreach($globalclass->select('tblcategory') as $getcategory){ ?>
                                            <tr>
                                                <td><?php echo $i++; ?></td>
                                                <td><?php echo $getcategory->name; ?></td>
                                                <td class="small"><span class="badge bg-dark me-1"><?php echo $getcategory->date_added; ?></span></td>
                                                <td>
                                                    <form method="POST">
                                                        <input type="hidden" value="<?php echo $getcategory->id; ?>" name="cat_id" readonly>
                                                        <button class="btn btn-danger btn-sm mb-2" onclick="return confirm('Remove Category?');" name="btn-delete-menu" type="submit"><i class="menu-icon tf-icons bx bx-trash"></i></button>
                                                    </form>
                                                </td>
                                            </tr>
                                            <?php } ?>
                                        </tbody>
                                    </table>
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
