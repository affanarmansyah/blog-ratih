<?php
include_once 'menu.php';
include_once '../models/model-news.php';

// proses deleteNews
if (isset($_GET['id'])) {
    delete($_GET['id']);
}
