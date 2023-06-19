<?php
include_once "./fn-databese-connect.php";

// Memasukkan data ke dalam tabel
$email = $_POST['email'];
$password = md5($_POST['password']);
$confirmPassword = md5($_POST['confirm_password']);
$name = $_POST['name'];
$created_at = $_POST['created_at'];
$updated_at = $_POST['updated_at'];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if ($password !== $confirmPassword) {
        $salah = "Password dan konfirmasi password tidak sama.";
        header("location: ../view/create-account.php?salah=Password dan konfirmasi password tidak sama.");
        exit();
    }

    if (empty($email)) {
        header("location: ../view/create-account.php?error=Email Tidak Boleh Kosong");
        exit();
    } else {
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            header("location: ../view/create-account.php?error=Email Tidak Valid");
            exit();
        }
    }

    if (empty($salah)) {
        $sql = "INSERT INTO table_users (email, password, name, photo, created_at, updated_at) 
            VALUES ('$email', '$password', '$name', '$photo', '$created_at', '$updated_at')";

        $query = "SELECT * FROM table_users WHERE email = '$email'";
        $result = mysqli_query($conn, $query);

        if (mysqli_num_rows($result) > 0) {
            // Email sudah terdaftar.
            header("location: ../view/create-account.php?error=Email sudah terdaftar.");
            exit();
        } else {
            $sukses = 'false';
            if (mysqli_query($conn, $sql)) {
                $sukses = 'true';
            }
            header("Location: ../view/create-account.php?sukses=$sukses");
        }
    }
}
