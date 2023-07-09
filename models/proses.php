<?php
include_once "model-news.php";

// proses addNews
if (isset($_POST['submit'])) {
    if ($_POST['submit'] == "add") {
        $berhasil = create_news($_POST, $_FILES);
        if ($berhasil) {
            header("Location:../view/view-news.php");
            exit();
        } else {
            echo $berhasil;
            exit();
        }
    }
}

// proses updateNews
if (isset($_POST['submit'])) {
    if ($_POST['submit'] == "update") {
        $berhasil = update_news($_POST, $_FILES);
        if ($berhasil) {
            header("Location:../view/view-news.php");
            exit();
        } else {
            echo $berhasil;
            exit();
        }
    }
}

// proses deleteNews
if (isset($_GET['id'])) {
    $berhasil = delete($_GET['id']);
    if ($berhasil) {
        header("Location:../view/view-news.php");
        exit();
    } else {
        echo $berhasil;
        exit();
    }
}
