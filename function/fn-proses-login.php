<?php
session_start();

include_once "./fn-databese-connect.php";

if (isset($_POST['email']) && isset($_POST['password'])) {
    function validate($data)
    {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }
    $email = validate($_POST['email']);
    $password = validate(md5($_POST['password']));
    // echo '<pre>';
    // print_r($_POST);
    // echo '</pre>';

    if (empty($email)) {
        header("Location: ../index.php?error=Email is required");
        exit();
    } else if (empty($password)) {
        header("Location: ../index.php?error=Password is required");
        exit();
    } else {
        $sql = "Select * FROM table_users where email='$email' AND password='$password'";

        $result = mysqli_query($conn, $sql);

        if (mysqli_num_rows($result) === 1) {
            $row = mysqli_fetch_assoc($result);
            if ($row['email'] === $email && $row['password'] === $password) {
                $_SESSION['email'] = $row['email'];
                $_SESSION['password'] = $row['password'];
                $_SESSION['name'] = $row['name'];
                $_SESSION['photo'] = $row['photo'];
                $_SESSION['created_at'] = $row['created_at'];
                $_SESSION['updated_at'] = $row['updated_at'];
                $_SESSION['id'] = $row['id'];
                $_SESSION['logged_in'] = true;
                if (empty($row['name'])) {
                    echo "email: " . $row['email'];
                } else {
                    echo "name: " . $row['name'];
                }
                header("location: ../view/dashboard.php");
                exit();
            }
        } else {
            header("location: ../index.php?error=Email atau password anda salah, coba kembali.");
            exit();
        }
    }
} else {
    header("Location: ../index.php");
    exit();
}
