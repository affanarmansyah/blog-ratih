<?php

// function view-news.php

// fungsi ini reternnya adalah row dari database dan totalnya
function listNews($page, $cari, $limit = 10)
{
    include_once '../function/fn-databese-connect.php';

    $offset = ($page - 1) * $limit; // Offset data
    $total_pages = ceil(mysqli_num_rows(mysqli_query($conn, "SELECT * FROM table_news")) / $limit);

    $query = "SELECT * FROM table_news order by id DESC LIMIT $limit OFFSET $offset";
    if (isset($cari)) {
        $cari_disini = $cari;
        $query = "SELECT * FROM table_news where title LIKE '%" . $cari_disini . "%' OR status LIKE '%" . $cari_disini . "%' OR created_at LIKE '%" . $cari_disini . "%'  order by id DESC LIMIT $limit OFFSET $offset";
        $total_pages = ceil(mysqli_num_rows(mysqli_query($conn, "SELECT * FROM table_news where title LIKE '%" . $cari_disini . "%' OR status LIKE '%" . $cari_disini . "%' OR created_at LIKE '%" . $cari_disini . "%'")) / $limit);
    }

    $result = mysqli_query($conn, $query);
    $row = mysqli_fetch_all($result, MYSQLI_ASSOC);

    // $testArray = ["sdfsd" => 1, 2, 3, 4];

    // print_r($testArray);
    // print_r($testArray[0]);

    // cara membuat array object
    return [
        'row' => $row,
        'total_pages' => $total_pages
    ];
}

function detailNews($id)
{
    include_once '../function/fn-databese-connect.php';

    $query = "SELECT * FROM table_news WHERE id = '$id';";
    $sql = mysqli_query($conn, $query);

    $result = mysqli_fetch_assoc($sql);
    return $result;
}

// function create-news.php
function create_news($data, $files)
{
    include_once '../function/fn-databese-connect.php';

    $title = $data['title'];
    $image = $files['image'];
    $description = $data['description'];
    $status = $data['status'];

    if (isset($image) && $image['error'] == UPLOAD_ERR_OK) {
        $image_name = $image['name'];
        $image_tmp_name = $image['tmp_name'];
        // $image_extension = pathinfo($image_name, PATHINFO_EXTENSION);
        $upload_directory = "../assets/img/";
        $image_path = $upload_directory . $image_name;

        move_uploaded_file($image_tmp_name, $image_path);
    }
    $query = "INSERT INTO table_news (title,image,description,status) VALUES ('$title','$image_name','$description','$status')";
    $result = mysqli_query($conn, $query);
    mysqli_close($conn);

    return true;
}


// function Update news
function updateNews($data, $files)
{
    include_once '../function/fn-databese-connect.php';
    $id = $data['id'];
    $title = $data['title'];
    $image = $files['image'];
    $description = $data['description'];
    $status = $data['status'];

    if (isset($image) && $image['error'] == UPLOAD_ERR_OK) {
        $image_name = $image['name'];
        $image_tmp_name = $image['tmp_name'];
        // $image_extension = pathinfo($image_name, PATHINFO_EXTENSION);

        // Tentukan lokasi folder untuk menyimpan foto
        $upload_directory = "../assets/img/";
        $image_path = $upload_directory . $image_name; // ../assets/img/email.png

        // Pindahkan foto ke folder upload
        move_uploaded_file($image_tmp_name, $image_path);
    } else {
        // Gunakan gambar lama jika tidak ada gambar baru
        $query = "SELECT * FROM table_news WHERE id='$id'";
        $result = mysqli_query($conn, $query);
        $row = mysqli_fetch_assoc($result);
        $image_name = $row['image'];
    }

    $query = "UPDATE table_news SET title='$title', image='$image_name', description='$description', status='$status' WHERE id='$id'";
    $result = mysqli_query($conn, $query);
    mysqli_close($conn);

    return true;
}


// function Delete news
function delete($id)
{
    include_once '../function/fn-databese-connect.php';
    return mysqli_query($conn, "DELETE from table_news WHERE id='$id'");
}
