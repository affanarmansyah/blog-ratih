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

    public function pageUpdateProfile($params, $files)
    {

        $update = new UserModel($this->connection);


        if (isset($params['submit'])) {
            if ($params['submit'] == "Save") {
                // untuk update
                $update->updateProfile($params, $files);
            }

            $feedback = $update->getUser();
            $feedbackErrors = $update->getErrors();

            if ($feedback['success']) {
                // update session ketika berhasil update
                $_SESSION['email'] = $params['email'] ? $params['email'] : $_SESSION['email'];
                $_SESSION['name'] = $params['name'] ? $params['name'] : $_SESSION['name'];
                $_SESSION['photo'] = $files['photo'] ? $files['photo']['name'] : $_SESSION['photo'];
                $_SESSION['updated_at'] = $params['updated_at'] ? $params['updated_at'] : $_SESSION['updated_at'];

                header("Location:" . $this->baseUrl . "/view/user/edit-profile.php?success=" . $feedback['message']);
                exit();
            } else {
                // Jika terdapat error, redirect ke halaman create-account.php dengan parameter error.
                $errorData = implode("<br>", $feedbackErrors['errors']);
                header("Location:" . $this->baseUrl . "/view/user/edit-profile.php?error=" . $errorData);
                exit();
            }
        }
    }

    public function pageDetailProfile($params)
    {
        $detail = new UserModel($this->connection);

        $id = isset($params['id']) ? $params['id'] : '';
        $result = $detail->detailProfile($id);

        return $result;
    }


    public function pageCreateAccount($params)
    {
        $register = new UserModel($this->connection);


        if (isset($params['create-user'])) {
            if ($params['create-user'] == "Create") {

                $result = $register->createAccount($params);
            }

            $feedback = $register->getUser();
            $feedbackErrors = $register->getErrors();

            if ($feedback['success']) {
                // Jika akun berhasil dibuat, redirect ke halaman create-account.php dengan parameter success.
                header("Location:" . $this->baseUrl . "/view/user/create-account.php?success=" . $feedback['message']);
                exit();
            } else {
                // Jika terdapat error, redirect ke halaman create-account.php dengan parameter error.
                $errorData = implode("<br>", $feedbackErrors['errors']);
                header("Location:" . $this->baseUrl . "/view/user/create-account.php?error=" . $errorData);
                exit();
            }
        }
    }
}
