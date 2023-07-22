<?php
include_once 'menu.php';
include_once '../models/model-news.php';

// proses addNews
if (isset($_POST['submit'])) {
    if ($_POST['submit'] == "add") {
        $berhasil = createNews($_POST, $_FILES);
        if ($berhasil) {
            header("Location:../view/view-news.php?berhasil=<b>Well done!</b> News created");
            exit();
        } else {
            echo $berhasil;
            exit();
        }
    }
}

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
    <link rel="stylesheet" href="../assets/plugin/AdminLTE-3.2.0/plugins/fontawesome-free/css/all.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="../assets/plugin/AdminLTE-3.2.0/dist/css/adminlte.min.css">
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
                <h1>Create News</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active">General Form</li>
                </ol>
            </div>
        </div>
    </section>

    <form action="" method="POST" enctype="multipart/form-data">
        <label for="title">Title:</label>
        <input type="text" id="title" name="title" required>

        <label for="image">Image URL:</label>
        <input type="file" name="image">

        <label for="description">Description:</label>
        <input type="text" name="description" required></input>

        <label for="status">Status:</label>
        <select id="status" name="status" required>
            <option value="Active">Active</option>
            <option value="Non Active">Non Active</option>
        </select>
        <input type="submit" name="submit" value="add">
    </form>
    <!-- jQuery -->
    <script src="../assets/plugin/AdminLTE-3.2.0/plugins/jquery/jquery.min.js"></script>
    <!-- Bootstrap 4 -->
    <script src="../assets/plugin/AdminLTE-3.2.0/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- bs-custom-file-input -->
    <script src="../assets/plugin/AdminLTE-3.2.0/plugins/bs-custom-file-input/bs-custom-file-input.min.js"></script>
    <!-- AdminLTE App -->
    <script src="../assets/plugin/AdminLTE-3.2.0/dist/js/adminlte.min.js"></script>
</body>

</html>