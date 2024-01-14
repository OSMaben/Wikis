<?php

namespace app\core;
class Application
{
    public Router  $router;
    static  public string $ROOT_DIR;
    public function __construct($rootPath)
    {
        SELF::$ROOT_DIR = $rootPath;
        $this->router = new Router();
    }

    public function run()
    {
       echo $this->router->resolve();
    }
}