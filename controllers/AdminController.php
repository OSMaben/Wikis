<?php

namespace app\controllers;
use app\Models\AdminModel;

class AdminController extends UserController
{

    public function getUsers()
    {
        $users = $this->writerModel->show('users', ['UserID','UserName', 'Email', 'RoleID']);
        return  $this->router->renderView('profile', ['users' =>$users]);
    }

    public function ShowWikis()
    {
        if(isset($_SESSION['role']) && $_SESSION['role'] == 'Admin') {
            $wikis = $this->writerModel->show('wikis', ['wikisID', 'Title', 'Content', 'PublishedDate']);
            return $this->router->renderView('AdminWikis', ['wikis' => $wikis]);
        }
        else
            return $this->router->redirect('/');

    }

    public function ArchiveWiki()
    {
        $this->writerModel->archive($_POST['submit']);
        return  $this->router->redirect('AdminWikis');
    }
    public function ShowTags()
    {
        $tags = $this->writerModel->show('tags',['TagID,TagName']);
        return $this->router->renderView('Tags', ['tags' => $tags]);
    }


    public function AddTag()
    {
        $tag = $_POST['tag'];
        $this->writerModel->insert('tags','TagName', $tag);
        return  $this->router->redirect('addTag');
    }
}