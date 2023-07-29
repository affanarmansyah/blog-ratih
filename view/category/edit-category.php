<?php
include_once __DIR__ . '/../../function/base.php'; // first to call have use __DIR__

include_once BASE_DIR_BLOG_RATIH . '/view/menu.php';
include_once BASE_DIR_BLOG_RATIH . '/models/model-category.php';
// proses updateNews
if (isset($_POST['submit'])) {
    if ($_POST['submit'] == "update") {
        $berhasil = updateCategory($_POST);
        if ($berhasil) {
            header("Location:" . BASE_URL_BLOG_RATIH . "/view/category/list-category.php?berhasil=<b>Well done!</b> category updated");
            exit();
        } else {
            echo $berhasil;
            exit();
        }
    }
}

$result = detailUpdateCategory(isset($_GET['id']) ? $_GET['id'] : '')

?>
<!DOCTYPE html>
<html>

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
    <style>
        body {
            background-color: #f2f2f2;
        }

        h1 {
            text-align: center;
        }

        form {
            max-width: 400px;
            margin-left: 270px;
            background-color: #ffffff;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        label {
            display: block;
            margin-bottom: 10px;
            color: #555555;
        }

        input[type="text"],
        textarea,
        input[type="number"],
        select,
        input[type="datetime-local"] {
            width: 100%;
            padding: 8px;
            border: 1px solid #cccccc;
            border-radius: 4px;
            box-sizing: border-box;
            font-family: inherit;
            font-size: 14px;
            color: #555555;
            margin-bottom: 15px;
        }

        textarea {
            height: 120px;
            resize: vertical;
        }

        select {
            font-family: Arial, sans-serif;
            height: 35px;
        }

        input[type="file"] {
            margin-bottom: 15px;
        }

        input[type="submit"] {
            background-color: #4CAF50;
            color: #ffffff;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 14px;
        }

        input[type="submit"]:hover {
            background-color: #45a049;
        }
    </style>
</head>

<body>
    <section class="content-header">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Update Category</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="<?= BASE_URL_BLOG_RATIH ?>/view/dashboard.php">Home</a></li>
                    <li class="breadcrumb-item active">Update Category</li>
                </ol>
            </div>
        </div>
    </section>

    <form action="" method="POST" enctype="multipart/form-data">
        <input type="hidden" name="id" value="<?php echo $result['id']; ?>">

        <label for="name">Name:</label>
        <input type="text" id="name" name="name" value="<?php echo $result['name']; ?>" required>

        <input type="submit" name="submit" value="update">
    </form>
    <!-- jQuery -->
    <script src="<?= BASE_URL_BLOG_RATIH ?>/assets/plugin/AdminLTE-3.2.0/plugins/jquery/jquery.min.js"></script>
    <!-- Bootstrap 4 -->
    <script src="<?= BASE_URL_BLOG_RATIH ?>/assets/plugin/AdminLTE-3.2.0/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- bs-custom-file-input -->
    <script src="<?= BASE_URL_BLOG_RATIH ?>/assets/plugin/AdminLTE-3.2.0/plugins/bs-custom-file-input/bs-custom-file-input.min.js"></script>
    <!-- AdminLTE App -->
    <script src="<?= BASE_URL_BLOG_RATIH ?>/assets/plugin/AdminLTE-3.2.0/dist/js/adminlte.min.js"></script>
</body>

</html>