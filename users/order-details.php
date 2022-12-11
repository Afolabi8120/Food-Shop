<?php
    require('../core/init.php');

    $getUserData = $globalclass->selectAll('username','tbluser',$_SESSION['username']); 
    $getSession = $globalclass->getSession($_SESSION['username']);

    #$order_id = $_GET['oid'];
    #echo var_dump($globalclass->selectAll('order_number','tblorder',$order_id));exit();

    if(isset($_GET['oid']) && !empty($_GET['oid'])){
        $order_id = $_GET['oid']; // passing the value from the url into the order_id variable
        if($globalclass->selectAll('order_number','tblorder',$order_id)){ #if order id exist
            $order_id = $_GET['oid'];
        }else{ // if order id does not exist, sleep for 1 second
            sleep(1);
            echo "Invalid Request";
            exit();
        }
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
    <title>Order Details</title>

  </head>

  <body>

            <div class="container-xxl flex-grow-1 container-p-y">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card mb-4">
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <th colspan="6">
                                                    <p class="text-center">
                                                        <span><img src="../core/assets/store-logo/<?php echo $getstore->picture; ?>" alt="site logo" class="rounded-circle avatar avatar-md pull-up m-3" /></span><br>
                                                        <span class="text-dark h5 fw-semibold mb-3"><?php echo $getstore->name; ?><br></span>
                                                        <span class="text-dark h6 fw-semibold small"><?php echo $getstore->email; ?><br></span>
                                                        <span class="text-dark h5 fw-semibold small"><?php echo $getstore->phone; ?><br></span>
                                                        <span class="text-dark h5 fw-semibold small"><?php echo $getstore->address; ?><br></span>
                                                    </p>
                                                </th>
                                            </tr>
                                            <tr>
                                                <th colspan="6"><h6 class="text-center">Invoice of <span class="text-dark h5 fw-semibold"><?php echo $order_id; ?></span></h6></th>
                                            </tr>
                                        </thead>
                                        <tbody class="table-border-bottom-0">
                                            <?php foreach($globalclass->selectByOne('tblorderaddress','order_id',$order_id) as $getuser){ ?>
                                            <tr>
                                                <td>Name: </td>
                                                <td class="fw-semibold"><?php echo $getuser->name; ?></td>
                                                <td>Email: </td>
                                                <td colspan="2"><?php echo $getuser->email; ?></td>
                                            </tr>
                                            <tr>
                                                <td>Phone No:</td>
                                                <td><?php echo $getuser->phone; ?></td>
                                                <td>Ordered Date/Time:</td>
                                                <td colspan="2"><?php echo $getuser->order_date; ?></td>
                                            </tr>
                                            <tr>
                                                <td colspan="5">Address: <?php echo $getuser->address; ?></td>
                                            </tr>
                                            <?php } ?>

                                            <tr class="text-center fw-bold">
                                                <td colspan="5">List of Food Ordered </td>
                                            </tr>
                                            <tr class="text-center fw-bold">
                                                <td>#</td>
                                                <td>Food Image</td>
                                                <td>Food Name</td>
                                                <td>Price/Qty</td>
                                                <td>Sub Total</td>
                                            </tr>
                                            <?php $i = 1; foreach($globalclass->fetchInvoice($getUserData->id,$order_id) as $getcart){ ?>
                                            <tr class="text-center fw-semibold">
                                                <td><?php echo $i++; ?></td>
                                                <td><img src="../core/assets/menu/<?php echo $getcart->picture; ?>" alt="food image" class="rounded-circle avatar avatar-md pull-up" /></td>
                                                <td><?php echo $getcart->name; ?></td>
                                                <td><?php echo $getcart->price . " x " . $getcart->qty; ?></td>
                                                <td>₦ <?php echo $getcart->total; ?></td>
                                            </tr>
                                            <?php } ?>

                                            <?php foreach($globalclass->selectByOne('tblorderaddress','order_id',$order_id) as $getuser){ ?>
                                            <tr class="text-center fw-bold">
                                                <td colspan="3">Grand Total</td>
                                                <td colspan="2">₦ <?php echo $getuser->order_total; ?></td>
                                            </tr>
                                            <tr>
                                                <td colspan="3" class="text-center fw-bold">Order Status</td>
                                                <td colspan="2" class="text-center">
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
                                            </tr>
                                            <?php } ?>

                                            <tr class="text-center fw-bold">
                                                <td colspan="5">Food Tracking History</td>
                                            </tr>
                                            
                                            <tr class="text-center fw-bold">
                                                <td>#</td>
                                                <td colspan="2">Remark</td>
                                                <td>Status</td>
                                                <td>Date/Time</td>
                                            </tr>
                                            <?php $i = 1;foreach($globalclass->selectByOne('tbltrackfood','order_id',$order_id) as $trackorder){ ?>
                                            <tr>
                                                <td><?php echo $i++; ?></td>
                                                <td colspan="2"><?php echo $trackorder->remark; ?></td>
                                                <td><?php echo $trackorder->status; ?> (by Admin)</td>
                                                <td><?php echo $trackorder->date; ?></td>
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

    <!-- Core JS -->
    <?php include_once('../includes/js.php'); ?>

  </body>
</html>
