<?php

namespace App\Configuration;

class BaseConfiguration
{
    private static $data;

    public static function load($file)
    {
       self::$data = require $file;
    }

    public function set($key, $val)
    {
        self::$data[$key] = $val;
    }

    public function get($key)
    {
        foreach (self::$data as $k => $v){
            if($k == $key){
                $res = $v;
            }
        }
        return $res;
    }

}