<?php

namespace app\controllers;
use app\core\Router;
use app\models\WriterModel;
class UserController
{

    public Router $router;
    protected WriterModel $writerModel;

    public function __construct()
    {
        $this->router = new Router();
        $this->writerModel = new WriterModel();
    }

    // this is for the writer
    public function showUsers()
    {
        if(isset($_SESSION['role']) && $_SESSION['role'] == 'Admin' || $_SESSION['role'] == 'Reader') {
            $wikis = $this->writerModel->showWiki('wikis', ['wikisID','Title', 'PublishedDate', 'archieve'], $_SESSION['idUser']);
            $users = $this->writerModel->show('users', ['UserID','UserName', 'Email', 'RoleID']);
            $wikisNumber = $this->writerModel->Analytics('wikis');
            $CategiriesNumber = $this->writerModel->Analytics('categories');
            $tagsNumber = $this->writerModel->Analytics('tags');

            return  $this->router->renderView('profile', ['users' =>$users,
                'wikis' => $wikis ,
                'wikisNumber' =>$wikisNumber,
                'CategiriesNumber'=>$CategiriesNumber,
                'tagsNumber'=>$tagsNumber]);
        }
        else
            return $this->router->redirect('/');
    }


    public function delete()
    {
        if(isset($_SESSION['role']) && $_SESSION['role'] == 'Admin') {
            $this->writerModel->deleteIt('wikis',$_GET['id']);
            return $this->router->redirect('/profile');
        }
        else
            return $this->router->redirect('/');
    }

    public function result()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST')
        {
            $searchInput = $_POST['input'];
            $result = $this->writerModel->searchWiki($searchInput);
            return $this->router->renderView('home' , ['result' => $result]);
        }
    }

}