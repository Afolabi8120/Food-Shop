<?php
    require('../core/validate/add-menu.php');

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
    <title>Add Menu</title>

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
                <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Menu /</span> Add Menu</h4>
                <div class="row">
                    <div class="col-md-12">
                        <?php
                            echo ErrorMessage();
                            echo SuccessMessage();
                        ?>
                        <div class="card mb-4">
                            <h5 class="card-header fw-bold">Add Menu</h5>
                            <div class="card-body">
                                <form method="POST" enctype="multipart/form-data">
                                    <div class="row">
                                        <div class="col-md-5 mb-3">
                                            <label for="defaultFormControlInput" class="form-label">Food Name</label>
                                            <input type="text" class="form-control" name="name" id="defaultFormControlInput" placeholder="E.g Rice..." aria-describedby="defaultFormControlHelp" required/>
                                        </div>
                                        <div class="col-md-3 mb-3">
                                            <label for="defaultFormControlInput" class="form-label">Price</label>
                                            <input type="text" class="form-control" name="price" id="defaultFormControlInput" placeholder="E.g 120" aria-describedby="defaultFormControlHelp" required/>
                                        </div>
                                        <div class="col-md-4 mb-3">
                                            <label for="exampleFormControlSelect1" class="form-label">Category</label>
                                            <select class="form-select" name="category" id="exampleFormControlSelect1" aria-label="Default select example" required>
                                                <option selected disabled>Select Category</option>
                                            <?php foreach($globalclass->select('tblcategory') as $getcategory){ ?>
                                                <option value="<?php echo $getcategory->id; ?>"><?php echo $getcategory->name; ?></option>
                                            <?php } ?>
                                            </select>
                                        </div>
                                        <div class="col-md-5 mb-3">
                                            <label for="formFile" class="form-label">Food Image</label>
                                            <input class="form-control" name="food-img" accept=".png, .jpg" type="file" id="formFile" required/>
                                        </div>
                                        <div class="col-md-3 mb-3">
                                            <label for="defaultFormControlInput" class="form-label">No. of Plate Available (optional)</label>
                                            <input type="text" class="form-control" name="plate" id="defaultFormControlInput" placeholder="E.g 2" aria-describedby="defaultFormControlHelp" required/>
                                        </div>
                                        <div class="col-md-4 mb-3">
                                            <label for="exampleFormControlSelect1" class="form-label">Status</label>
                                            <select class="form-select" name="status" id="exampleFormControlSelect1" aria-label="Default select example" required>
                                            <option selected disabled>Select Status</option>
                                            <option value="Available">Available</option>
                                            <option value="Not Available">Not Available</option>
                                            </select>
                                        </div>
                                        <div class="col-md-12 mb-3">
                                            <label for="exampleFormControlTextarea1" class="form-label">Description</label>
                                            <textarea class="form-control" name="description" id="exampleFormControlTextarea1" rows="3"></textarea>
                                        </div>
                                        <div class="mb-3">
                                            <button class="btn btn-primary " name="btn-save-menu" type="submit">Save</button>
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
