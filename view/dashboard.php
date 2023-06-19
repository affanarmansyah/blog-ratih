<?php
include_once 'menu.php';
include_once '../function/fn-databese-connect.php';
?>

<?php

// $_SESSION['username'] = $username;
// $_SESSION['logged_in'] = true;
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
        <link rel="stylesheet" href="../assets/plugin/AdminLTE-3.2.0/plugins/fontawesome-free/css/all.min.css">
        <!-- Theme style -->
        <link rel="stylesheet" href="../assets/plugin/AdminLTE-3.2.0/dist/css/adminlte.min.css">
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
                        <div class="text-center"><a href="create_news.php" style="background-color: #03a9f4; padding: 5px;  border: none; color: #fff; border-radius: 5px;">+ &nbsp; Create News</a></div>
                    </div><!-- /.container-fluid -->
                </section>
                <section class="content">
                    <div class="card">
                        <!-- /.card-header -->
                        <div class="card-body p-0">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>No.</th>
                                        <th>Title</th>
                                        <th>Image</th>
                                        <th>Description</th>
                                        <th>View</th>
                                        <th>Status</th>
                                        <th>Created_at</th>
                                        <th>Updated_at</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $query = "SELECT * FROM table_news order by id ASC";
                                    $result = mysqli_query($conn, $query);

                                    $no = 1;

                                    while ($row = mysqli_fetch_assoc($result)) {
                                    ?>
                                        <tr>
                                            <td><?php echo $no ?></td>
                                            <td><?php echo $row['title']; ?></td>
                                            <td></td>
                                            <td><?php echo $row['description']; ?></td>
                                            <td><?php echo $row['view']; ?></td>
                                            <td><?php echo $row['status']; ?></td>
                                            <td><?php echo $row['created_at']; ?></td>
                                            <td><?php echo $row['updated_at']; ?></td>
                                            <td>
                                                <a style="background-color: #03a9f4; padding: 5px;  border: none; color: #fff; " href="edit_news.php?id=<?php echo $row['id']; ?>">Edit</a>
                                                <a style="background-color: salmon; padding: 5px;  border: none; color: #fff; " href="delete_news.phpid=<?php echo $row['id']; ?>" onclick="return confirm('Anda yakin ingin menghapus berita ini?')">Hapus</a>
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
                    </div><!-- /.container-fluid -->
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
        <script src="../assets/plugin/AdminLTE-3.2.0/plugins/jquery/jquery.min.js"></script>
        <!-- Bootstrap 4 -->
        <script src="../assets/plugin/AdminLTE-3.2.0/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
        <!-- bs-custom-file-input -->
        <script src="../assets/plugin/AdminLTE-3.2.0/plugins/bs-custom-file-input/bs-custom-file-input.min.js"></script>
        <!-- AdminLTE App -->
        <script src="../assets/plugin/AdminLTE-3.2.0/dist/js/adminlte.min.js"></script>

        <!-- Page specific script -->
        <script>
            $(function() {
                bsCustomFileInput.init();
            });
        </script>
    </body>

    </html>
<?php } ?>