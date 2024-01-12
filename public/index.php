<?php
    session_start();
    require_once __DIR__. '/../vendor/autoload.php';

use app\controllers\AdminController;
use app\core\Application;
use app\controllers\UserController;
use app\controllers\AuthController;
use app\controllers\WriterController;
$app = new Application(dirname(__DIR__));
//$app->router->get('/', 'home');
$app->router->get('/', [WriterController::class, 'showWikis']);

$app->router->get('/register','register');
$app->router->post('/register',[AuthController::class, 'register']);


$app->router->get('/login','login');
$app->router->post('/login',[AuthController::class, 'login']);

$app->router->get('/blog-single',[WriterController::class, 'showSinglWikis']);

$app->router->get('/addArticle',[WriterController::class, 'showData']);
$app->router->post('/addArticle',[WriterController::class, 'AddWiki']);


$app->router->get('/profile',[UserController::class, 'showUsers']);
$app->router->get('/delete',[UserController::class, 'delete']);
$app->router->get('/updateWiki',[WriterController::class, 'UpdateWiki']);
$app->router->post('/updateWiki',[WriterController::class, 'changeWikiContent']);

$app->router->get('/AdminWikis',[AdminController::class, 'ShowWikis']);
$app->router->post('/AdminWikis',[AdminController::class, 'ArchiveWiki']);

$app->router->get('/addTag',[AdminController::class, 'ShowTags']);
$app->router->get('/deleteTag',[AdminController::class, 'deleteTag']);
$app->router->get('/deleteCategory',[AdminController::class, 'deleteCategory']);
$app->router->post('/addTag', [AdminController::class, 'AddTag']);


$app->router->get('/categories',[AdminController::class, 'showcategories']);
$app->router->post('/categories', [AdminController::class, 'addcategories']);


$app->router->get('/logout',[AuthController::class, 'destroy']);

$app->run();