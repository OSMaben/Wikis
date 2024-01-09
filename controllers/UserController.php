<?php

namespace app\controllers;
use app\core\Router;
class UserController
{

    public Router $router;

    public function __construct()
    {
        $this->router = new Router();
    }


}