<?php
    require('../core/init.php');

    $getUserData = $globalclass->selectAll('username','tbluser',$_SESSION['username']); 
    $getSession = $globalclass->getSession($_SESSION['username']);

    if(isset($_GET['oid'])){
        $order_id = $_GET['oid'];
    }else{
        $order_id = '';
    }

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
    <title>Track Order</title>

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
                <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light"></span> Track Order</h4>
                <div class="row">
                    <div class="col-md-12">
                        <div class="card mb-4">
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th colspan="6"><h6 class="text-center">Food Tracking History of <span class="text-dark h5 fw-semibold"><?php echo $_GET['oid']; ?></span></h6></th>
                                            </tr>
                                            <tr class="text-center">
                                                <th>#</th>
                                                <th>Remark</th>
                                                <th>Status</th>
                                                <th>Time</th>
                                            </tr>
                                        </thead>
                                        <tbody class="table-border-bottom-0">
                                            <?php $i = 1; foreach($globalclass->selectByOne('tbltrackfood','order_id',$order_id) as $trackfood){ ?>
                                            <tr>
                                                <td><?php echo $i++; ?></td>
                                                <td><?php echo $trackfood->remark; ?></td>
                                                <td><?php echo $trackfood->status; ?> (by Admin)<td>
                                                <td><?php echo $trackfood->date; ?><td>
                                            </tr>
                                            <?php } ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>

                            <!-- if there's nothing to track -->
                            <?php if(!$globalclass->selectByOne('tbltrackfood','order_id',$order_id)): ?>
                                <h5 class="text-center text-dark mt-2"><i class="flex-shrink-0 bx bx-sad me-2 " style="font-size: 30px;"></i>Nothing to Track</h5>
                            <?php endif; ?>
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
