<?php
// Create Account
include_once __DIR__ . '/../../function/base.php'; // first to call have use __DIR__

include_once BASE_DIR_BLOG_RATIH . '/models/model-user.php';

if (isset($_POST['submit'])) {
    if ($_POST['submit'] == "Submit")
        $result = createAccount($_POST);
    if ($result['success']) {
        // Jika akun berhasil dibuat, redirect ke halaman create-account.php dengan parameter success.
        header("Location:" . BASE_URL_BLOG_RATIH . "/view/user/create-account.php?success=" . $result['message']);
        exit();
    } else {
        // Jika terdapat error, redirect ke halaman create-account.php dengan parameter error.
        $errorData = implode("<br>", $result['errors']);
        header("Location:" . BASE_URL_BLOG_RATIH . "/view/user/create-account.php?error=" . $errorData);
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Create Account</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="<?= BASE_URL_BLOG_RATIH ?>/assets/plugin/AdminLTE-3.2.0/plugins/fontawesome-free/css/all.min.css">
    <!-- icheck bootstrap -->
    <link rel="stylesheet" href="<?= BASE_URL_BLOG_RATIH ?>/assets/plugin/AdminLTE-3.2.0/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="<?= BASE_URL_BLOG_RATIH ?>/assets/plugin/AdminLTE-3.2.0/dist/css/adminlte.min.css">
    <style>
        .create-accounts a {
            text-decoration: none;
            color: #03a9f4;
        }

        .info-insert-data {
            background: forestgreen;
            color: #fff;
            padding: 2px;
            width: 100%;
            border-radius: 5px;
        }
    </style>
</head>

<body class="hold-transition login-page">
    <div class="login-box">
        <div class="login-logo">
            <a href="./index2.php"><b>Ratih</b>Blog</a>
        </div>
        <!-- /.login-logo -->
        <div class="card">
            <div class="card-body login-card-body">
                <h5 class="login-box-msg">Register</h5>

                <?php if (isset($_GET['success'])) { ?>
                    <p class="error" style="background: #b1dfca; color: green; padding: 8px; width: 100%; border-radius: 5px; font-size: 15px;"><?php echo $_GET['success']; ?></p>
                <?php } ?>

                <?php if (isset($_GET['error'])) { ?>
                    <p class="error" style="background: #f2dede; color: #A94442; padding: 8px; width: 100%; border-radius: 5px; font-size: 13px;"><?php echo $_GET['error']; ?></p>
                <?php } ?>

                <form action="" method="post" id="quickForm">
                    <div class="card-bodsy">
                        <div class="form-group">
                            <input type="text" name="email" class="form-control" id="exampleInputEmail1" placeholder="Email">
                        </div>
                        <div class="form-group">
                            <input type="password" name="password" class="form-control" id="exampleInputPassword1" placeholder="Password">
                        </div>
                        <div class="form-group">
                            <input type="password" name="confirm_password" class="form-control" id="exampleInputKonfirmasiPassword1" placeholder="Confirm Password">
                        </div>


                    </div>
                    <!-- /.card-body -->
                    <input type="submit" style="background-color: #03a9f4; padding: 5px; width: 110px; border: none; color: #fff; border-radius: 5px;" name="submit" value="Submit">
                    <a href="<?= BASE_URL_BLOG_RATIH ?>/index.php">
                        <label class="btn btn-secondary mt-1 ml3" style="background-color: #03a9f4; padding: 5px; width: 110px; border: none; color: #fff; border-radius: 5px; font-weight: 500;">Login</label>
                    </a>
                    <!-- /.col -->
            </div>
            </form>
        </div>
        <!-- /.login-card-body -->
    </div>
    </div>
    <!-- /.login-box -->

    <!-- jQuery -->
    <script src="<?= BASE_URL_BLOG_RATIH ?>/assets/plugin/AdminLTE-3.2.0/plugins/jquery/jquery.min.js"></script>
    <!-- Bootstrap 4 -->
    <script src="<?= BASE_URL_BLOG_RATIH ?>/assets/plugin/AdminLTE-3.2.0/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- AdminLTE App -->
    <script src="<?= BASE_URL_BLOG_RATIH ?>/assets/plugin/AdminLTE-3.2.0/dist/js/adminlte.min.js"></script>
    <!-- jquery-validation -->
    <script src="<?= BASE_URL_BLOG_RATIH ?>/assets/plugin/AdminLTE-3.2.0/plugins/jquery-validation/jquery.validate.min.js"></script>
    <script src="<?= BASE_URL_BLOG_RATIH ?>/assets/plugin/AdminLTE-3.2.0/plugins/jquery-validation/additional-methods.min.js"></script>

    <!-- Page specific script -->
    <script>
        $(function() {
            $.validator.setDefaults({
                submitHandler: function() {
                    header("refresh:0;./dashboard.php");
                }
            });
            $('#quickForm').validate({
                rules: {
                    email: {
                        required: true,
                        email: true,
                    },
                    password: {
                        required: true,
                        minlength: 6
                    },
                    confirm_password: {
                        required: true,
                        minlength: 6
                    }
                },
                messages: {
                    email: {
                        required: "Please enter a email address",
                        email: "Please enter a valid email address"
                    },
                    password: {
                        required: "Please provide a password",
                        minlength: "Password harus lebih dari 6 karakter"
                    },
                    confirm_password: {
                        required: "Please provide a confirm password",
                        minlength: "Password dan confirm password tidak sama"
                    },
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