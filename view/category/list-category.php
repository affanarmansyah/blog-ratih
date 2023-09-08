<?php
include_once  '../../controllers/CategoryController.php';

$category = new CategoryController;
$listcategory = $category->pageListCategory($_GET);
$baseUrl = $category->baseUrl;

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
        <link rel="stylesheet" href="<?= $baseUrl ?>/assets/plugin/AdminLTE-3.2.0/plugins/fontawesome-free/css/all.min.css">
        <!-- Theme style -->
        <link rel="stylesheet" href="<?= $baseUrl ?>/assets/plugin/AdminLTE-3.2.0/dist/css/adminlte.min.css">
    </head>

    <body class="hold-transition sidebar-mini">
        <?= $category->menu() ?>

        <div class="wrapper">
            <!-- Main Sidebar Container -->

            <!-- Content Wrapper. Contains page content -->
            <div class="content-wrapper">
                <section class="content-header">
                    <div class="container-fluid">
                        <div class="row mb-2">
                            <div class="col-sm-6">
                                <h1>Categories</h1>
                            </div>
                            <div class="col-sm-6">
                                <ol class="breadcrumb float-sm-right">
                                    <li class="breadcrumb-item"><a href="<?= $baseUrl ?>/view/dashboard.php">Home</a></li>
                                    <li class="breadcrumb-item active">Category</li>
                                </ol>
                            </div>
                        </div>
                        <div class="mt-3"><a href="<?= $baseUrl ?>/view/category/create-category.php" style="background-color: #007bff; padding: 5px;  border: none; color: #fff; border-radius: 5px;">+ &nbsp; Create Category</a></div>
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
                                        <th>Id</th>
                                        <th>Name</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    echo $listcategory['categorytotalpages'] == 0 ? '<tr><td colspan="3">Tidak ada data ditemukan</td></tr>' : '';

                                    $no = ($listcategory['page'] - 1) * $listcategory['limit'] + 1;

                                    foreach ($listcategory['categoryrows'] as $row) {
                                    ?>
                                        <tr>
                                            <td><?php echo $no; ?></td>
                                            <td><?php echo $row['name']; ?></td>
                                            <td>
                                                <a style="background-color: #03a9f4; padding: 5px;  border: none; color: #fff; " href="<?= $baseUrl ?>/view/category/edit-category.php?id=<?php echo $row['id']; ?>"><i class="fas fa-edit" title="Edit"></i></a>
                                                <a style="background-color: salmon; padding: 5px;  border: none; color: #fff; " href="<?= $baseUrl ?>/view/category/list-category.php?id=<?php echo $row['id']; ?>" onclick="return confirm('Anda yakin ingin menghapus berita ini?')"><i class="fas fa-trash-alt" title="Delete"></i></a>
                                                <a style="background-color: cornflowerblue; padding: 5px;  border: none; color: #fff; " href="<?= $baseUrl ?>/view/category/detail-category.php?id=<?php echo $row['id']; ?>"><i class="fas fa-eye" title="View"></i></a>
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
                                if ($listcategory['page'] > 1) {
                                    echo '<li class="page-item"><a class="page-link" href="?page=' . ($listcategory['page'] - 1) . '&cari_disini=' . $listcategory['search'] . '">&laquo;</a></li>';
                                }

                                for ($i = 1; $i <= $listcategory['categorytotalpages']; $i++) {
                                    echo '<li class="page-item';
                                    if ($i == $listcategory['page']) {
                                        echo ' active';
                                    }
                                    echo '"><a class="page-link" href="?page=' . $i . '&cari_disini=' . $listcategory['search'] . '">' . $i . '</a></li>';
                                }

                                if ($listcategory['page'] < $listcategory['categorytotalpages']) {
                                    echo '<li class="page-item"><a class="page-link" href="?page=' . ($listcategory['page'] + 1) . '&cari_disini=' . $listcategory['search'] . '">&raquo;</a></li>';
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
        <script src="<?= $baseUrl ?>/assets/plugin/AdminLTE-3.2.0/plugins/jquery/jquery.min.js"></script>
        <!-- Bootstrap 4 -->
        <script src="<?= $baseUrl ?>/assets/plugin/AdminLTE-3.2.0/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
        <!-- bs-custom-file-input -->
        <script src="<?= $baseUrl ?>/assets/plugin/AdminLTE-3.2.0/plugins/bs-custom-file-input/bs-custom-file-input.min.js"></script>
        <!-- AdminLTE App -->
        <script src="<?= $baseUrl ?>/assets/plugin/AdminLTE-3.2.0/dist/js/adminlte.min.js"></script>

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