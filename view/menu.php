<aside class="main-sidebar sidebar-dark-primary elevation-4" style="height: 146vh;">
    <!-- Brand Logo -->
    <a href="#" class="brand-link">
        <img src="<?= BASE_URL_BLOG_RATIH ?>/assets/plugin/AdminLTE-3.2.0/dist/img/ratih.webp" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">Ratih Blog</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <a href="<?= BASE_URL_BLOG_RATIH ?>/view/user/view-profile.php" class="image">
                <?php
                session_start();
                $userSession = $_SESSION;
                if (isset($_SESSION['email']) && isset($_SESSION['name'])) {
                    $profileImage = "" . BASE_URL_BLOG_RATIH . "/assets/img/default-profile.png";
                    if (isset($_SESSION['photo']) && !empty($_SESSION['photo'])) {
                        $profileImage = "" . BASE_URL_BLOG_RATIH . "/assets/img/" . $_SESSION['photo'];
                    }
                    echo '<img src="' . $profileImage . '" class="img-circle elevation-2" alt="User Image">';
                }
                ?>
            </a>
            <div class="info">
                <?php
                if (isset($_SESSION['email']) && isset($_SESSION['name'])) {
                    if (empty($_SESSION['name'])) {
                        echo '<a href="' . BASE_URL_BLOG_RATIH . '/view/user/view-profile.php" class="d-block">' . $_SESSION['email'] . '</a>';
                    } else {
                        echo '<a href="' . BASE_URL_BLOG_RATIH . '/view/user/view-profile.php" class="d-block">' . $_SESSION['name'] . '</a>';
                    }
                }
                ?>
            </div>
        </div>

        <!-- SidebarSearch Form -->
        <div class="form-inline">
            <div class="input-group" data-widget="sidebar-search">
                <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
                <div class="input-group-append">
                    <button class="btn btn-sidebar">
                        <i class="fas fa-search fa-fw"></i>
                    </button>
                </div>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class
       with font-awesome or any other icon font library -->
                <!-- <li class="nav-item ml-1">
                    <a href="<?= BASE_URL_BLOG_RATIH ?>/view/dashboard.php" class="nav-link">
                        <i class="fas fa-chart-bar"></i>
                        <p style="margin-left: 10px;">
                            Dashboard
                        </p>
                    </a>
                </li> -->
                <li class="nav-item">
                    <a href="<?= BASE_URL_BLOG_RATIH ?>/view/news/list-news.php" class="nav-link">
                        <i class="nav-icon fas fa-blog"></i>
                        <p>
                            News
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="<?= BASE_URL_BLOG_RATIH ?>/view/category/list-category.php" class="nav-link">
                        <i class="nav-icon fas fa-book"></i>
                        <p>
                            Category News
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href=" <?= BASE_URL_BLOG_RATIH ?>/view/login/logout.php" class="nav-link" onclick="return confirm('Anda yakin ingin Logout?')">
                        <i class="nav-icon fas fa-arrow-alt-circle-right"></i>
                        <p>
                            LogOut
                        </p>
                    </a>
                </li>
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>