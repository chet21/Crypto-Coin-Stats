<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 29.08.2018
 * Time: 11:12
 */

namespace System;


use Helper\DateHelp;

class Log
{
    private static $path = 'log.txt';

    public static function write($message)
    {
        file_put_contents(self::$path, DateHelp::time_log().' -> '.$message.PHP_EOL, FILE_APPEND);
    }
}