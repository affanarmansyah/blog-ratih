<?php

include_once __DIR__ . '/../../function/base.php'; // first to call have use __DIR__

include_once BASE_DIR_BLOG_RATIH . '/view/menu.php';
include_once BASE_DIR_BLOG_RATIH . '/models/model-news.php';
include_once BASE_DIR_BLOG_RATIH . '/models/model-category.php';

$newsModel = new NewsModel($conn);
$categoryModel = new CategoryModel($conn);
// proses updateNews
if (isset($_POST['submit'])) {
    if ($_POST['submit'] == "Update") {
        $berhasil = $newsModel->updateNews($_POST, $_FILES);
        if ($berhasil) {
            header("Location: " . BASE_URL_BLOG_RATIH . " /view/news/list-news.php?berhasil=<b>Well done!</b> News updated");
            exit();
        } else {
            echo $berhasil;
            exit();
        }
    }
}

$result = $newsModel->detailUpdateNews($_GET['id']);
$categories = $categoryModel->listCategory(1, "", 1000);

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
                <h1>Update News</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="<?= BASE_URL_BLOG_RATIH ?>/view/dashboard.php">Home</a></li>
                    <li class="breadcrumb-item active">Update News</li>
                </ol>
            </div>
        </div>
    </section>

    <form action="" method="POST" enctype="multipart/form-data">
        <input type="hidden" name="id" value="<?php echo $result['id']; ?>">
        <label for="title">Title:</label>
        <input type="text" id="title" name="title" value="<?php echo $result['title']; ?>" required>

        <label for="image">Image URL:</label>
        <img src="<?= BASE_URL_BLOG_RATIH ?>/assets/img/<?php echo $result['image'] ? $result['image'] : 'default-news.png'; ?>" style="width: 50px; height: 50px;">
        <br>
        <input type="file" name="image" style="margin-top: 10px;">

        <label for="description">Description:</label>
        <input type="text" name="description" value="<?php echo $result['description']; ?>" required></input>

        <label for="status">Status:</label>
        <select id="status" name="status" required>
            <?php
            $active = $result['status'] == 'Active' ? 'selected' : "";
            $inactive = $result['status'] == 'Non Active' ? 'selected' : "";
            ?>
            <option value="Active" <?= $active ?> value="Active">Active</option>
            <option value="Non Active" <?= $inactive ?> value="Non Active">Non Active</option>
        </select>
        <label for="status">Category:</label>
        <select id="category" name="category_id" required>
            <?php

            foreach ($categoryModel->getCategoryRows() as $category) {
                $selected = $category['id'] == $result['category_id'] ? 'selected' : "";
                echo '<option value="' . $category['id'] . '" ' . $selected . '>' . $category['name'] . '</option>';
            }

            ?>
        </select>
        <input type="submit" name="submit" value="Update" style="font-size: medium;">
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