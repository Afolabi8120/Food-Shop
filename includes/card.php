            <div class="row">
                <div class="col-lg-6 col-md-6 order-1">
                  <div class="row">

                      <div class="col-lg-6 col-md-12 mb-4">
                        <div class="card">
                          <div class="card-body">
                            <div class="card-title d-flex align-items-start justify-content-between">
                              <div class="avatar flex-shrink-0">
                                <img
                                  src="../assets/img/icons/unicons/chart-success.png"
                                  alt="chart success"
                                  class="rounded"
                                />
                              </div>
                            </div>
                            <span class="fw-semibold d-block mb-1">User(s)</span>
                            <h3 class="card-title mb-2"><?php echo $globalclass->selectCountFrom('tbluser','usertype','Admin'); ?></h3>
                          </div>
                        </div>
                      </div>

                      <div class="col-lg-6 col-md-12 mb-4">
                        <div class="card">
                          <div class="card-body">
                            <div class="card-title d-flex align-items-start justify-content-between">
                              <div class="avatar flex-shrink-0">
                                <img
                                  src="../assets/img/icons/unicons/wallet-info.png"
                                  alt="Credit Card"
                                  class="rounded"
                                />
                              </div>
                            </div>
                            <span class="fw-semibold d-block mb-1">All Time Sales</span>
                            <h3 class="card-title text-nowrap mb-1">₦ <?php echo number_format($globalclass->getTotalPrice('tblorderaddress','order_total'), 00); ?></h3>
                          </div>
                        </div>
                      </div>

                      <div class="col-lg-6 col-md-12 mb-4">
                        <div class="card">
                          <div class="card-body">
                            <div class="card-title d-flex align-items-start justify-content-between">
                              <div class="avatar flex-shrink-0">
                                <img
                                  src="../assets/img/icons/unicons/chart-success.png"
                                  alt="chart success"
                                  class="rounded"
                                />
                              </div>
                            </div>
                            <span class="fw-semibold d-block mb-1">Total Orders</span>
                            <h3 class="card-title mb-2"><?php echo $globalclass->selectTotal('tblorderaddress'); ?></h3>
                          </div>
                        </div>
                      </div>

                      <div class="col-lg-6 col-md-12 mb-4">
                        <div class="card">
                          <div class="card-body">
                            <div class="card-title d-flex align-items-start justify-content-between">
                              <div class="avatar flex-shrink-0">
                                <img
                                  src="../assets/img/icons/unicons/wallet-info.png"
                                  alt="Credit Card"
                                  class="rounded"
                                />
                              </div>
                            </div>
                            <span class="fw-semibold d-block mb-1">Approved Orders</span>
                            <h3 class="card-title text-nowrap mb-1"><?php echo $globalclass->selectCountFrom('tblorderaddress','status','Food Delivered'); ?></h3>
                          </div>
                        </div>
                      </div>
                      
                  </div>
                </div>

                <div class="col-lg-6 col-md-6 order-1">
                  <div class="row">

                      <div class="col-lg-6 col-md-12 mb-4">
                        <div class="card">
                          <div class="card-body">
                            <div class="card-title d-flex align-items-start justify-content-between">
                              <div class="avatar flex-shrink-0">
                                <img
                                  src="../assets/img/icons/unicons/chart-success.png"
                                  alt="chart success"
                                  class="rounded"
                                />
                              </div>
                            </div>
                            <span class="fw-semibold d-block mb-1">Customer(s)</span>
                            <h3 class="card-title mb-2"><?php echo $globalclass->selectCountFrom('tbluser','usertype','User'); ?></h3>
                          </div>
                        </div>
                      </div>

                      <div class="col-lg-6 col-md-12 mb-4">
                        <div class="card">
                          <div class="card-body">
                            <div class="card-title d-flex align-items-start justify-content-between">
                              <div class="avatar flex-shrink-0">
                                <img
                                  src="../assets/img/icons/unicons/wallet-info.png"
                                  alt="Credit Card"
                                  class="rounded"
                                />
                              </div>
                            </div>
                            <span class="fw-semibold d-block mb-1">Today Sales</span>
                            <h3 class="card-title text-nowrap mb-1">₦ <?php 
                            $date = date("d M, Y");
                            echo number_format($globalclass->getTotalPriceWhere('tblorderaddress','order_total', $date), 00); ?></h3>
                          </div>
                        </div>
                      </div>

                      <div class="col-lg-6 col-md-12 mb-4">
                        <div class="card">
                          <div class="card-body">
                            <div class="card-title d-flex align-items-start justify-content-between">
                              <div class="avatar flex-shrink-0">
                                <img
                                  src="../assets/img/icons/unicons/chart-success.png"
                                  alt="chart success"
                                  class="rounded"
                                />
                              </div>
                            </div>
                            <span class="fw-semibold d-block mb-1">Pending Orders</span>
                            <h3 class="card-title mb-2"><?php echo $globalclass->getPendingOrders(); ?></h3>
                          </div>
                        </div>
                      </div>

                      <div class="col-lg-6 col-md-12 mb-4">
                        <div class="card">
                          <div class="card-body">
                            <div class="card-title d-flex align-items-start justify-content-between">
                              <div class="avatar flex-shrink-0">
                                <img
                                  src="../assets/img/icons/unicons/wallet-info.png"
                                  alt="Credit Card"
                                  class="rounded"
                                />
                              </div>
                            </div>
                            <span class="fw-semibold d-block mb-1">Cancelled Orders</span>
                            <h3 class="card-title text-nowrap mb-1"><?php echo $globalclass->selectCountFrom('tblorderaddress','status','Order Cancel'); ?></h3>
                          </div>
                        </div>
                      </div>
                      
                  </div>
                </div>
              </div>