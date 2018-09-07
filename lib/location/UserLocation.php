<?php

namespace Lib\Location;

use Helper\DayTranslate;

class UserLocation
{
    private $ip;
    private $translate;

    public function __construct()
    {
        $this->ip = $_SERVER['REMOTE_ADDR'];

    }

    public function getCity()
    {
        $http = 'https://api.sypexgeo.net/json/'.$this->ip;
        $data = file_get_contents($http);
        $res = json_decode($data);
        $city = $res->city->name_en;
        return $city;
    }

    public function getTime()
    {
        $http = 'https://api.sypexgeo.net/json/'.$this->ip;
        $data = file_get_contents($http);
        $res = json_decode($data);
        $time_stamp = $res->timestamp;
        return $time_stamp;
    }

    public function getCityId()
    {
        $http = 'https://api.sypexgeo.net/json/'.$this->ip;
        $data = file_get_contents($http);
        $res = json_decode($data);
        $city_id = $res->city->id;
        return $city_id;
    }
}