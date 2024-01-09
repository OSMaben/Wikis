<?php
    session_start();
    require_once __DIR__. '/../vendor/autoload.php';
use app\core\Application;
use app\controllers\UserController;
use app\controllers\AuthController;
$app = new Application(dirname(__DIR__));
$app->router->get('/', 'home');

$app->router->get('/register','register');
$app->router->post('/register',[AuthController::class, 'register']);


$app->router->get('/login','login');
$app->router->post('/login',[AuthController::class, 'login']);


$app->router->get('/addArticle','addArticle');



$app->run();
