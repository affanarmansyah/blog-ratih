<?php

// function view category
function listCategory($page, $cari, $limit = 10)
{
    include_once BASE_DIR_BLOG_RATIH . '/function/fn-databese-connect.php';


    $offset = ($page - 1) * $limit; // Offset data
    $total_pages = ceil(mysqli_num_rows(mysqli_query($conn, "SELECT * FROM table_category")) / $limit);

    $query = "SELECT * FROM table_category order by id DESC LIMIT $limit OFFSET $offset";
    if (isset($cari)) {
        $cari_disini = $cari;
        $query = "SELECT * FROM table_category where name LIKE '%" . $cari_disini . "%'  order by id DESC LIMIT $limit OFFSET $offset";
        $total_pages = ceil(mysqli_num_rows(mysqli_query($conn, "SELECT * FROM table_category where name LIKE '%" . $cari_disini . "%'")) / $limit);
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


// function create-category.php
function createCategory($data)
{
    include_once BASE_DIR_BLOG_RATIH . '/function/fn-databese-connect.php';


    $name = $data['name'];

    $query = "INSERT INTO table_category (name) VALUES ('$name')";
    $result = mysqli_query($conn, $query);
    mysqli_close($conn);

    return true;
}

// function Update Category
function updateCategory($data)
{
    include_once BASE_DIR_BLOG_RATIH . '/function/fn-databese-connect.php';

    $id = $data['id'];
    $name = $data['name'];

    $query = "UPDATE table_category SET name='$name' WHERE id='$id'";
    $result = mysqli_query($conn, $query);
    mysqli_close($conn);

    return true;
}

// function detail category
function detailUpdateCategory($id)
{
    include_once BASE_DIR_BLOG_RATIH . '/function/fn-databese-connect.php';


    $query = "SELECT * FROM table_category WHERE id = '$id';";
    $sql = mysqli_query($conn, $query);

    $result = mysqli_fetch_assoc($sql);
    return $result;
}

// function Delete category
function deleteCategory($id)
{
    include_once BASE_DIR_BLOG_RATIH . '/function/fn-databese-connect.php';


    mysqli_query($conn, "DELETE from table_category WHERE id='$id'");
    return true;
}
