<?php
include_once "components/ConfigComponent.php";
include_once '../../models/model-user.php';

// start session for add user data
session_start();

class LoginController extends ConfigComponent
{
    public function pageLogin($login)
    {
        if (isset($login['email']) && isset($login['password'])) {
            // panggil class model user
            $userModel = new UserModel($this->connection);

            $email = $login['email'];
            $password = md5($login['password']);

            if (empty($email)) {
                header("Location: ../login/login.php?error=Email is required");
                exit();
            } else if (empty($password)) {
                header("Location: ../login/login.php?error=Password is required");
                exit();
            } else {
                $login = $userModel->login($email, $password);

                if ($login['success'] === 1) {
                    $row = $login['row'];
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
                        header("location: ../dashboard.php");
                        exit();
                    }
                } else {
                    header("location: ../login/login.php?error=Email atau password anda salah, coba kembali.");
                    exit();
                }
            }
        } else {
            header("Location: ../login/login.php");
            exit();
        }
    }

    public function pageLogout()
    {
        session_start();

        session_unset();
        session_destroy();

        header("Location: ../../index.php");
    }
}
