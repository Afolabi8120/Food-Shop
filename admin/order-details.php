<?php
    require('../core/validate/add-order.php');

    $getUserData = $globalclass->selectAll('username','tbluser',$_SESSION['admin']); 
    $getSession = $globalclass->getSession($_SESSION['admin']);

    if(isset($_GET['oid'])){
        $order_id = $_GET['oid'];
    }else{
        $order_id = '';
    }

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
                <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light"></span> Order Details</h4>
                <div class="row">
                    <?php
                        echo ErrorMessage();
                        echo SuccessMessage();
                    ?>
                    <div class="col-md-8">
                        <div class="card mb-4">
                            <h5 class="card-header fw-bold">Order Details</h5>
                            <div class="card-body">
                                <div class="table-responsive">
                                <table class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <th colspan="6">
                                                    <h6 class="text-center">Invoice of <span class="text-dark h5 fw-semibold"><?php echo $order_id; ?></span></h6>
                                                </th>
                                            </tr>
                                        </thead>
                                        <tbody class="table-border-bottom-0">
                                            <?php foreach($globalclass->selectByOne('tblorderaddress','order_id',$order_id) as $getuser){ ?>
                                            <tr>
                                                <td>Name: </td>
                                                <td class="fw-semibold"><?php echo $getuser->name; ?></td>
                                                <td>Email: </td>
                                                <td><?php echo $getuser->email; ?></td>
                                            </tr>
                                            <tr>
                                                <td>Phone No:</td>
                                                <td><?php echo $getuser->phone; ?></td>
                                                <td>Ordered Date/Time:</td>
                                                <td><?php echo $getuser->order_date; ?></td>
                                            </tr>
                                            <tr>
                                                <td colspan="4">Address: <?php echo $getuser->address; ?></td>
                                            </tr>
                                            <?php } ?>

                                            <tr class="text-center fw-bold">
                                                <td colspan="4">List of Food Ordered </td>
                                            </tr>
                                            <tr class="text-center fw-bold">
                                                <td>#</td>
                                                <td>Food Name</td>
                                                <td>Price/Qty</td>
                                                <td>Sub Total</td>
                                            </tr>
                                            <?php foreach($globalclass->fetchInvoice2($order_id) as $getcart){ ?>
                                            <tr class="text-center fw-semibold">
                                                <td><img src="../core/assets/menu/<?php echo $getcart->picture; ?>" alt="food image" class="rounded-circle avatar avatar-md pull-up" /></td>
                                                <td><?php echo $getcart->name; ?></td>
                                                <td><?php echo $getcart->price . " x " . $getcart->qty; ?></td>
                                                <td>₦ <?php echo $getcart->total; ?></td>
                                            </tr>
                                            <?php } ?>

                                            <?php foreach($globalclass->selectByOne('tblorderaddress','order_id',$order_id) as $getuser){ ?>
                                            <tr class="text-center fw-bold">
                                                <td>Order Status</td>
                                                <td>
                                                    <?php if($getuser->status == ''): ?>
                                                        <span class="badge bg-dark me-1">Waiting for confirmation</span><br>
                                                    <?php elseif($getuser->status == 'Food Delivered'): ?>
                                                        <span class="badge bg-success me-1"><?php echo $getuser->status; ?></span>
                                                    <?php elseif($getuser->status == 'Order Cancel'): ?>
                                                        <span class="badge bg-danger me-1"><?php echo $getuser->status; ?></span>
                                                    <?php else: ?>
                                                        <span class="badge bg-warning me-1"><?php echo $getuser->status; ?></span>
                                                    <?php endif; ?>
                                                </td>
                                                <td>Grand Total</td>
                                                <td>₦ <?php echo $getuser->order_total; ?></td>
                                            </tr>
                                            <?php } ?>

                                            <?php if($getUserData->usertype == "User"): ?>
                                            <tr class="text-center fw-bold">
                                                <td colspan="4">Food Tracking History</td>
                                            </tr>

                                            <tr class="text-center fw-bold">
                                                <td>#</td>
                                                <td>Remark</td>
                                                <td>Status</td>
                                                <td>Date/Time</td>
                                            </tr>
                                            <?php $i = 1;foreach($globalclass->selectByOne('tbltrackfood','order_id',$order_id) as $trackorder){ ?>
                                            <tr>
                                                <td><?php echo $i++; ?></td>
                                                <td><?php echo $trackorder->remark; ?></td>
                                                <td><?php echo $trackorder->status; ?> (by Admin)</td>
                                                <td><?php echo $trackorder->date; ?></td>
                                            </tr>
                                            <?php } ?>

                                            <?php endif; ?>
                                            
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4">
                            <div class="card mb-4">
                                <h5 class="card-header fw-bold">Add Remark</h5>
                                <div class="card-body">
                                    <form method="POST">
                                        <div class="row">
                                            <div class="col-md-12 mb-3">
                                                <label for="defaultFormControlInput" class="form-label">Status</label>
                                                <select class="form-select" required name="status" id="exampleFormControlSelect1" aria-label="Default select example" required>
                                                    <option value="Order Confirm">Order Confirm</option>
                                                    <option value="Order Cancel">Order Cancel</option>
                                                    <option value="Food being Prepared">Food being Prepared</option>
                                                    <option value="Food Picked Up">Food Picked Up</option>
                                                    <option value="Food Delivered">Food Delivered</option>
                                                </select>
                                            </div>
                                            <div class="col-md-12 mb-3">
                                                <label for="exampleFormControlTextarea1" class="form-label">Restaurant Remark</label>
                                                <textarea class="form-control" name="remark" id="exampleFormControlTextarea1" rows="3" placeholder="Enter Remark" required></textarea>
                                            </div>
                                            <div class="mb-3">
                                                <input type="hidden" value="<?php echo $order_id; ?>" name="order_id" readonly>
                                                <?php foreach($globalclass->selectByOne('tblorderaddress','order_id',$order_id) as $getfood){ ?>
                                                    <?php if($getfood->status == "Food Delivered"): ?>
                                                        <a href="#" class="btn btn-success form-control">Food Delivered</a>
                                                    <?php elseif($getfood->status == "Order Cancel"): ?>
                                                        <a href="#" class="btn btn-danger form-control">Order Cancelled</a>
                                                    <?php else: ?>
                                                        <button class="btn btn-dark form-control" name="btn-update-order" type="submit">Update Order</button>
                                                    <?php endif; ?>
                                                <?php } ?>
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
