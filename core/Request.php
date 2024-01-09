<?php

namespace app\core;

class Request
{

    public function getPath()
    {
        $path = $_SERVER['REQUEST_URI'] ?? '/';
        $possition = strpos($path, "?");

        if($possition === false)
        {
            return $path;
        }
        else
            return  substr($path, 0 , $possition);
    }




    public function getMethod()
    {
        return strtolower($_SERVER['REQUEST_METHOD']);
    }
}