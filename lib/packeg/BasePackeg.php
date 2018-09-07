<?php

namespace Lib\Packeg;


use Helper\DayTranslate;
use Helper\TranslateDay;
use Helper\TranslateMonth;
use Lib\Location\UserLocation;
use Lib\Location\UserWeather;
use System\ORM;

class BasePackeg
{
    public $param;

    private $location;
    private $translate;

    public function __construct()
    {
//        $this->location = new UserLocation();
//        $this->translate = new TranslateDay();


        $this->PackageOptions();
    }

    private function PackageOptions()
    {
        $ln = 'ua';

//        $city = $this->location->getCity();

//        $time_unix = $this->location->getTime();

//        $day = date('D', $time_unix);
//        $day_w = $this->translate->get($day);


//        $day = date('d-m-Y', $time_unix);
//
//        $time = date('H:m', $time_unix);

//        $temperature = UserWeather::getTemp($this->location->getCityId());


//        $menu = new ORM('category');
//        $menu->select();
//        $menu = $menu->run();

//        $url = $_SERVER['REQUEST_URI'];



//        return $this->param = array(
//            'ln' => $ln,
//            'city' => $city,
//            'day_w' => $day_w,
//            'time_unix' => $time_unix,
//            'day' => $day,
//            'time' => $time,
//            'temperature' => $temperature,
//            'menu' => $menu,
//            'url' => $url
//        );
    }
}
