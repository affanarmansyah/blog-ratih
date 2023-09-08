<?php
include_once  '../../controllers/LoginController.php';

$user = new LoginController;
$pageUpdate = $user->pageUpdateProfile($_POST, $_FILES);
$baseUrl = $user->baseUrl;

if (!isset($_SESSION['logged_in'])) {
  header("refresh:0;../../index.php");
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
                <h1>Edit Profile</h1>
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
              <!-- left column -->
              <div class="col-md-4">
                <div class="card card-primary">
                  <form action="" method="post" id="quickForm" enctype="multipart/form-data">
                    <div class="card-body">
                      <div class="text-center mb-3">
                        <?php
                        $profileImage = "" . $baseUrl . "/assets/img/default-profile.png";
                        if (isset($_SESSION['photo']) && !empty($_SESSION['photo'])) {
                          $profileImage = "" . $baseUrl . "/assets/img/" . $_SESSION['photo'];
                        }
                        echo '<img src="' . $profileImage . '" class="profile-user-img img-fluid img-circle" alt="User Image">';
                        ?>
                      </div>
                      <div>
                        <?php if (isset($_GET['success'])) { ?>
                          <p class="error" style="background: #b1dfca; color: green; padding: 8px; width: 100%; border-radius: 5px; font-size: 15px;"><?php echo $_GET['success']; ?></p>
                        <?php } ?>
                        <?php if (isset($_GET['error'])) { ?>
                          <p class="error" style="background: #f2dede; color: #A94442; padding: 8px; width: 100%; border-radius: 5px; font-size: 13px; margin-top: 10px;"><?php echo $_GET['error']; ?></p>
                        <?php } ?>
                      </div>
                      <div class="form-group">
                        <input type="hidden" name="id" value="<?php echo $_SESSION['id']; ?>">
                        <label for="exampleName1">Name</label>
                        <input type="text" value="<?php echo $_SESSION['name']; ?>" name="name" class="form-control" id="exampleName1" placeholder="Name">
                      </div>
                      <div class="form-group">
                        <label for="exampleInputEmail1">Email address</label>
                        <input type="text" value="<?php echo $_SESSION['email']; ?>" name="email" class="form-control" id="exampleInputEmail1" placeholder="Enter email">
                      </div>
                      <div class="form-group">
                        <label for="exampleInputPassword1">Password</label>
                        <input type="password" name="password" class="form-control" id="exampleInputPassword1" placeholder="Password">
                      </div>
                      <div class="form-group">
                        <label for="exampleInputPassword1">Confirm Password</label>
                        <input type="password" name="confirm_password" class="form-control" id="exampleInputKonfirmasiPassword1" placeholder="Confirm Password">
                      </div>
                      <div class="form-group">
                        <label for="exampleInputFile">Photo</label>
                        <div class="input-group">
                          <div class="form-group">
                            <input type="file" name="photo">
                          </div>
                        </div>
                        <input type="submit" style="background-color: #03a9f4; padding: 5px; margin-top: 20px; width: 110px; border: none; color: #fff; border-radius: 5px;" name="submit" value="Save" class="float-right">
                        <a href="view-profile.php">
                          <label class="btn btn-secondary " style=" margin-top: 20px; padding: 5px; width: 110px; border: none; color: #fff; border-radius: 5px; font-weight: 500;">Back</label>
                        </a>
                      </div>
                    </div>
                  </form>
                </div>
              </div>
            </div>
            <!-- /.row -->
          </div><!-- /.container-fluid -->
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
    <script src="<?= $baseUrl ?>/assets/plugin/AdminLTE-3.2.0/plugins/jquery/jquery.min.js"></script>
    <!-- Bootstrap 4 -->
    <script src="<?= $baseUrl ?>/assets/plugin/AdminLTE-3.2.0/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- bs-custom-file-input -->
    <script src="<?= $baseUrl ?>/assets/plugin/AdminLTE-3.2.0/plugins/bs-custom-file-input/bs-custom-file-input.min.js"></script>
    <!-- AdminLTE App -->
    <script src="<?= $baseUrl ?>/assets/plugin/AdminLTE-3.2.0/dist/js/adminlte.min.js"></script>
    <!-- jquery-validation -->
    <script src="<?= $baseUrl ?>/assets/plugin/AdminLTE-3.2.0/plugins/jquery-validation/jquery.validate.min.js"></script>
    <script src="<?= $baseUrl ?>/assets/plugin/AdminLTE-3.2.0/plugins/jquery-validation/additional-methods.min.js"></script>

    <!-- Page specific script -->
    <script>
      $(function() {
        bsCustomFileInput.init();
      });

      $(function() {
        $.validator.setDefaults({
          submitHandler: function() {
            header("refresh:0;./dashboard.php");
          }
        });
        $('#quickForsm').validate({
          rules: {
            name: {
              required: true,
              minlength: 3

            },
            email: {
              required: true,
              email: true,
            },
            // password: {
            //   required: true,
            //   minlength: 6
            // },
            // confirm_password: {
            //   required: true,
            //   minlength: 6
            // },
          },
          messages: {
            name: {
              required: "Please provide a name",
              minlength: "Nama harus lebih dari 3 karakter"
            },
            email: {
              required: "Please enter a email address",
              email: "Please enter a valid email address"
            },
            // password: {
            //   required: "Please provide a password",
            //   minlength: "Password harus lebih dari 6 karakter"
            // },
            // confirm_password: {
            //   required: "Please provide a confirm password",
            //   minlength: "Password harus lebih dari 6 karakter"
            // },
          },
          errorElement: 'span',
          errorPlacement: function(error, element) {
            error.addClass('invalid-feedback');
            element.closest('.form-group').append(error);
          },
          highlight: function(element, errorClass, validClass) {
            $(element).addClass('is-invalid');
          },
          unhighlight: function(element, errorClass, validClass) {
            $(element).removeClass('is-invalid');
          }
        });
      });
    </script>
  </body>

  </html>
<?php } ?>