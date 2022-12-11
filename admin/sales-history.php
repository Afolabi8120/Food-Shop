<?php
    require('../core/init.php');

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
    <title>Sales History</title>

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
                <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light"></span> Sales History</h4>
                <div class="row">
                    <div class="col-md-12">
                        <div class="card mb-4">
                            <h5 class="card-header fw-bold">All Sales History</h5>
                            <div class="card-body">
                                <div class="table-responsive text-nowrap">
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Customer Name</th>
                                                <th>Amount</th>
                                                <th>Status</th>
                                                <th>Date Ordered</th>
                                                <th>Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody class="table-border-bottom-0">
                                            <?php $i = 1; foreach($globalclass->select('tblorderaddress') as $history){ ?>
                                            <tr>
                                                <td><?php echo $i++; ?></td>
                                                <td><i class="fab fa-angular fa-lg text-danger me-3"></i> <strong><?php echo $history->name; ?></strong></td>
                                                <td><?php echo $history->order_total; ?></td>
                                                <?php if($history->status == ''): ?>
                                                    <td><span class="badge bg-dark me-1">Waiting for Confirmation</span></td>
                                                <?php elseif($history->status == 'Food Delivered'): ?>
                                                    <td><span class="badge bg-success me-1"><?php echo $history->status; ?></span></td>
                                                <?php elseif($history->status == 'Order Cancel'): ?>
                                                    <td><span class="badge bg-danger me-1">Order Cancelled</span></td>
                                                <?php else: ?>
                                                    <td><span class="badge bg-warning me-1"><?php echo $history->status; ?></span></td>
                                                <?php endif; ?>
                                                <td><span class="badge bg-dark me-1"><?php echo $history->order_date; ?></span></td>
                                                <td>
                                                    <form method="POST" action="order-details?oid=<?php echo $history->order_id; ?>">
                                                        <button class="btn btn-warning btn-sm" name="btn-edit-menu" type="submit" data-bs-toggle="tooltip" data-bs-offset="0,4" data-bs-placement="top" data-bs-html="true" title="<span>View Order</span>"><i class="menu-icon tf-icons bx bx-face"></i></button>
                                                    </form>
                                                </td>
                                                <?php } ?>
                                            </tr>
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
