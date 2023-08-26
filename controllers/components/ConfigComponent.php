<?php

class ConfigComponent
{
    // private function untuk kegunaan di dalam class ini saja
    private $host = "localhost";
    private $username = "root";
    private $password = "";
    private $dbname = "ratih_blog";

    // public function untuk kegunaan global dimana saja
    public $connection;
    public $baseUrl;
    public $baseDir;

    public function __construct()
    {
        // call function databaseConnection
        $this->databaseConnection();

        // call function baseUrl
        $this->url();
    }

    // fungsi koneksi database
    private function databaseConnection()
    {
        $conn = mysqli_connect($this->host, $this->username, $this->password, $this->dbname);

        if (!$conn) {
            die("Connection failed: " . mysqli_connect_error());
        }

        $this->connection = $conn;
    }

    // fungsi pembuatan base url / path untuk kegunaan akses css, javascript dll
    private function url()
    {
        // link yang berhubugan dengan addres di browser http://localhost/blog-ratih/assets/plugin/AdminLTE-3.2.0/dist/img/ratih.webp
        $baseUrl = 'http://' . $_SERVER['SERVER_NAME'] . "/blog-ratih";

        // url real dari folder yang ada di komputer kita contoh: C:\xampp\htdocs\blog-ratih\view\news
        $dir = explode("\\", __DIR__);
        $baseDir = $dir[0] . '\\' . $dir[1] . '\\' . $dir[2] . '\\' . $dir[3];

        $this->baseUrl = $baseUrl;
        $this->baseDir = $baseDir;
    }

    public function menu()
    {
        $profileImage = '' . $this->baseUrl . '/assets/img/default-profile.png';
        $name = '';
        if (isset($_SESSION['email']) && isset($_SESSION['name'])) {
            if (isset($_SESSION['photo']) && !empty($_SESSION['photo'])) {
                $profileImage = $this->baseUrl . '/assets/img/' . $_SESSION['photo'];
            }
            $profileImage = "<img src='" . $profileImage . "' class='img-circle elevation-2' alt='User Image'>";

            if (empty($_SESSION['name'])) {
                $name = "<a href='" . $this->baseUrl . "/view/user/view-profile.php' class='d-block'>" . $_SESSION['email'] . "</a>";
            } else {
                $name = "<a href='" . $this->baseUrl . "/view/user/view-profile.php' class='d-block'>" . $_SESSION['name'] . "</a>";
            }
        }

        return "<aside class='main-sidebar sidebar-dark-primary elevation-4' style='height: 146vh;'>
        <!-- Brand Logo -->
        <a href='#' class='brand-link'>
            <img src='" . $this->baseUrl . "/assets/plugin/AdminLTE-3.2.0/dist/img/ratih.webp' alt='AdminLTE Logo' class='brand-image img-circle elevation-3' style='opacity: .8'>
            <span class='brand-text font-weight-light'>Ratih Blog</span>
        </a>
    
        <!-- Sidebar -->
        <div class='sidebar'>
            <!-- Sidebar user (optional) -->
            <div class='user-panel mt-3 pb-3 mb-3 d-flex'>
                <a href='" . $this->baseUrl . "/view/user/view-profile.php' class='image'>" . $profileImage . "</a>
                <div class='info'>" . $name . "</div>
            </div>
    
            <!-- SidebarSearch Form -->
            <div class='form-inline'>
                <div class='input-group' data-widget='sidebar-search'>
                    <input class='form-control form-control-sidebar' type='search' placeholder='Search' aria-label='Search'>
                    <div class='input-group-append'>
                        <button class='btn btn-sidebar'>
                            <i class='fas fa-search fa-fw'></i>
                        </button>
                    </div>
                </div>
            </div>
    
            <!-- Sidebar Menu -->
            <nav class='mt-2'>
                <ul class='nav nav-pills nav-sidebar flex-column' data-widget='treeview' role='menu' data-accordion='false'>
                    <!-- Add icons to the links using the .nav-icon class
           with font-awesome or any other icon font library -->
                    <!-- <li class='nav-item ml-1'>
                        <a href='" . $this->baseUrl . "/view/dashboard.php' class='nav-link'>
                            <i class='fas fa-chart-bar'></i>
                            <p style='margin-left: 10px;'>
                                Dashboard
                            </p>
                        </a>
                    </li> -->
                    <li class='nav-item'>
                        <a href='" . $this->baseUrl . "/view/news/list-news.php' class='nav-link'>
                            <i class='nav-icon fas fa-blog'></i>
                            <p>
                                News
                            </p>
                        </a>
                    </li>
                    <li class='nav-item'>
                        <a href='" . $this->baseUrl . "/view/category/list-category.php' class='nav-link'>
                            <i class='nav-icon fas fa-book'></i>
                            <p>
                                Category News
                            </p>
                        </a>
                    </li>
                    <li class='nav-item'>
                        <a href=' " . $this->baseUrl . "/view/login/logout.php' class='nav-link' onclick=\"return confirm('Anda yakin ingin Logout?')\">
                            <i class='nav-icon fas fa-arrow-alt-circle-right'></i>
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
    </aside>";
    }
}
