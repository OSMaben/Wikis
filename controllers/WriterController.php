<?php
namespace app\controllers;

use app\Models\WriterModel;
use app\core\Router;

class WriterController
{

    private WriterModel $writerModel;
    public Router $router;

    public function __construct()
    {
        $this->writerModel = new WriterModel();
        $this->router = new Router();
    }

    public function showData()
    {
        if (isset($_SESSION['role']) && $_SESSION['role'] == 'Reader') {
            $data = $this->writerModel->show('categories', ['CategoryID', 'CategoryName']);
            $tags = $this->writerModel->show('tags', ['TagID', 'TagName']);

            if ($data) {
                return $this->router->renderView("addArticle", ["data" => $data, "tags" => $tags]);
            } else
                return false;
        } else {
            return $this->router->redirect('/');
        }


    }

    public function AddWiki()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            if (!empty($_POST['category']) && !empty($_POST['tags']) && !empty($_POST['title'])
                && !empty($_POST['content'])) {
                $category = $_POST['category'];

                $tags = $_POST['tags'];
                $title = $_POST['title'];
                $content = $_POST['content'];
                $imgname = $_FILES["image"]["name"];
                $imgtmpname = $_FILES["image"]["tmp_name"];
                $folder = "./assets/img/dataBase/" . $imgname;

                $this->writerModel->insertWiki($category, $tags, $title, $content, $imgname, $_SESSION['idUser']);

                if (move_uploaded_file($imgtmpname, $folder)) {
                    echo "<h3>  Image uploaded successfully!</h3>";
                } else {
                    echo "<h3>  Failed to upload image!</h3>";
                }
                return $this->router->redirect('/');
            }
//            else
//            {
//                return $this->router->redirect('/addArticle');
//            }
        }
    }


    public function showWikis()
    {
        $wikis = $this->writerModel->showWikisModel();

        return $this->router->renderView('home', ['wikis' => $wikis]);
    }

    public function showSinglWikis()
    {
        $singleWiki = $this->writerModel->showSignlWiki($_GET['id']);
        $category = $this->writerModel->getCategry($_GET['id']);
        return $this->router->renderView('blog-single', ['singleWiki' => $singleWiki, "category" => $category]);
    }


    public function UpdateWiki()
    {
        $id = $_GET['id'];

        $wikiContent = $this->writerModel->updateSingWiki('wikis', ['wikisID', 'Title', 'Content', 'PublishedDate'], $id);
        $data = $this->writerModel->UpdateSingleCategry();
        $tags = $this->writerModel->UpdateSingleTag();
        return $this->router->renderView('updateWiki', ['wikiContent' => $wikiContent, "data" => $data, 'tags' => $tags]);
    }


    public function changeWikiContent()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            if (!empty($_POST['category']) && !empty($_POST['tags']) && !empty($_POST['title'])
                && !empty($_POST['content'])) {
                $title = $_POST['title'];
                $content = $_POST['content'];
                $imgname = $_FILES["image"]["name"];
                $imgtmpname = $_FILES["image"]["tmp_name"];
                $folder = "./assets/img/dataBase/" . $imgname;

                $this->writerModel->UpdateSingWikiWrite($title, $content, $imgname, $_GET['id']);

                if (move_uploaded_file($imgtmpname, $folder)) {
                    echo "<h3>  Image uploaded successfully!</h3>";
                } else {
                    echo "<h3>  Failed to upload image!</h3>";
                }
                return $this->router->redirect('/profile');
            }
        }
    }


}





