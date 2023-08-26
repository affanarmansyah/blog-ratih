<?php
include_once __DIR__ . '../../../function/base.php'; // first to call have use __DIR__
include_once BASE_DIR_BLOG_RATIH . '/controllers/LoginController.php';

$login = new LoginController;
$login->pageLogout();
