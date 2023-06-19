<?php 
include_once "./fn-databese-connect.php";

$title = $_POST['title'];
$image = $_POST['image']['name'];
$description = $_POST['description'];
$view = $_POST['view'];
$status = $_POST['status'];

if (isset($_FILES['image']) && $_FILES['image']['error'] == UPLOAD_ERR_OK) {
    $image = $_FILES['image'];
    $image_name = $image['name'];
    $image_tmp_name = $image['tmp_name'];
    $image_extension = pathinfo($image_name, PATHINFO_EXTENSION);

    // Tentukan lokasi folder untuk menyimpan foto
    $upload_directory = "../assets/img/";
    $image_path = $upload_directory . $image_name; // ../assets/img/email.png

    // Pindahkan foto ke folder upload
    move_uploaded_file($image_tmp_name, $image_path);
    $query = "INSERT INTO table_news (title,image,description,view,status) VALUES ('$title','$image',$description','$view','$status')";
    $result = mysqli_query($conn, $query);
}
