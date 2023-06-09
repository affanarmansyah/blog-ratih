<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Create Account</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="../assets/plugin/AdminLTE-3.2.0/plugins/fontawesome-free/css/all.min.css">
    <!-- icheck bootstrap -->
    <link rel="stylesheet" href="../assets/plugin/AdminLTE-3.2.0/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="../assets/plugin/AdminLTE-3.2.0/dist/css/adminlte.min.css">
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

<?php
$info = "";
if (!empty($_GET['sukses'])) {
    $info = "<div class='info-insert-data'>Insert Data Gagal</div><br>";

    if ($_GET['sukses'] == "true") {
        $info = "<div class='info-insert-data'>Create Account Succses ✓</div><br>";
    }
}
?>

<body class="hold-transition login-page">
    <div class="login-box">
        <div class="login-logo">
            <a href="./index2.php"><b>Ratih</b>Blog</a>
        </div>
        <!-- /.login-logo -->
        <div class="card">
            <div class="card-body login-card-body">
                <h5 class="login-box-msg">Register</h5>

                <?php echo $info ?>
                <?php if (isset($_GET['error'])) { ?>
                    <p class="error" style="background: #f2dede; color: #A94442; padding: 8px; width: 100%; border-radius: 5px; font-size: 13px;"><?php echo $_GET['error']; ?></p>
                <?php } ?>


                <form action="../function/fn-create-acoount.php" method="post" id="quickForm" enctype="multipart/form-data">
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


                        <?php if (isset($_GET['salah'])) { ?>
                            <p class="error" style="background: #f2dede; color: #A94442; padding: 8px; width: 100%; border-radius: 5px; font-size: 13px;"><?php echo $_GET['salah']; ?></p>
                        <?php } ?>


                    </div>
                    <!-- /.card-body -->
                    <input type="submit" style="background-color: #03a9f4; padding: 5px; width: 110px; border: none; color: #fff; border-radius: 5px;" name="login" value="Submit">
                    <a href="../index.php">
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
    <script src="../assets/plugin/AdminLTE-3.2.0/plugins/jquery/jquery.min.js"></script>
    <!-- Bootstrap 4 -->
    <script src="../assets/plugin/AdminLTE-3.2.0/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- AdminLTE App -->
    <script src="../assets/plugin/AdminLTE-3.2.0/dist/js/adminlte.min.js"></script>
    <!-- jquery-validation -->
    <script src="../assets/plugin/AdminLTE-3.2.0/plugins/jquery-validation/jquery.validate.min.js"></script>
    <script src="../assets/plugin/AdminLTE-3.2.0/plugins/jquery-validation/additional-methods.min.js"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="../assets/plugin/AdminLTE-3.2.0/dist/js/demo.js"></script>
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