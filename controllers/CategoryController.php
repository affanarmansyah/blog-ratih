<?php
include_once "components/ConfigComponent.php";
include_once '../../models/model-news.php';
include_once '../../models/model-category.php';

session_start();

class CategoryController extends ConfigComponent
{
    public function pageListCategory($params)
    {
        $page = isset($params['page']) ? $params['page'] : 1;
        $search = isset($params['cari_disini']) ? $params['cari_disini'] : '';
        $limit = isset($params['limit']) ? $params['limit'] : 5;

        $categoryModel = new CategoryModel($this->connection);
        $categoryModel->listCategory($page, $search, $limit);

        if (isset($params['id'])) {
            $berhasil = $categoryModel->deleteCategory($params['id']);
            if ($berhasil) {
                header("Location:" . $this->baseUrl . "/view/category/list-category.php?berhasil=<b>Well done!</b> category deleted");
                exit();
            } else {
                echo $berhasil;
                exit();
            }
        }
        return [
            'page' => $page,
            'search' => $search,
            'limit' => $limit,
            'categoryrows' => $categoryModel->getCategoryRows(),
            'categorytotalpages' => $categoryModel->getCategoryTotalPages(),
        ];
    }

    public function pageCreateCategory($params)
    {
        $categoryModel = new CategoryModel($this->connection);
        // proses addNews
        if (isset($params['submit'])) {
            if ($params['submit'] == "save") {
                $berhasil = $categoryModel->createCategory($params);
                if ($berhasil) {
                    header("Location:" . $this->baseUrl . "/view/category/list-category.php?berhasil=<b>Well done!</b> Category created");
                    exit();
                } else {
                    echo $berhasil;
                    exit();
                }
            }
        }
    }

    public function pageDetailCategory($params)
    {
        $categoryModel = new CategoryModel($this->connection);

        $id = isset($params['id']) ? $params['id'] : '';

        return $categoryModel->detailUpdateCategory($id);
    }

    public function pageUpdateCategory($params)
    {
        $categoryModel = new CategoryModel($this->connection);
        $result = $categoryModel->detailUpdateCategory(isset($_GET['id']) ? $_GET['id'] : '');

        if (isset($params['submit'])) {
            if ($params['submit'] == "update") {
                $berhasil = $categoryModel->updateCategory($params);
                if ($berhasil) {
                    header("Location:" . $this->baseUrl . "/view/category/list-category.php?berhasil=<b>Well done!</b> category updated");
                    exit();
                } else {
                    echo $berhasil;
                    exit();
                }
            }
        }

        return $result;
    }
}
