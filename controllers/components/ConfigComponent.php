<?php

class ConfigComponent
{
    // private function untuk kegunaan di dalam class ini saja
    private $host = "localhost";
    private $username = "root";
    private $password = "";
    private $dbname = "ratih_blog";

    // public function untuk kegunaan global dimana saja
    public $connection;
    public $baseUrl;
    public $baseDir;

    public function __construct()
    {
        // call function databaseConnection
        $this->databaseConnection();

        // call function baseUrl
        $this->url();
    }

    // fungsi koneksi database
    private function databaseConnection()
    {
        $conn = mysqli_connect($this->host, $this->username, $this->password, $this->dbname);

        if (!$conn) {
            die("Connection failed: " . mysqli_connect_error());
        }

        $this->connection = $conn;
    }

    // fungsi pembuatan base url / path untuk kegunaan akses css, javascript dll
    private function url()
    {
        // link yang berhubugan dengan addres di browser http://localhost/blog-ratih/assets/plugin/AdminLTE-3.2.0/dist/img/ratih.webp
        $baseUrl = 'http://' . $_SERVER['SERVER_NAME'] . "/blog-ratih";

        // url real dari folder yang ada di komputer kita contoh: C:\xampp\htdocs\blog-ratih\view\news
        $dir = explode("\\", __DIR__);
        $baseDir = $dir[0] . '\\' . $dir[1] . '\\' . $dir[2] . '\\' . $dir[3];

        $this->baseUrl = $baseUrl;
        $this->baseDir = $baseDir;
    }
}
