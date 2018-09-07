<?php

namespace System;

use System\Error;
use App\Controllers;

class Router
{

    public $routs;
    public $uri;

    public function __construct()
    {
        $this->routs = include __DIR__ . '/../var/routs.php';
        $this->uri = trim($_SERVER['REQUEST_URI'], '/');
    }

    public function Run()
    {
        foreach ($this->routs as $key => $rout){

            if(preg_match("~^$key$~", $this->uri)){
                $part = preg_replace("~$key~", $rout, $this->uri);
                $elements = explode('/', $part);
                $controller = ucfirst(array_shift($elements)).'Controller';
                $controller_namespace = 'App\\Controllers\\'.$controller;
                $action = ucfirst(array_shift($elements)).'Action';
                $data = $elements;

//                if (file_exists(__DIR__.'/../app/controllers/'.$controller.'.php')) {
                    $page_object = new $controller_namespace();
                    return $page_object->$action($data);
//                }
            }
//            throw new \Exception("Page not found");
        }
//        Error::E404();
    }
}

