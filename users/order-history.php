<?php
    require('../core/init.php');

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
    <title>Order History</title>

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
                <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light"></span> Order History</h4>
                <div class="row">
                    <div class="col-md-12">
                        <div class="card mb-4">
                            <h5 class="card-header fw-bold">Order History</h5>
                            <div class="card-body">
                                <div class="table-responsive text-nowrap">
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Order Details</th>
                                                <th>Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody class="table-border-bottom-0">
                                            <?php $i = 1; foreach($globalclass->fetchUserOrderHistory($getUserData->id) as $gethistory){ ?>
                                            <tr>
                                                <td><?php echo $i++; ?></td>
                                                <td class="m-2">
                                                    <span class="fw-bold mb-4">Order No: <?php echo $gethistory->order_id; ?></span><br>
                                                    <span class="fw-semibold mb-4 small">Order Date: <?php echo $gethistory->order_date; ?></span><br>
                                                    <?php if($gethistory->status == ''): ?>
                                                        <i class="menu-icon tf-icons bx bx-check fw-bold mb-2"></i><span class="badge bg-dark me-1">Waiting for confirmation</span><br>
                                                        <span><i class="menu-icon tf-icons bx bx-car fw-bold mb-2"></i><a href="trackorder?oid=<?php echo htmlentities($gethistory->order_id); ?>" target="_blank">Track order</a></span>
                                                    <?php elseif($gethistory->status == 'Food Delivered'): ?>
                                                        <i class="menu-icon tf-icons bx bx-check fw-bold mb-2"></i><span class="badge bg-success me-1"><?php echo $gethistory->status; ?></span><br>
                                                        <span><i class="menu-icon tf-icons bx bx-car fw-bold mb-2"></i><a href="trackorder?oid=<?php echo htmlentities($gethistory->order_id); ?>" target="_blank">Track order</a></span>
                                                    <?php elseif($gethistory->status == 'Order Cancel'): ?>
                                                        <i class="menu-icon tf-icons bx bx-check fw-bold mb-2"></i><span class="badge bg-danger me-1"><?php echo $gethistory->status; ?></span><br>
                                                        <span><i class="menu-icon tf-icons bx bx-car fw-bold mb-2"></i><a href="trackorder?oid=<?php echo htmlentities($gethistory->order_id); ?>" target="_blank">Track order</a></span>
                                                    <?php else: ?>
                                                        <i class="menu-icon tf-icons bx bx-check fw-bold mb-2"></i><span class="badge bg-warning me-1"><?php echo $gethistory->status; ?></span><br>
                                                        <span><i class="menu-icon tf-icons bx bx-car fw-bold mb-2"></i><a href="trackorder?oid=<?php echo htmlentities($gethistory->order_id); ?>" target="_blank">Track order</a></span>
                                                    <?php endif; ?>
                                                </td>
                                                <td>
                                                <?php if($gethistory->status == 'Food Delivered' || $gethistory->status == 'Food Picked Up' || $gethistory->status == 'Order Cancel'): ?>
                                                    <form method="POST" action="order-details?oid=<?php echo $gethistory->order_id; ?>">
                                                        <button class="btn btn-warning btn-sm" name="btn-view-order" type="submit" data-bs-toggle="tooltip" data-bs-offset="0,4" data-bs-placement="top" data-bs-html="true" title="<span>View Order Details</span>">View Details</button>
                                                        <button class="btn btn-danger btn-sm" onclick="alert('You cannot cancel this order because it has been picked up, cancelled or delivered!');" name="btn-edit-menu" type="submit" data-bs-toggle="tooltip" data-bs-offset="0,4" data-bs-placement="top" data-bs-html="true" title="<span>Cancel Order</span>"><i class="menu-icon tf-icons bx bx-trash"></i></button>
                                                    </form>
                                                <?php else: ?>
                                                    <form method="POST" action="order-details?oid=<?php echo $gethistory->order_id; ?>">
                                                        <button class="btn btn-warning btn-sm" name="btn-view-order" type="submit" data-bs-toggle="tooltip" data-bs-offset="0,4" data-bs-placement="top" data-bs-html="true" title="<span>View Order Details</span>">View Details</button>
                                                        <button class="btn btn-danger btn-sm" name="btn-edit-menu" onclick="return confirm('Cancel this order?');" type="submit" data-bs-toggle="tooltip" data-bs-offset="0,4" data-bs-placement="top" data-bs-html="true" title="<span>Cancel Order</span>"><i class="menu-icon tf-icons bx bx-trash"></i></button>
                                                    </form>
                                                <?php endif; ?>
                                                    
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
