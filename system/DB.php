<?php

namespace System;

use App\Configuration\Init;

class DB extends Init
{
    private static $connection;

    private function __construct()
    {
    }

    static function connection()
    {
        if (self::$connection == null) {
            try
            {
//                self::$connection = new \PDO('mysql:host=localhost;dbname='.self::get()->get('db_name'), self::get()->get('user'), self::get()->get('password'), array(
                self::$connection = new \PDO('mysql:host=localhost; dbname=mcs', 'chet21', 'greg21', array(
                    \PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION,
                    \PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"
                ));
            }
            catch(\PDOException $e)
            {
                echo "Ошибка: ".$e->getMessage()."<br>";
                echo "Место ошибки: ".$e->getLine();
            }
        }
        return self::$connection;
    }
}
