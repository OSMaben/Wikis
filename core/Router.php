<?php

namespace app\core;

class Router
{
    public Request $request;
    public array $router = [];
    // this is an associative array

    //    $router =  [
    //            'get' =>[
    //                '/' => $callback,
    //                'contact' => $callback
    //                ]
    //        ];

    public function __construct()
    {
        $this->request  =  new Request();
    }

    public function get($path, $callback)
    {
        $this->router['get'][$path] = $callback;
    }
    public function post($path, $callback)
    {
        $this->router['post'][$path] = $callback;
    }

    public function resolve()
    {
        $path = $this->request->getPath();
        $method = $this->request->getMethod();

        $callback = $this->router[$method][$path] ?? false;

        if($callback)
        {
            if(is_string($callback))
            {
                return $this->renderView($callback);
            }
            if(is_array($callback))
            {
                $controller = new $callback[0]();
                $method = $callback[1];
                return call_user_func([$controller ,$method]);
            }
                return call_user_func($callback);
        }
        return $this->renderView(404);
    }

    public function renderView($view, $variable = [])
    {
        $layoutContent = $this->layoutContent();
        $viewContent = $this->renderOnlyView($view, $variable = []);
        return str_replace("{{content}}", $viewContent, $layoutContent);
    }

    public function layoutContent(): false|string
    {
        ob_start();
        require_once Application::$root."/views/layouts/main.php";
        return ob_get_clean();
    }

    public function renderOnlyView($view, $param = [])
    {
        extract($param);
        ob_start();
        require_once Application::$root."/views/$view.php";
        return ob_get_clean();
    }

    public function redirect($path)
    {
        header("location: $path");
        exit();
    }


}