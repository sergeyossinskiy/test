<?php

namespace App;

class Route
{
    static public function get($var, $controller_method)
    {
        $uri_parts = explode('?', $_SERVER['REQUEST_URI'], 2);

        if($uri_parts[0] == $var)
        {
            if(is_string($controller_method))
            {
                $controller = "App\\Controllers\\".substr($controller_method, 0, strpos($controller_method, '@', 0));//вытаскиваем из строки имя контроллера
                $method = substr($controller_method, strpos($controller_method, '@', 0) + 1, strlen($controller_method));//вытаскиваем из строки имя метода

                $instance = new $controller();
                $instance->$method();
            }
            if(is_object($controller_method))
            {
                $controller_method();
            }
        }
    }

    // static public function post($var, $controller_method)
    // {
    //     if(isset($_POST[$var]))
    //     {
    //         if(is_string($controller_method))
    //         {
    //             $controller = "App\\Controllers\\".substr($controller_method, 0, strpos($controller_method, '@', 0));//вытаскиваем из строки имя контроллера
    //             $method = substr($controller_method, strpos($controller_method, '@', 0) + 1, strlen($controller_method));//вытаскиваем из строки имя метода

    //             $class = new \ReflectionClass($controller);
    //             $obj = $class->newInstance();
    //             $obj::$method();
    //         }
    //         if(is_object($controller_method))
    //         {
    //             $controller_method();
    //         }
    //     }
    // }
};