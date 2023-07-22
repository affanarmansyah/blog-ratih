<?php

// link yang berhubugan dengan addres di browser http://localhost/blog-ratih/assets/plugin/AdminLTE-3.2.0/dist/img/ratih.webp
$baseUrl = 'http://' . $_SERVER['SERVER_NAME'] . "/blog-ratih";

// url real dari folder yang ada di komputer kita contoh: C:\xampp\htdocs\blog-ratih\view\news
$dir = explode("\\", __DIR__);
$baseDir = $dir[0] . '\\' . $dir[1] . '\\' . $dir[2] . '\\' . $dir[3];

// fungsi untuk membuat constat global
define("BASE_URL_BLOG_RATIH", $baseUrl);
define("BASE_DIR_BLOG_RATIH", $baseDir);
