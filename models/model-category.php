<?php


class CategoryModel
{

    private $mysqlConnection;
    private $categoryRows;
    private $categoryTotalPages;

    public function __construct($conn)
    {
        $this->mysqlConnection = $conn;
    }

    private function setCategoryRows($row)
    {
        $this->categoryRows = $row;
    }

    public function getCategoryRows()
    {
        return $this->categoryRows;
    }

    private function setCategoryTotalPages($total_pages)
    {
        $this->categoryTotalPages = $total_pages;
    }

    public function getCategoryTotalPages()
    {
        return $this->categoryTotalPages;
    }

    // function view category
    public function listCategory($page, $cari, $limit = 10)
    {
        $offset = ($page - 1) * $limit; // Offset data
        $total_pages = ceil(mysqli_num_rows(mysqli_query($this->mysqlConnection, "SELECT * FROM table_category")) / $limit);

        $query = "SELECT * FROM table_category order by id DESC LIMIT $limit OFFSET $offset";
        if (isset($cari)) {
            $cari_disini = $cari;
            $query = "SELECT * FROM table_category where name LIKE '%" . $cari_disini . "%'  order by id DESC LIMIT $limit OFFSET $offset";
            $total_pages = ceil(mysqli_num_rows(mysqli_query($this->mysqlConnection, "SELECT * FROM table_category where name LIKE '%" . $cari_disini . "%'")) / $limit);
        }

        $result = mysqli_query($this->mysqlConnection, $query);
        $row = mysqli_fetch_all($result, MYSQLI_ASSOC);

        $this->setCategoryRows($row);
        $this->setCategoryTotalPages($total_pages);
    }


    // function create-category.php
    public function createCategory($data)
    {
        $name = $data['name'];

        $query = "INSERT INTO table_category (name) VALUES ('$name')";
        $result = mysqli_query($this->mysqlConnection, $query);
        mysqli_close($this->mysqlConnection);

        return true;
    }

    // function Update Category
    public function updateCategory($data)
    {
        $id = $data['id'];
        $name = $data['name'];

        $query = "UPDATE table_category SET name='$name' WHERE id='$id'";
        $result = mysqli_query($this->mysqlConnection, $query);
        mysqli_close($this->mysqlConnection);

        return true;
    }

    // function detail category
    public function detailUpdateCategory($id)
    {
        $query = "SELECT * FROM table_category WHERE id = '$id';";
        $sql = mysqli_query($this->mysqlConnection, $query);

        $result = mysqli_fetch_assoc($sql);
        return $result;
    }

    // function Delete category
    public function deleteCategory($id)
    {
        mysqli_query($this->mysqlConnection, "DELETE from table_category WHERE id='$id'");
        return true;
    }
}
