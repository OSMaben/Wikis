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
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                if ($_POST['submit'] == 'edit') {
                    $tag = $_POST['tag'];
                    $id = $_POST['edit'];
                    $this->writerModel->update('tags',  $tag , $id);
                }
                if ($_POST['submit'] == 'add') {
                    $tag = $_POST['tag'];
                    $this->writerModel->insert('tags', 'TagName', $tag);
                }

                return $this->router->redirect('addTag');
            }

        }



    public function deleteTag()
    {
        $id = $_GET['id'];
        if(isset($_SESSION['role']) && $_SESSION['role'] == 'Admin') {
            $this->writerModel->deleteTagAndCateggory('articletags','tags', $id, 'TagID');
            return $this->router->redirect('addTag');
        }
        else
            return $this->router->redirect('/');
    }

    public function showcategories()
    {
        if(isset($_SESSION['role']) && $_SESSION['role'] == 'Admin' || $_SESSION['role'] == 'Reader') {
           $categories =  $this->writerModel->show('categories', ['CategoryID', 'CategoryName']);
            return $this->router->renderView('Categories' ,['categories' => $categories]);
        }
        else
            return $this->router->redirect('/');
    }
    public function deleteCategory()
    {
        $id = $_GET['id'];
        if(isset($_SESSION['role']) && $_SESSION['role'] == 'Admin') {
            $this->writerModel->deleteTagAndCateggory('wikis', 'categories',$id, 'CategoryID');
            return $this->router->redirect('categories');
        }
        else
            return $this->router->redirect('/');
    }
    public function addcategories()
    {

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            if ($_POST['submit'] == 'edit') {
                $tag = $_POST['cate'];
                $id = $_POST['edit'];
                $this->writerModel->updateCategory('categories',  $tag , $id);
            }
            if ($_POST['submit'] == 'add') {
                $cate = $_POST['cate'];
                $this->writerModel->insert('categories','CategoryName', $cate);
            }
            return  $this->router->redirect('categories');
        }




    }


}