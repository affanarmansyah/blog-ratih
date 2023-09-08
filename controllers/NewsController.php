<?php
include_once "components/ConfigComponent.php";
include_once '../../models/model-news.php';
include_once '../../models/model-category.php';

// start session for add user data
session_start();

class NewsController extends ConfigComponent
{
    public function pageListNews($params)
    {
        $page = isset($params['page']) ? $params['page'] : 1;
        $search = isset($params['cari_disini']) ? $params['cari_disini'] : '';
        $limit = isset($params['limit']) ? $params['limit'] : 10;

        $newsModel = new NewsModel($this->connection);
        $newsModel->listNews($page, $search, $limit);

        if (isset($params['id'])) {
            $berhasil = $newsModel->deleteNews($params['id']);
            if ($berhasil) {
                header("Location:" . $this->baseUrl . "/view/news/list-news.php?berhasil=<b>Well done!</b> News deleted");
                exit();
            } else {
                echo $berhasil;
                exit();
            }
        }

        return [
            'newsTotalPages' => $newsModel->getNewsTotalPages(),
            'newsRows' => $newsModel->getNewsRows(),
            'page' => $page,
            'limit' => $limit,
            'search' => $search,
        ];
    }

    public function pageCreateNews($params, $files)
    {

        $newsModel = new NewsModel($this->connection);
        $categoryModel = new CategoryModel($this->connection);

        // proses addNews
        if (isset($params['submit'])) {
            if ($params['submit'] == "add") {
                $berhasil = $newsModel->createNews($params, $files);
                if ($berhasil) {
                    header("Location:" . $this->baseUrl . "/view/news/list-news.php?berhasil=<b>Well done!</b> News created");
                    exit();
                } else {
                    echo $berhasil;
                    exit();
                }
            }
        }

        return [
            'categories' => $categoryModel->listCategory(1, "", 1000),
            'categoryRows' => $categoryModel->getCategoryRows(),
        ];
    }

    public function pageDetailNews($params)
    {
        $id = isset($params['id']) ? $params['id'] : '';

        $newsModel = new NewsModel($this->connection);

        return $newsModel->detailUpdateNews($id);
    }

    public function pageUpdateNews($params, $files)
    {
        $newsModel = new NewsModel($this->connection);
        $categoryModel = new CategoryModel($this->connection);
        $categoryModel->listCategory(1, "", 1000);

        $result = $newsModel->detailUpdateNews($_GET['id']);

        // proses updateNews
        if (isset($params['submit'])) {
            if ($params['submit'] == "Update") {
                $berhasil = $newsModel->updateNews($params, $files);
                if ($berhasil) {
                    header("Location: " . $this->baseUrl . " /view/news/list-news.php?berhasil=<b>Well done!</b> News updated");
                    exit();
                } else {
                    echo $berhasil;
                    exit();
                }
            }
        }

        return [
            'categories' => $categoryModel->getCategoryRows(),
            'result' => $result,
        ];
    }
}
