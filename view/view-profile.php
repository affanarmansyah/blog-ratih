<?php
include_once 'menu.php';
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
    <link rel="stylesheet" href="../assets/plugin/AdminLTE-3.2.0/plugins/fontawesome-free/css/all.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="../assets/plugin/AdminLTE-3.2.0/dist/css/adminlte.min.css">
</head>

<body class="hold-transition sidebar-mini">
    <div class="wrapper">
        <!-- Main Sidebar Container -->


        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <section class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1>Profile</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="#">Home</a></li>
                                <li class="breadcrumb-item active">General Form</li>
                            </ol>
                        </div>
                    </div>
                </div><!-- /.container-fluid -->
            </section>

            <!-- Main content -->
            <section class="content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-3">

                            <!-- Profile Image -->
                            <form action="./fn-upload.php" method="post" enctype="multipart/form-data">
                                <div class="card card-primary card-outline">
                                    <div class="card-body box-profile">

                                        <div class="text-center">
                                            <?php
                                            if (isset($_SESSION['email']) && isset($_SESSION['name'])) {
                                                $profileImage = "../assets/img/default-profile.jpg";
                                                if (isset($_SESSION['photo']) && !empty($_SESSION['photo'])) {
                                                    $profileImage = "../assets/img/" . $_SESSION['photo'];
                                                }
                                                echo '<img src="' . $profileImage . '" class="profile-user-img img-fluid img-circle" alt="User Image">';
                                            }
                                            ?>

                                        </div>
                                        <p class="text-muted text-center">Software Engineer</p>

                                        <ul class="list-group list-group-unbordered mb-3">
                                            <li class="list-group-item">
                                                <b>Name</b> <a class="float-right"><?php echo $_SESSION['name']; ?></a>
                                            </li>
                                            <li class="list-group-item">
                                                <b>Info</b> <a class="float-right">Busy</a>
                                            </li>

                                        </ul>
                                        <a href="edit-profile.php">
                                            <label class="btn btn-primary float-right mt-1" style="font-weight: 500;">Edit</label>
                                        </a>
                                        <a href="detail-page.php">
                                            <label class="btn btn-secondary mt-1" style="font-weight: 500;">Detail Profile</label>
                                        </a>
                                    </div>
                                    <!-- /.card-body -->
                                </div>
                            </form>

                        </div>
                    </div>
                </div>
            </section>
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
    <script src="../assets/plugin/AdminLTE-3.2.0/plugins/jquery/jquery.min.js"></script>
    <!-- Bootstrap 4 -->
    <script src="../assets/plugin/AdminLTE-3.2.0/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- bs-custom-file-input -->
    <script src="../assets/plugin/AdminLTE-3.2.0/plugins/bs-custom-file-input/bs-custom-file-input.min.js"></script>
    <!-- AdminLTE App -->
    <script src="../assets/plugin/AdminLTE-3.2.0/dist/js/adminlte.min.js"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="../assets/plugin/AdminLTE-3.2.0/dist/js/demo.js"></script>
    <!-- Page specific script -->
    <script>
        $(function() {
            bsCustomFileInput.init();
        });
    </script>
</body>

</html>