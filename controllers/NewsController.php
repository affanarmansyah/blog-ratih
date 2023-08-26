<?php
include_once "components/ConfigComponent.php";
include_once '../../models/model-news.php';

// start session for add user data
session_start();

class NewsController extends ConfigComponent
{
    public function pageListNews()
    {
        $page = isset($listNews['page']) ? $listNews['page'] : 1;
        $search = isset($listNews['cari_disini']) ? $listNews['cari_disini'] : '';
        $limit = isset($listNews['limit']) ? $listNews['limit'] : 10;

        $newsModel = new NewsModel($this->connection);
        $newsModel->listNews($page, $search, $limit);

        if (isset($listNews['id'])) {
            $berhasil = $newsModel->deleteNews($listNews['id']);
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
}
