<?php

namespace App\Controllers;

class Controller
{

    public function view($nameView, $params)
    {
        if(isset($params)){
            foreach ($params as $name_param => $value_param) {
                ${$name_param} = $value_param;
            }
        }
        
        include(__DIR__."/../views/{$nameView}.php");
        exit(); 
    }

}