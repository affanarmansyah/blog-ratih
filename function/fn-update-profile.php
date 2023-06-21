<?php
include_once "./fn-databese-connect.php";

session_start();
$errors = array();

$id = $_SESSION['id']; // test affan
$name = $_POST['name'];
$email = $_POST['email'];
$password = $_POST['password'];
$confirmPassword = $_POST['confirm_password'];

if (empty($name)) {
    $errors[] = "Nama Tidak Boleh Kosong";
}

if (empty($email)) {
    $errors[] = "Email Tidak Boleh Kosong";
} else {
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Email Tidak Valid";
    }
}

if (!empty($password) && strlen($password) < 6) {
    $errors[] = "Password Tidak Boleh Kurang Dari 6 Huruf";
} else {
    if ($password != $confirmPassword) {
        $errors[] = "Password Dan Confirm Password Tidak Sama";
    }
}

if (!empty($errors)) {
    $errorData = '';
    foreach ($errors as $error) {
        echo $errorData .= $error . "<br>";
        header("location: ../view/edit-profile.php?error=" . $errorData);
    }
} else {
    // Lakukan proses upload foto jika ada file yang diunggah
    if (isset($_FILES['photo']) && $_FILES['photo']['error'] == UPLOAD_ERR_OK) {
        $photo = $_FILES['photo'];
        $photo_name = $photo['name'];
        $photo_tmp_name = $photo['tmp_name'];
        $photo_extension = pathinfo($photo_name, PATHINFO_EXTENSION);

        // Tentukan lokasi folder untuk menyimpan foto
        $upload_directory = "../assets/img/";
        $photo_path = $upload_directory . $photo_name; // ../assets/img/email.png

        // Pindahkan foto ke folder upload
        move_uploaded_file($photo_tmp_name, $photo_path);
    }
    if (!empty($password)) {
        $password = md5($password);
        $update = mysqli_query($conn, "UPDATE table_users SET name='$name', email='$email', password='$password', photo='$photo_name' WHERE id='$id'");
    } else {
        $update = mysqli_query($conn, "UPDATE table_users SET name='$name', email='$email',photo='$photo_name' WHERE id='$id'");
    }
    if ($update) {
        echo "<script> alert ('Data Berhasil DiUbah')</script>";
        header("refresh:0;../view/edit-profile.php");
        exit();
    } else {
        echo "<script> alert ('Data Tidak Berhasil Diubah')</script>";
        header("refresh:0;../view/edit-profile.php");
        exit();
    }
}
