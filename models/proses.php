<?php
include_once "model-news.php";





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
