<?php
include_once __DIR__ . '/../../function/base.php'; // first to call have use __DIR__

include_once BASE_DIR_BLOG_RATIH . '/view/menu.php';
include_once BASE_DIR_BLOG_RATIH . '/models/model-news.php';

$page = isset($_GET['page']) ? $_GET['page'] : 1;
$cari = isset($_GET['cari_disini']) ? $_GET['cari_disini'] : '';
$limit = isset($_GET['limit']) ? $_GET['limit'] : 10;

if (isset($_GET['id'])) {
    $berhasil = deleteNews($_GET['id']);
    if ($berhasil) {
        header("Location:" . BASE_URL_BLOG_RATIH . "/view/news/list-news.php?berhasil=<b>Well done!</b> News deleted");
        exit();
    } else {
        echo $berhasil;
        exit();
    }
}
$result = listNews($page, $cari, $limit);


if (!isset($_SESSION['logged_in'])) {
    header("refresh:0;../index.php");
} else {
?>

    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>AdminLTE 3 | General Form Elements</title>

        <!-- Google Font: Source Sans Pro -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
        <!-- Font Awesome -->
        <link rel="stylesheet" href="<?= BASE_URL_BLOG_RATIH ?>/assets/plugin/AdminLTE-3.2.0/plugins/fontawesome-free/css/all.min.css">
        <!-- Theme style -->
        <link rel="stylesheet" href="<?= BASE_URL_BLOG_RATIH ?>/assets/plugin/AdminLTE-3.2.0/dist/css/adminlte.min.css">
    </head>

    <body class="hold-transition sidebar-mini">
        <div class="wrapper">
            <!-- Main Sidebar Container -->

            <!-- Content Wrapper. Contains page content -->
            <div class="content-wrapper">
                <section class="content-header">
                    <div class="container-fluid">
                        <div class="row mb-2">
                            <div class="col-sm-6">
                                <h1>News</h1>
                            </div>
                            <div class="col-sm-6">
                                <ol class="breadcrumb float-sm-right">
                                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                                    <li class="breadcrumb-item active">General Form</li>
                                </ol>
                            </div>
                        </div>
                        <div class="mt-3"><a href="<?= BASE_URL_BLOG_RATIH ?>/view/news/create-news.php" style="background-color: #007bff; padding: 5px;  border: none; color: #fff; border-radius: 5px;">+ &nbsp; Create News</a></div>
                    </div><!-- /.container-fluid -->
                </section>

                <section class="content">
                    <?php
                    if (isset($_GET['berhasil'])) {
                    ?>
                        <div class="alert" style="background-color: #b1dfca; height: 50px; font-style: italic; font-weight: 500; color: green">
                            <p><?php echo $_GET['berhasil']; ?></p>
                            <button onclick="closeAlert(this.parentNode)" style="position: absolute; top: 0; right: 0; background-color: #b1dfca; border: none; color: green;"><i class="fas fa-times"></i></button>
                        </div>
                    <?php } ?>
                    <div class="card">
                        <form class="card-header" method="GET">
                            <i class="fas fa-search"></i>
                            <input type="text" name="cari_disini" placeholder="Cari disini" value="<?php if (isset($_GET['cari_disini'])) {
                                                                                                        echo $_GET['cari_disini'];
                                                                                                    } ?>">

                            <input type="submit" value="Cari">
                        </form>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>No.</th>
                                        <th>Image</th>
                                        <th>Title</th>
                                        <th>Status</th>
                                        <th>Created_at</th>
                                        <th>Updated_at</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    echo $result['total_pages'] == 0 ? '<tr><td colspan="7">Tidak ada data ditemukan</td></tr>' : '';

                                    $no = ($page - 1) * $limit + 1;

                                    foreach ($result['row'] as $row) {
                                    ?>
                                        <tr>
                                            <td><?php echo $no; ?></td>
                                            <td><img src="<?= BASE_URL_BLOG_RATIH ?>/assets/img/<?php echo $row['image'] != '' ? $row['image'] : 'default-news.png'; ?>" style="width: 50px; height: 50px;"></td>
                                            <td><?php echo $row['title']; ?></td>
                                            <td><?php echo $row['status']; ?></td>
                                            <td><?php echo $row['created_at']; ?></td>
                                            <td><?php echo $row['updated_at']; ?></td>
                                            <td>
                                                <a style="background-color: #03a9f4; padding: 5px;  border: none; color: #fff; " href="<?= BASE_URL_BLOG_RATIH ?>/view/edit-news.php?id=<?php echo $row['id']; ?>"><i class="fas fa-edit" title="Edit"></i></a>
                                                <a style="background-color: salmon; padding: 5px;  border: none; color: #fff; " href="<?= BASE_URL_BLOG_RATIH ?>/view/view-news.php?id=<?php echo $row['id']; ?>" onclick="return confirm('Anda yakin ingin menghapus berita ini?')"><i class="fas fa-trash-alt" title="Delete"></i></a>
                                                <a style="background-color: cornflowerblue; padding: 5px;  border: none; color: #fff; " href="<?= BASE_URL_BLOG_RATIH ?>/view/detail-news.php?id=<?php echo $row['id']; ?>"><i class="fas fa-eye" title="View"></i></a>
                                            </td>
                                        </tr>
                                    <?php
                                        $no++;
                                    }
                                    ?>
                                </tbody>

                            </table>
                        </div>
                        <!-- /.card-body -->
                        <div class="card-footer clearfix">
                            <ul class="pagination pagination-sm m-0 float-right">
                                <?php
                                if ($page > 1) {
                                    echo '<li class="page-item"><a class="page-link" href="?page=' . ($page - 1) . '&cari_disini=' . $cari . '">&laquo;</a></li>';
                                }

                                for ($i = 1; $i <= $result['total_pages']; $i++) {
                                    echo '<li class="page-item';
                                    if ($i == $page) {
                                        echo ' active';
                                    }
                                    echo '"><a class="page-link" href="?page=' . $i . '&cari_disini=' . $cari . '">' . $i . '</a></li>';
                                }

                                if ($page < $result['total_pages']) {
                                    echo '<li class="page-item"><a class="page-link" href="?page=' . ($page + 1) . '&cari_disini=' . $cari . '">&raquo;</a></li>';
                                }
                                ?>
                            </ul>
                        </div>
                    </div>
                </section>
            </div>
            <!-- /.content-wrapper -->

            <!-- Control Sidebar -->
            <aside class="control-sidebar control-sidebar-dark">
                <!-- Control sidebar content goes here -->
            </aside>
            <!-- /.control-sidebar -->
        </div>
        <!-- ./wrapper -->

        <!-- jQuery -->
        <script src="<?= BASE_URL_BLOG_RATIH ?>/assets/plugin/AdminLTE-3.2.0/plugins/jquery/jquery.min.js"></script>
        <!-- Bootstrap 4 -->
        <script src="<?= BASE_URL_BLOG_RATIH ?>/assets/plugin/AdminLTE-3.2.0/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
        <!-- bs-custom-file-input -->
        <script src="<?= BASE_URL_BLOG_RATIH ?>/assets/plugin/AdminLTE-3.2.0/plugins/bs-custom-file-input/bs-custom-file-input.min.js"></script>
        <!-- AdminLTE App -->
        <script src="<?= BASE_URL_BLOG_RATIH ?>/assets/plugin/AdminLTE-3.2.0/dist/js/adminlte.min.js"></script>

        <!-- Page specific script -->
        <script>
            $(function() {
                bsCustomFileInput.init();
            });

            function closeAlert(element) {
                element.style.display = 'none';
            }
        </script>
    </body>

    </html>
<?php } ?>