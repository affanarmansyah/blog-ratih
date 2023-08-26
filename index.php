<?php
session_start();
if (isset($_SESSION['logged_in'])) {
  header("refresh:0;./view/dashboard.php");
} else {
  header("refresh:0;./view/login/login.php");
}
