<?php

namespace App\Configuration;

class Init
{
    static private $config;

    private function __construct()
    {
    }

    static public function get()
    {
        if (self::$config == null){
            self::$config = new BaseConfiguration();
        }
        return self::$config;
    }
}