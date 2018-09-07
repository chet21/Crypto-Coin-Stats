<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 06.03.2018
 * Time: 16:17
 */

namespace Lib\Location;


class UserWeather
{
    static public function getTemp($id)
    {
        $html = 'http://api.openweathermap.org/data/2.5/forecast?id='.$id.'&APPID=4d5bb68f487bfc8c5f9bdaa74738dd33';
        $res = file_get_contents($html);
        $c = round((json_decode($res)->list[0]->main->temp) - 273.15, 1);
        return $c;
    }
}