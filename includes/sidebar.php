<aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
          <div class="app-brand demo">
            <a href="dashboard" class="app-brand-link">
              <span class="app-brand-logo demo">
                <img src='../core/assets/store-logo/<?php echo $getstore->picture; ?>' class="rounded-circle avatar avatar-md pull-up">
              </span>
              <span class="app-brand-text demo menu-text fw-bolder ms-3"><?php echo $getstore->name; ?></span>
            </a>

            <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto d-block d-xl-none">
              <i class="bx bx-chevron-left bx-sm align-middle"></i>
            </a>
          </div>

          <div class="menu-inner-shadow"></div>

          <ul class="menu-inner py-1">

            <?php if($getUserData->usertype == "Admin" || $getUserData->usertype == "Super Admin"): ?>

            <!-- Dashboard -->
            <li class="menu-item active">
              <a href="dashboard" class="menu-link">
                <i class="menu-icon tf-icons bx bx-home-circle"></i>
                <div data-i18n="Analytics">Dashboard</div>
              </a>
            </li>

            <!-- Category -->
            <li class="menu-item">
              <a href="category" class="menu-link">
                <i class="menu-icon tf-icons bx bx-category"></i>
                <div data-i18n="Basic">Category</div>
              </a>
            </li>

            <!-- Add Menu -->
            <li class="menu-item">
              <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons bx bx-menu"></i>
                <div data-i18n="Layouts">Menu</div>
              </a>

              <ul class="menu-sub">
                <li class="menu-item">
                  <a href="add-menu" class="menu-link">
                    <div data-i18n="Without menu">Add Menu</div>
                  </a>
                </li>
                <li class="menu-item">
                  <a href="view-menu" class="menu-link">
                    <div data-i18n="Without navbar">View Menu</div>
                  </a>
                </li>
              </ul>
            </li>

            <!-- Report -->
            <li class="menu-item">
              <a href="sales-history" class="menu-link">
                <i class="menu-icon tf-icons bx bx-file"></i>
                <div data-i18n="Basic">Sales History</div>
              </a>
            </li>

            <!-- Add Users -->
            <li class="menu-item">
              <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons bx bx-user-plus"></i>
                <div data-i18n="Layouts">Users</div>
              </a>

              <ul class="menu-sub">
                <li class="menu-item">
                  <a href="add-user" class="menu-link">
                    <div data-i18n="Without menu">Manage Users</div>
                  </a>
                </li>
                <li class="menu-item">
                  <a href="view-user" class="menu-link">
                    <div data-i18n="Without navbar">View Users</div>
                  </a>
                </li>
              </ul>
            </li>

            <!-- Customers -->
            <li class="menu-item">
              <a href="customer" class="menu-link">
                <i class="menu-icon tf-icons bx bx-user-plus"></i>
                <div data-i18n="Basic">Customers</div>
              </a>
            </li>

            <!-- Settings -->
            <li class="menu-item">
              <a href="settings" class="menu-link">
                <i class="menu-icon tf-icons bx bx-cog"></i>
                <div data-i18n="Basic">Settings</div>
              </a>
            </li>

            <!-- Profile -->
            <li class="menu-item">
              <a href="profile" class="menu-link">
                <i class="menu-icon tf-icons bx bx-user"></i>
                <div data-i18n="Basic">Profile</div>
              </a>
            </li>

            <!-- Order History -->
            <li class="menu-item">
              <a href="order-history" class="menu-link">
                <i class="menu-icon tf-icons bx bx-folder"></i>
                <div data-i18n="Basic">Order History</div>
              </a>
            </li>

            <!-- Change Password -->
            <li class="menu-item">
              <a href="change-password" class="menu-link">
                <i class="menu-icon tf-icons bx bx-lock"></i>
                <div data-i18n="Basic">Change Password</div>
              </a>
            </li>

            <!-- Sign Out -->
            <li class="menu-item">
              <a href="logout" class="menu-link">
                <i class="menu-icon tf-icons bx bx-power-off"></i>
                <div data-i18n="Basic">Sign Out</div>
              </a>
            </li>

            <?php endif; ?>

            <?php if($getUserData->usertype == "User"): ?>

            <!-- Dashboard -->
            <li class="menu-item active">
              <a href="dashboard" class="menu-link">
                <i class="menu-icon tf-icons bx bx-home-circle"></i>
                <div data-i18n="Analytics">Dashboard</div>
              </a>
            </li>

            <!-- Order History -->
            <li class="menu-item">
              <a href="order-history" class="menu-link">
                <i class="menu-icon tf-icons bx bx-folder"></i>
                <div data-i18n="Basic">Order History</div>
              </a>
            </li>

            <!-- Profile -->
            <li class="menu-item">
              <a href="profile" class="menu-link">
                <i class="menu-icon tf-icons bx bx-user"></i>
                <div data-i18n="Basic">Profile</div>
              </a>
            </li>

            <!-- Change Password -->
            <li class="menu-item">
              <a href="change-password" class="menu-link">
                <i class="menu-icon tf-icons bx bx-lock"></i>
                <div data-i18n="Basic">Change Password</div>
              </a>
            </li>

            <!-- Sign Out -->
            <li class="menu-item">
              <a href="logout" class="menu-link">
                <i class="menu-icon tf-icons bx bx-power-off"></i>
                <div data-i18n="Basic">Sign Out</div>
              </a>
            </li>

            <?php endif; ?>

          </ul>
        </aside>