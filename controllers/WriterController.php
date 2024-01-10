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
       if(isset($_SESSION['role']) && $_SESSION['role'] == 'Reader')
       {
           $data = $this->writerModel->show('categories', ['CategoryID', 'CategoryName']);
           $tags = $this->writerModel->show('tags', ['TagID', 'TagName']);

           if($data)
           {
               return $this->router->renderView("addArticle", ["data" => $data, "tags" =>$tags]);
           }
           else
               return false;
       }
       else
       {
           return $this->router->redirect('/');
       }


    }
    public function AddWiki()
    {
        if($_SERVER['REQUEST_METHOD'] == 'POST')
        {
            if(!empty($_POST['category']) && !empty($_POST['tags']) && !empty($_POST['title'])
            && !empty($_POST['content']))
            {
                $category = $_POST['category'];

                $tags = $_POST['tags'];
                $title = $_POST['title'];
                $content = $_POST['content'];

                $this->writerModel->insertWiki($category,$tags,$title, $content, $_SESSION['idUser'] );

                return $this->router->redirect('/');

            }


        }
    }
}