<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 06.03.2018
 * Time: 13:18
 */

namespace Helper;


class TranslateDay
{
    private $date;

    public function __construct()
    {
        $this->date = include_once __DIR__.'/../var/date/day/ua.php';
    }

    public function get($str)
    {
        if(!$this->date){
            throw new \Exception("Невдале завантаження перекладу назви дня");
        }

        foreach ($this->date as $k => $v){
            if($k === $str){
                return $v;
            }
        }
    }
}