<?php
include_once "./fn-databese-connect.php";

session_start();

// Mendapatkan data yang dikirim melalui form
$id = $_SESSION['id'];
$name = $_POST['name'];
$email = $_POST['email'];
$password = md5($_POST['password']);
$confirm_password = md5($_POST['confirm_password']);

// Validasi data yang diterima
$errors = array(); // $errors = []

if (empty($name)) {
    $errors[] = 'Name is required'; // $errors[0] = ['Name is required']
}

if (empty($email)) {
    $errors[] = 'Email address is required'; // $errors[1] = ['Name is required']
} elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $errors[] = 'Invalid email address';
}

if (empty($password)) {
    $errors[] = 'Password is required';
} elseif (strlen($password) < 6) {
    header("location: ../view/edit-profile.php?error=Email atau password anda salah, coba kembali.");
}

if ($password !== $confirm_password) {
    $wrong = "Password dan konfirmasi password tidak sama.";
    header("location: ../view/edit-profile.php?wrong=Password dan konfirmasi password tidak sama.");
    exit();
}
// Cek apakah ada kesalahan validasi
if (!empty($errors)) {
    // Jika terdapat kesalahan, tampilkan pesan error

    $errorData = '';
    // $errors = ['Name is required', 'Email address is required', 'Password is required']
    foreach ($errors as $error) {
        echo $errorData .= $error . "<br>";
    }
    header("location: ../view/edit-profile.php?error=" . $errorData);
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
    $update = mysqli_query($conn, "UPDATE table_users SET name='$name', email='$email', password='$password', photo='$photo_name' WHERE id='$id'");


    if ($update) {
        echo "<script> alert ('Data Berhasil Di Update')</script>";
        header("refresh:0;../view/view-profile.php");
    } else {
        echo "<script> alert ('Data Tidak Berhasil Di Update')</script>";
        header("refresh:0;../view/view-profile.php");
    }
    // update ke database

    // Tampilkan pesan sukses atau lakukan redirect ke halaman lain
    echo "Profile updated successfully";
    // header("Location: view-profile.php"); // Uncomment ini jika ingin melakukan redirect ke halaman lain setelah update
    exit();
}
