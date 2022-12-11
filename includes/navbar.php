<nav class="layout-navbar container-xxl navbar navbar-expand-xl navbar-detached align-items-center bg-navbar-theme" id="layout-navbar"
          >
            <div class="layout-menu-toggle navbar-nav align-items-xl-center me-3 me-xl-0 d-xl-none">
              <a class="nav-item nav-link px-0 me-xl-4" href="javascript:void(0)">
                <i class="bx bx-menu bx-sm"></i>
              </a>
            </div>

            <div class="navbar-nav-right d-flex align-items-center" id="navbar-collapse">
            <span class="text-primary"><?php echo $getdate . ", " . $getUserData->surname; ?></span>
              <ul class="navbar-nav flex-row align-items-center ms-auto">
                <?php if($getUserData->usertype == "User"): ?>
                <!-- Cart Icon -->
                <li class="nav-item navbar-dropdown dropdown-user dropdown">
                  <a class="nav-link dropdown-toggle hide-arrow m-1" href="cart">
                    <i class="tf-icons bx bx-cart"></i>
                    <span class="badge rounded-pill badge-center h-px-20 w-px-20 bg-danger"><?php echo $globalclass->getCartNotification($getUserData->id); ?></span>
                  </a>
                </li>
                <?php endif; ?>

                <?php if($getUserData->usertype == "Admin" || $getUserData->usertype == "Super Admin"): ?>
                <!-- Notification Icon -->
                <li class="nav-item navbar-dropdown dropdown-user dropdown">
                  <a class="nav-link dropdown-toggle hide-arrow" href="javascript:void(0);" data-bs-toggle="dropdown">
                    <i class="tf-icons bx bx-bell"></i>
                    <span class="badge rounded-pill badge-center h-px-20 w-px-20 bg-danger"><?php echo $globalclass->selectCountFrom('tblorderaddress','status',''); ?></span>
                  
                  </a>
                  <ul class="dropdown-menu dropdown-menu-end">
                    <li>
                      <?php foreach($globalclass->getAdminNotification() as $showmessage){ ?>
                      <a class="dropdown-item" href="order-details?oid=<?php echo $showmessage->order_id; ?>">
                        <div class="d-flex">
                          <div class="flex-grow-1">
                            <span class="fw-semibold d-block small"><i class="tf-icons bx bx-message"></i>
                                Order No: <strong><?php echo $showmessage->order_id; ?></strong> Received From <strong><?php echo $showmessage->surname; ?></strong>
                            </span>
                          </div>
                        </div>
                      </a>
                      <div class="dropdown-divider"></div>
                      <?php } ?>
                      <?php if(!$globalclass->getAdminNotification()): ?>
                        <div class="d-flex">
                          <div class="flex-grow-1">
                            <p class="text-center text-dark mt-2"><i class="flex-shrink-0 bx bx-sad me-2 " style="font-size: 30px;"></i>No New Order Received</p>
                          </div>
                        </div>
                      <?php endif; ?>
                    </li>
                  </ul>
                </li>
                
                <?php endif; ?>

                <!-- User -->
                <li class="nav-item navbar-dropdown dropdown-user dropdown">
                  <a class="nav-link dropdown-toggle hide-arrow" href="javascript:void(0);" data-bs-toggle="dropdown">
                    <div class="avatar">
                      <?php if($getUserData->picture == ""): ?>
                        <img src="../core/assets/store-logo/<?php echo $getstore->picture; ?>" alt class="w-px-40 h-auto rounded-circle" />
                      <?php else: ?>
                        <img src="../core/assets/users-pic/<?php echo $getUserData->picture; ?>" alt class="w-px-40 h-auto rounded-circle" />
                      <?php endif; ?>
                    </div>
                  </a>
                  <ul class="dropdown-menu dropdown-menu-end">
                    <li>
                      <a class="dropdown-item" href="#">
                        <div class="d-flex">
                          <div class="flex-shrink-0 me-3">
                            <div class="avatar">
                              <?php if($getUserData->picture == ""): ?>
                                <img src="../core/assets/store-logo/<?php echo $getstore->picture; ?>" alt class="w-px-40 h-auto rounded-circle" />
                              <?php else: ?>
                                <img src="../core/assets/users-pic/<?php echo $getUserData->picture; ?>" alt class="w-px-40 h-auto rounded-circle" />
                              <?php endif; ?>
                            </div>
                          </div>
                          <div class="flex-grow-1">
                            <span class="fw-semibold d-block"><?php echo $getUserData->surname . " " . $getUserData->othername; ?></span>
                            <small class="text-muted"><?php echo $getUserData->email; ?></small>
                          </div>
                        </div>
                      </a>
                    </li>
                    <li>
                      <div class="dropdown-divider"></div>
                    </li>
                    <li>
                      <a class="dropdown-item" href="profile">
                        <i class="bx bx-user me-2"></i>
                        <span class="align-middle">My Profile</span>
                      </a>
                    </li>
                    <?php if($getUserData->usertype == "Admin" || $getUserData->usertype == "Super Admin"): ?>
                    <li>
                      <a class="dropdown-item" href="settings">
                        <i class="bx bx-cog me-2"></i>
                        <span class="align-middle">Settings</span>
                      </a>
                    </li>
                    <?php endif; ?>
                    <li>
                      <a class="dropdown-item" href="order-history">
                        <span class="d-flex align-items-center align-middle">
                          <i class="flex-shrink-0 bx bx-credit-card me-2"></i>
                          <span class="flex-grow-1 align-middle">Billing</span>
                        </span>
                      </a>
                    </li>
                    <li>
                      <div class="dropdown-divider"></div>
                    </li>
                    <li>
                      <a class="dropdown-item" href="logout">
                        <i class="bx bx-power-off me-2"></i>
                        <span class="align-middle">Sign Out</span>
                      </a>
                    </li>
                  </ul>
                </li>
                <!--/ User -->
              </ul>
            </div>
          </nav>