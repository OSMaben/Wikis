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
        $data = $this->writerModel->show('categories', ['CategoryID', 'CategoryName']);

        // Pass the $data variable to the view
        return $this->router->renderView('addArticle', ['data' => $data]);
    }
//    public function AddWiki()
//    {
//        if($_SERVER['REQUEST_METHOD'] == 'POST')
//        {
//            $category = $_POST['category'];
//            $tags = $_POST['tags'];
//            $title = $_POST['title'];
//            $content = $_POST['content'];
//
//           $this->writerModel->insert();
//
//        }
//    }
}