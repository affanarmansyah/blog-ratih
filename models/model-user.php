<?php

// function create account
function createAccount($data)
{
    include_once BASE_DIR_BLOG_RATIH . '/function/fn-databese-connect.php';


    $errors = array();

    $email = $data['email'];
    $password = $data['password'];
    $confirmPassword = $data['confirm_password'];
    $name = $data['name'];

    if (empty($email)) {
        $errors[] = "Email tidak boleh kosong";
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Email tidak valid";
    }

    if (!empty($email)) {
        $query = "SELECT * FROM table_users WHERE email = '$email'";
        $result = mysqli_query($conn, $query);

        if (mysqli_num_rows($result) > 0) {
            // Email sudah terdaftar.
            $errors[] = "Email sudah terdaftar";
        }
    }

    if (empty($password)) {
        $errors[] = "Password tidak boleh kosong";
    }

    $password = md5($password);

    if ($password !== md5($confirmPassword)) {
        $errors[] = "Password dan Confirm Password tidak sama";
    }

    if (!empty($errors)) {
        // Jika terdapat error, kembalikan array yang berisi status 'success' false dan daftar error.
        return [
            'success' => false,
            'errors' => $errors
        ];
    } else {
        $sql = "INSERT INTO table_users (email, password, name) 
            VALUES ('$email', '$password', '$name')";

        if (mysqli_query($conn, $sql)) {
            // Akun berhasil dibuat.
            return [
                'success' => true,
                'message' => "Created Account Sucssess"
            ];
        } else {
            // Gagal membuat akun.
            $errors[] = "Created Account Gagal";
            return [
                'success' => false,
                'errors' => $errors
            ];
        }
    }
}


// function Login

// function Login($data)
// {
//     session_start();

//     include_once '../function/fn-databese-connect.php';

//     $errors = array();

//     $email = $data['email'];
//     $password = $data['password'];

//     if (empty($email)) {
//         $errors[] = "Email Harus Diisi";
//     }

//     if (empty($password)) {
//         $errors[] = "Password Harus Diisi";
//     }

//     if (!empty($errors)) {
//         return [
//             'success' => false,
//             'message' => $errors
//         ];
//     } else {
//         $sql = "Select * FROM table_users where email='$email' AND password='$password'";

//         $result = mysqli_query($conn, $sql);

//         if (mysqli_num_rows($result) === 1) {
//             $row = mysqli_fetch_assoc($result);
//             if ($row['email'] === $email && $row['password'] === $password) {
//                 $_SESSION['email'] = $row['email'];
//                 $_SESSION['password'] = $row['password'];
//                 $_SESSION['name'] = $row['name'];
//                 $_SESSION['photo'] = $row['photo'];
//                 $_SESSION['created_at'] = $row['created_at'];
//                 $_SESSION['updated_at'] = $row['updated_at'];
//                 $_SESSION['id'] = $row['id'];
//                 $_SESSION['logged_in'] = true;
//                 if (empty($row['name'])) {
//                     echo "email: " . $row['email'];
//                 } else {
//                     echo "name: " . $row['name'];
//                 }
//                 header("location: ../view/dashboard.php");
//                 exit();
//             }
//         } else {
//             header("location: ../index.php?error=Email atau password anda salah, coba kembali.");
//             exit();
//         }
//     }
// }


// function updateProfile
function updateProfile($data, $files)
{

    include_once BASE_DIR_BLOG_RATIH . '/function/fn-databese-connect.php';


    $errors = array();

    $id = $data['id']; // test affan
    $name = $data['name'];
    $email = $data['email'];
    $password = $data['password'];
    $confirmPassword = $data['confirm_password'];

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
        return [
            'success' => false,
            'errors' => $errors
        ];
    } else {
        if (isset($files['photo']) && $files['photo']['error'] == UPLOAD_ERR_OK) {

            $photo = $files['photo'];
            $photo_name = $photo['name'];
            $photo_tmp_name = $photo['tmp_name'];
            $photo_extension = pathinfo($photo_name, PATHINFO_EXTENSION);

            // Tentukan lokasi folder untuk menyimpan foto
            $upload_directory = "../assets/img/";
            $photo_path = $upload_directory . $photo_name; // ../assets/img/email.png

            // Pindahkan foto ke folder upload
            move_uploaded_file($photo_tmp_name, $photo_path);
        } else {
            // ini foto lama 
            $query = "SELECT * FROM table_users WHERE id='$id'";
            $result = mysqli_query($conn, $query);
            $row = mysqli_fetch_assoc($result);
            $photo_name = $row['photo'];
        }
        // ini password lama 
        if (empty($password)) {
            $query = "SELECT * FROM table_users WHERE id='$id'";
            $result = mysqli_query($conn, $query);
            $row = mysqli_fetch_assoc($result);
            $password = $row['password'];
        } else {
            $password = md5($password);
        }
        $query = mysqli_query($conn, "UPDATE table_users SET name='$name', email='$email',password='$password', photo='$photo_name' WHERE id='$id'");
        mysqli_close($conn);

        return [
            'success' => true,
            'message' => "Updated Profile Sucssess"
        ];
    }
}


// function detail Profile
function detailProfile($id)
{
    include_once BASE_DIR_BLOG_RATIH . '/function/fn-databese-connect.php';


    $query = "SELECT * FROM table_users WHERE id = '$id';";
    $sql = mysqli_query($conn, $query);

    $result = mysqli_fetch_assoc($sql);
    return $result;
}
