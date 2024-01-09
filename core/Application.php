<?php

namespace app\core;
class Application
{
    public Router  $router;
    static  public string $root;
    public function __construct($rootPath)
    {
        SELF::$root = $rootPath;
        $this->router = new Router();
    }

    public function run()
    {
       echo $this->router->resolve();
    }
}