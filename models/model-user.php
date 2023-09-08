<?php

class UserModel
{

    private $mysqlConnection;
    public $succsessResult;
    private $errors;

    public function __construct($conn)
    {
        $this->mysqlConnection = $conn;
    }

    public function setUser($result)
    {
        $this->succsessResult = $result;
    }

    public function getUser()
    {
        return $this->succsessResult;
    }

    public function setErrors($errors)
    {
        $this->errors = $errors;
    }

    public function getErrors()
    {
        return $this->errors;
    }

    // function create account
    public function createAccount($data)
    {
        $errors = array();

        $email = $data['email'];
        $password = $data['password'];
        $confirmPassword = $data['confirm_password'];

        if (empty($email)) {
            $errors[] = "Email tidak boleh kosong";
        }

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $errors[] = "Email tidak valid";
        }

        if (!empty($email)) {
            $query = "SELECT * FROM table_users WHERE email = '$email'";
            $result = mysqli_query($this->mysqlConnection, $query);

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
            $this->setErrors([
                'success' => false,
                'errors' => $errors
            ]);

            return;
        } else {
            $sql = "INSERT INTO table_users (email, password) 
            VALUES ('$email', '$password')";

            if (mysqli_query($this->mysqlConnection, $sql)) {
                // Akun berhasil dibuat.
                $this->setUser(
                    [
                        'success' => true,
                        'message' => "Created Account Sucssess"
                    ]
                );

                return;
            } else {
                // Gagal membuat akun.
                $errors[] = "Created Account Gagal";
                $this->setErrors([
                    'success' => false,
                    'errors' => $errors
                ]);

                return;
            }
        }
    }

    // function updateProfile
    public function updateProfile($data, $files)
    {
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
            $this->setErrors([
                'success' => false,
                'errors' => $errors
            ]);
        } else {
            if (isset($files['photo']) && $files['photo']['error'] == UPLOAD_ERR_OK) {

                $photo = $files['photo'];
                $photo_name = $photo['name'];
                $photo_tmp_name = $photo['tmp_name'];
                $photo_extension = pathinfo($photo_name, PATHINFO_EXTENSION);
                $upload_directory = "../assets/img/";
                $photo_path = $upload_directory . $photo_name;
                move_uploaded_file($photo_tmp_name, $photo_path);
            } else {
                // ini foto lama 
                $query = "SELECT * FROM table_users WHERE id='$id'";
                $result = mysqli_query($this->mysqlConnection, $query);
                $row = mysqli_fetch_assoc($result);
                $photo_name = $row['photo'];
            }
            // ini password lama 
            if (empty($password)) {
                $query = "SELECT * FROM table_users WHERE id='$id'";
                $result = mysqli_query($this->mysqlConnection, $query);
                $row = mysqli_fetch_assoc($result);
                $password = $row['password'];
            } else {
                $password = md5($password);
            }
            $query = mysqli_query($this->mysqlConnection, "UPDATE table_users SET name='$name', email='$email',password='$password', photo='$photo_name',updated_at=NOW() WHERE id='$id'");
            mysqli_close($this->mysqlConnection);

            $this->setUser(
                [
                    'success' => true,
                    'message' => "Updated Profile Sucssess",
                    'photo' => $photo_name
                ]
            );
            return;
        }
    }


    // function detail Profile
    public function detailProfile($id)
    {


        $query = "SELECT * FROM table_users WHERE id = '$id';";
        $sql = mysqli_query($this->mysqlConnection, $query);

        $result = mysqli_fetch_assoc($sql);
        return $result;
    }

    // function untuk login
    public function login($email, $password)
    {
        $sql = "Select * FROM table_users where email='$email' AND password='$password'";
        $result = mysqli_query($this->mysqlConnection, $sql);

        return [
            'success' => mysqli_num_rows($result),
            'row' => mysqli_fetch_assoc($result)
        ];
    }
}
