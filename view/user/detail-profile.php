<?php
include_once  '../../controllers/LoginController.php';


$user = new LoginController;
$pagedetail = $user->pageDetailProfile($_GET);
$baseUrl = $user->baseUrl;
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
    <?= $user->menu() ?>

    <div class="wrapper">
        <!-- Main Sidebar Container -->

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <section class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1>Detail Profil </h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="<?= $baseUrl ?>/view/dashboard.php">Home</a></li>
                                <li class="breadcrumb-item active">Detail Profile</li>
                            </ol>
                        </div>
                    </div>
                </div><!-- /.container-fluid -->
            </section>

            <!-- Main content -->
            <section class="content col-md-4">
                <div class="card">
                    <!-- /.card-header -->
                    <div class="card-body p-0 ">
                        <table class="table table-bordered">
                            <tbody>
                                <tr>
                                    <th>ID</th>
                                    <td><?php echo $pagedetail['id']; ?></td>
                                </tr>
                                <tr>
                                    <th>Email</th>
                                    <td><?php echo $pagedetail['email']; ?></td>
                                </tr>
                                <tr>
                                    <th>Name</th>
                                    <td><?php echo $pagedetail['name'] ? $pagedetail['name'] : "Tidak Ada Nama"; ?></td>
                                </tr>
                                <tr>
                                    <th>Photo</th>
                                    <td><?php echo $pagedetail['photo'] ? $pagedetail['photo'] : "default-profile.png"; ?></td>
                                </tr>
                                <tr>
                                    <th>Created_at</th>
                                    <td><?php echo $pagedetail['created_at']; ?></td>
                                </tr>
                                <tr>
                                    <th>Update_at</th>
                                    <td><?php echo $pagedetail['updated_at']; ?></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <!-- /.card-body -->
                </div><!-- /.container-fluid -->
            </section>
            <a href="<?= $baseUrl ?>/view/user/view-profile.php">
                <label class="btn btn-secondary " style="margin-left: 10px; padding: 5px; width: 110px; border: none; color: #fff; border-radius: 5px; font-weight: 500;">Back</label>
            </a>
            <a href="<?= $baseUrl ?>/view/user/edit-profile.php">
                <label class="btn btn-primary " style="padding: 5px; width: 110px; border: none; color: #fff; border-radius: 5px; font-weight: 500;">Edit</label>
            </a>
            <!-- /.content -->
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
    </script>
</body>

</html>